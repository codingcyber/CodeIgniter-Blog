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

	public function category(){
		//echo "Blog Category Controller Method";
		$this->load->helper('url');
		$this->load->view('frontend/templates/header');
		$this->load->view('frontend/templates/navigation');
		$this->load->view('frontend/category');
		$this->load->view('frontend/templates/sidebar');
		$this->load->view('frontend/templates/footer');
	}

	public function post(){
		//echo "Blog Post Controller Method";

		$this->load->model('blog_model');
		$this->blog_model->getPost();

		$this->load->helper('url');
		$this->load->view('frontend/templates/header');
		$this->load->view('frontend/templates/navigation');
		$this->load->view('frontend/single-post');
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