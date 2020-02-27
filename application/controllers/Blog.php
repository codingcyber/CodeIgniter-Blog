<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
	public function index(){
		//echo "Blog Index Controller Method";

		$this->load->model('blog_model');
		$data['posts'] = $this->blog_model->getAllPosts();
		$data['userLogin'] = $this->checkLogin();
		if($data['userLogin']){
			$data['user'] = $this->getUser();
		}

		$this->load->helper('url');
		$this->load->view('frontend/templates/header');
		$this->load->view('frontend/templates/navigation');
		$this->load->view('frontend/home', $data);
		$this->load->view('frontend/templates/sidebar');
		$this->load->view('frontend/templates/footer');
	}

	public function login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run() == FALSE){
			$this->index();
		}else{
			$this->load->model('blog_model');
			$data = $this->blog_model->loginUser($email, $password);
			if($data['response']){
				$user = $data['user'];
				$this->session->set_userdata('id', $user['id']);
				$this->session->set_userdata('login', true);
				$this->session->set_userdata('last_login', time());
				redirect('/Blog');
			}else{
				$this->session->set_flashdata('login', '<div class="alert alert-danger">Login Failed, please check your login credentials.</div>');
				$this->index();
			}
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('Blog');
	}

	private function getUser(){
		$this->load->model('blog_model');
		$data = $this->blog_model->getUserInfo($this->session->id);

		return $data;
	}

	private function checkLogin(){
		if(empty($this->session->id)){
			$this->session->sess_destroy();
			return false;
		}else{
			return true;
		}
	}

	public function category(){
		//echo "Blog Category Controller Method";
		$this->load->helper('url');
		$data['userLogin'] = $this->checkLogin();
		if($data['userLogin']){
			$data['user'] = $this->getUser();
		}

		$this->load->view('frontend/templates/header');
		$this->load->view('frontend/templates/navigation');
		$this->load->view('frontend/category');
		$this->load->view('frontend/templates/sidebar');
		$this->load->view('frontend/templates/footer');
	}

	public function post($id){
		//echo "Blog Post Controller Method";
		$this->load->model('blog_model');
		$data = $this->blog_model->getPost($id);
		$data['comment'] = $this->blog_model->getComments($id);
		$data['userLogin'] = $this->checkLogin();
		if($data['userLogin']){
			$data['user'] = $this->getUser();
		}
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		if($data['postcount'] < 1){
			redirect('Blog/404');
		}
		$this->load->helper('url');
		$this->load->view('frontend/templates/header');
		$this->load->view('frontend/templates/navigation');
		$this->load->view('frontend/single-post', $data);
		$this->load->view('frontend/templates/sidebar');
		$this->load->view('frontend/templates/footer');
	}

	public function page(){
		//echo "Blog Page Controller Method";
		$this->load->helper('url');
		$this->load->view('frontend/templates/header');
		$this->load->view('frontend/templates/navigation');
		$this->load->view('frontend/page');
		$this->load->view('frontend/templates/sidebar');
		$this->load->view('frontend/templates/footer');
	}

	public function submitComment(){
		$pid = $this->input->post('pid');
		$uid = $this->session->id;
		$comment = $this->input->post('comment');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('comment', 'Comment', 'trim|required');
		if($this->form_validation->run() == FALSE){
			$this->post($pid);
		}else{
			$this->load->model('blog_model');
			$res = $this->blog_model->insertComment($pid, $uid, $comment);
			if($res){
				$this->session->set_flashdata('comment', '<div class="alert alert-success">Comment Submitted Successfully.</div>');
			}else{
				$this->session->set_flashdata('comment', '<div class="alert alert-danger"> Failed to Submit the Comment.</div>');
			}
			redirect("/Blog/post/$pid");
		}
	}




}