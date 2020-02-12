<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	// Admin User Login
	public function index(){
		echo "Admin Index";
	}

	// Categories - Add, Edit, Update, View, Delete
	public function AddCategory(){
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/add-category');
		$this->load->view('admin/templates/footer');
	}

	public function EditCategory(){
		echo "Admin Edit Category";
	}

	public function UpdateCategory(){
		echo "Admin Update Category";
	}

	public function ViewCategories(){
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/view-categories');
		$this->load->view('admin/templates/footer');
	}

	public function DeleteCategory(){
		echo "Admin Delete Category";
	}

	// Posts - Add, Edit, Update, View, Delete Post, Delete Post Pic

	// Pages - Add, Edit, Update, View, Delete Page, Delete Page Pic

	// Users - Add, Edit, Update, View, Delete

	// Widgets - Add, Edit, Update, View, Delete
}