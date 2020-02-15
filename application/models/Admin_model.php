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

	// Pages

	// Users

	// Widgets
}