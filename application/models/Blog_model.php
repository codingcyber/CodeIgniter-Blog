<?php

class Blog_model extends CI_Model {

	// Get All the Posts for Blog Index page
	public function getAllPosts(){
		$this->load->database();
		$query = $this->db->get('posts');

		return $query->result_array();
	}

	// Get Posts based on category passed for Blog Category Page
	public function getCategoryPosts(){
		
	}

	// Get Single Post for Blog Post Page
	public function getPost($id){
		$this->load->database();
		$query = $this->db->get_where('posts', array('id' => $id));

		return $query->row_array();
	}

	// Get Single Page for Blog Page
	public function getPage(){
		
	}
}