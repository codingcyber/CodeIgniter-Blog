<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
	public function index(){
		//echo "Blog Index Controller Method";

		$this->load->model('blog_model');
		$data['posts'] = $this->blog_model->getAllPosts();

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

	public function category(){
		//echo "Blog Category Controller Method";
		$this->load->helper('url');
		$this->load->view('frontend/templates/header');
		$this->load->view('frontend/templates/navigation');
		$this->load->view('frontend/category');
		$this->load->view('frontend/templates/sidebar');
		$this->load->view('frontend/templates/footer');
	}

	public function post($id){
		//echo "Blog Post Controller Method";
		$this->load->model('blog_model');
		$data['post'] = $this->blog_model->getPost($id);

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
}