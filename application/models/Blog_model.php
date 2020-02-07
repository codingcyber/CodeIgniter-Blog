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
	public function getPost(){
		$this->load->database();
	}

	// Get Single Page for Blog Page
	public function getPage(){
		
	}
}