<?php

class Admin_model extends CI_Model {
	// Category
	public function insertCategory($title, $description, $slug){
		$query = $this->db->query("INSERT INTO categories (title, description, slug) VALUES ('$title', '$description', '$slug')");
		return $query;
	}

	public function selectCategories(){
		$query = $this->db->get('categories');

		return $query->result_array();
	}

	public function selectCategory($id){
		$query = $this->db->get_where('categories', array('id' => $id));
		return $query->row_array();
	}

	public function updateCategory($title, $description, $slug, $id){
		$query = $this->db->query("UPDATE categories SET title='$title', description='$description', slug='$slug', updated=NOW() WHERE id=$id");
		return $query;
	}

	public function deleteCategory($id){
		$query = $this->db->delete('categories', array('id' => $id));
		return $query;
	}

	// Posts
	public function selectPosts(){
		$query = $this->db->get('posts');

		return $query->result_array();
	}

	public function insertPost($title, $content, $status, $slug, $categories, $filename){
		$query = $this->db->query("INSERT INTO posts (title, content, status, slug, pic) VALUES ('$title', '$content', '$status', '$slug', '$filename')");
		$postid = $this->db->insert_id();
		$this->insertPostCategories($categories, $postid);
		return $query;
	}

	public function insertPostCategories($categories, $postid){
		foreach ($categories as $category) {
			$query = $this->db->query("INSERT INTO post_categories (cid, pid) VALUES ('$category', '$postid')");
		}
	}

	public function selectPost($id){
		$query = $this->db->get_where('posts', array('id' => $id));
		return $query->row_array();
	}

	public function deletePostCategories($pid){
		$query = $this->db->delete('post_categories', array('pid' => $pid));
		//return $query;
	}

	public function deletePost($id){
		$query = $this->db->delete('posts', array('id' => $id));
		return $query;
	}

	public function deletePostPic($id){
		$query = $this->db->query("UPDATE posts SET pic='', updated=NOW() WHERE id=$id");
		//return $query;
	}

	public function postCategories($pid){
		$query = $this->db->get_where('post_categories', array('pid' => $pid));
		return $query->result_array();
	}

	// Pages

	// Users

	// Widgets
}