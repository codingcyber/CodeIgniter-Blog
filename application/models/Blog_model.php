<?php

class Blog_model extends CI_Model {

	// Get All the Posts for Blog Index page
	public function getAllPosts(){
		//$this->load->database();
		$query = $this->db->get('posts');

		return $query->result_array();
	}

	public function getAllCategories(){
		//$this->load->database();
		$query = $this->db->get('categories');

		return $query->result_array();
	}

	// Get Posts based on category passed for Blog Category Page
	public function getCategoryPosts(){
		
	}

	// Get Single Post for Blog Post Page
	public function getPost($id){
		//$this->load->database();
		$query = $this->db->get_where('posts', array('id' => $id));
		$data['postcount'] = $query->num_rows();
		$data['post'] = $query->row_array();
		
		return $data;
	}

	public function getComments($pid){
		$query = $this->db->query("SELECT comments.comment, users.username, users.fname, users.lname, users.role FROM comments JOIN users ON comments.uid=users.id WHERE comments.pid=$pid AND comments.status='approved' ORDER BY comments.created DESC");
		$data['count'] = $query->num_rows();
		$data['rows'] = $query->result_array();
		
		return $data;
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
		$query = $this->db->query("SELECT fname, lname, username, role FROM users WHERE id=$id");

		return $query->row_array();
	}

	public function insertComment($pid, $uid, $comment){
		$query = $this->db->query("INSERT INTO comments (pid, uid, comment, status) VALUES ('$pid', '$uid', '$comment', 'submitted')");

		return $query;
	}

	public function getWidget($type){
		$query = $this->db->get_where('widgets', array('type' => $type));
		$data['widgetcount'] = $query->num_rows();
		$data['widget'] = $query->row_array();
		
		return $data;
	}

	public function getWidgets($type){
		$query = $this->db->get_where('widgets', array('type' => $type));
		$data['widgetcount'] = $query->num_rows();
		$data['widgets'] = $query->result_array();
		
		return $data;
	}



}