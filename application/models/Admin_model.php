<?php

class Admin_model extends CI_Model {
	// Category
	public function insertCategory($title, $description, $slug){
		$query = $this->db->query("INSERT INTO categories (title, description, slug) VALUES ('$title', '$description', '$slug')");
		return $query;
	}

	public function selectCategories(){
		
	}

	public function selectCategory(){
		
	}

	public function updateCategory(){
		
	}

	public function deleteCategory(){
		
	}

	// Posts

	// Pages

	// Users

	// Widgets
}