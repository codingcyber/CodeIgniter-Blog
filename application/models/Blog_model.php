<?php

class Blog_model extends CI_Model {

	// Get All the Posts for Blog Index page
	public function getAllPosts(){
		//$this->load->database();
		$query = $this->db->get('posts');

		return $query->result_array();
	}

	// Get Posts based on category passed for Blog Category Page
	public function getCategoryPosts(){
		
	}

	// Get Single Post for Blog Post Page
	public function getPost($id){
		//$this->load->database();
		$query = $this->db->get_where('posts', array('id' => $id));

		return $query->row_array();
	}

	// Get Single Page for Blog Page
	public function getPage(){
		
	}

	public function loginUser($email, $password){
		$query = $this->db->query("SELECT * FROM users WHERE email='$email' AND role='subscriber'");
		if($query->num_rows() == 1){
			$user = $query->row_array();
			if(password_verify($password, $user['password'])){
				$data['user'] = $user;
				$data['response'] = true;
				return $data;
			}else{
				$data['response'] = false;
				return $data;
			}
		}else{
			$data['response'] = false;
			return $data;
		}
	}

	public function getUserInfo($id){
		$query = $this->db->get_where('users', array('id' => $id));

		return $query->row_array();
	}



}