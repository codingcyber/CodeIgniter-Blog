<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	// Admin User Login
	public function index(){
		echo "Admin Index";
	}

	// Categories - Add, Edit, Update, View, Delete
	public function AddCategory(){
		$this->load->model('admin_model');
		$this->admin_model->insertCategory();

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
		$this->admin_model->selectCategories();

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/view-categories');
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