<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	// Admin User Login
	public function index(){
		echo "Admin Index";
	}

	// Categories - Add, Edit, Update, View, Delete
	public function AddCategory(){

		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$slug = $this->input->post('slug');

		// Form Validations
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|required');

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('category', '<div class="alert alert-danger">Failed to Add Category.</div>');
		}else{
			// insert into categories table
			$this->load->model('admin_model');
			$res = $this->admin_model->insertCategory($title, $description, $slug);
			if($res){
				$this->session->set_flashdata('category', '<div class="alert alert-success">Category Added Successfully.</div>');
				redirect('Admin/ViewCategories');
			}
		}

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/add-category');
		$this->load->view('admin/templates/footer');
	}

	public function EditCategory(){
		$this->load->model('admin_model');
		$this->admin_model->selectCategory();
	}

	public function UpdateCategory(){
		$this->load->model('admin_model');
		$this->admin_model->updateCategory();
	}

	public function ViewCategories(){
		$this->load->model('admin_model');
		$data['categories'] = $this->admin_model->selectCategories();

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/view-categories', $data);
		$this->load->view('admin/templates/footer');
	}

	public function DeleteCategory(){
		$this->load->model('admin_model');
		$this->admin_model->deleteCategory();
	}

	// Posts - Add, Edit, Update, View, Delete Post, Delete Post Pic

	// Pages - Add, Edit, Update, View, Delete Page, Delete Page Pic

	// Users - Add, Edit, Update, View, Delete

	// Widgets - Add, Edit, Update, View, Delete
}