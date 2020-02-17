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
		$this->form_validation->set_rules('slug', 'Slug', 'trim|alpha_dash|required');

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

	public function EditCategory($id){
		$this->load->model('admin_model');
		$data['category'] = $this->admin_model->selectCategory($id);

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/edit-category', $data);
		$this->load->view('admin/templates/footer');
	}

	public function UpdateCategory(){

		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$slug = $this->input->post('slug');
		$id = $this->input->post('id');

		// Form Validations
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|alpha_dash|required');

		if($this->form_validation->run() == FALSE){
			//$this->session->set_flashdata('category', '<div class="alert alert-danger">Failed to Update Category.</div>');
			$this->EditCategory($id);
		}else{

			$this->load->model('admin_model');
			$res = $this->admin_model->updateCategory($title, $description, $slug, $id);
			if($res){
				$this->session->set_flashdata('category', '<div class="alert alert-success">Category Updated Successfully.</div>');
				redirect('Admin/ViewCategories');
			}
		}
	}

	public function ViewCategories(){
		$this->load->model('admin_model');
		$data['categories'] = $this->admin_model->selectCategories();

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/view-categories', $data);
		$this->load->view('admin/templates/footer');
	}

	public function DeleteCategory($id){
		echo $id;
		$this->load->model('admin_model');
		$res = $this->admin_model->deleteCategory($id);
		if($res){
			$this->session->set_flashdata('category', '<div class="alert alert-success">Category Deleted Successfully.</div>');
			redirect('Admin/ViewCategories');
		}
	}

	// Posts - Add, Edit, Update, View, Delete Post, Delete Post Pic
	public function AddPost(){
		$title = $this->input->post('title');
		$content = $this->input->post('content');
		$categories = $this->input->post('categories');
		$status = $this->input->post('status');
		$slug = $this->input->post('slug');

		// Form Validations
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('content', 'Content', 'trim|required');
		$this->form_validation->set_rules('categories[]', 'Categories', 'trim|alpha_dash|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|alpha_dash|required');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|alpha_dash|required');
		if(empty($_FILES['image']['name'])){
			$this->form_validation->set_rules('image', 'Image', 'required');
		}
		
		if($this->form_validation->run() == FALSE){
			// $this->session->set_flashdata('category', '<div class="alert alert-danger">Failed to Add Category.</div>');
		}else{
			$upload = $this->fileUpload('image');
			// Insert into Posts table
			if($upload['response']){
				$filename = $upload['uploadresponse']['file_name'];
				$this->load->model('admin_model');
				$res = $this->admin_model->insertPost($title, $content, $status, $slug, $categories, $filename);
				if($res){
					$this->session->set_flashdata('posts', '<div class="alert alert-success">Post Added Successfully.</div>');
					redirect('Admin/ViewPosts');
				}
			}
		}

		$this->load->model('admin_model');
		$data['categories'] = $this->admin_model->selectCategories();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/add-post', $data);
		$this->load->view('admin/templates/footer');
	}

	public function fileUpload($file){
        $config['upload_path']          = './assets/media/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name']         = TRUE;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($file))
        {
        		$data['response'] = false;
                return $data;
        }
        else
        {
        		$data['response'] = true;
               	$data['uploadresponse'] = $this->upload->data();
               	return $data;
        }
    }

	public function EditPost($id){
		$this->load->model('admin_model');
		$data['post'] = $this->admin_model->selectPost($id);
		$data['categories'] = $this->admin_model->selectCategories();
		
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/edit-post', $data);
		$this->load->view('admin/templates/footer');
	}

	public function UpdatePost(){

	}

	public function ViewPosts(){
		$this->load->model('admin_model');
		$data['posts'] = $this->admin_model->selectPosts();

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/view-posts', $data);
		$this->load->view('admin/templates/footer');
	}

	public function DeletePost($id){
		$this->load->model('admin_model');
		$post = $this->admin_model->selectPost($id);
		//var_dump($post);
		$filepath = "./assets/media/".$post['pic'];
		unlink($filepath);
		// Delete records from post categories table
		$this->admin_model->deletePostCategories($id);
		// Delete the Post from posts table
		$res = $this->admin_model->deletePost($id);
		if($res){
			$this->session->set_flashdata('posts', '<div class="alert alert-success">Post Deleted Successfully.</div>');
			redirect('Admin/ViewPosts');
		}
	}

	// Pages - Add, Edit, Update, View, Delete Page, Delete Page Pic

	// Users - Add, Edit, Update, View, Delete

	// Widgets - Add, Edit, Update, View, Delete
}