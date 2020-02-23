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
			//$this->session->set_flashdata('category', '<div class="alert alert-danger">Failed to Add Category.</div>');
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
		$this->form_validation->set_rules('categories[]', 'Categories', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|alpha_dash|required');
		if(empty($_FILES['image']['name'])){
			$this->form_validation->set_rules('image', 'Image', 'required');
		}
		
		if($this->form_validation->run() == FALSE){
			// nothing to do
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
		$data['catids'] = $this->admin_model->postCategories($id);

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/edit-post', $data);
		$this->load->view('admin/templates/footer');
	}

	public function UpdatePost(){
		$title = $this->input->post('title');
		$content = $this->input->post('content');
		$categories = $this->input->post('categories');
		$status = $this->input->post('status');
		$slug = $this->input->post('slug');
		$id = $this->input->post('id');

		// Form Validations
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('content', 'Content', 'trim|required');
		$this->form_validation->set_rules('categories[]', 'Categories', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|alpha_dash|required');

		if($this->form_validation->run() == FALSE){
			// nothing to do
		}else{
			$upload = $this->fileUpload('image');
			// Insert into Posts table
			if($upload['response']){
				$filename = $upload['uploadresponse']['file_name'];
			}else{
				$filename = "";
			}
			$this->load->model('admin_model');
			$res = $this->admin_model->updatePost($title, $content, $status, $slug, $categories, $filename, $id);
			if($res){
				$this->session->set_flashdata('posts', '<div class="alert alert-success">Post Updated Successfully.</div>');
				redirect('Admin/ViewPosts');
			}
		}
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

	public function deletePostPic($id){
		$this->load->model('admin_model');
		$post = $this->admin_model->selectPost($id);
		//var_dump($post);
		$filepath = "./assets/media/".$post['pic'];
		unlink($filepath);
		$this->admin_model->deletePostPic($id);
		redirect('Admin/EditPost/'.$id);
	}

	// Pages - Add, Edit, Update, View, Delete Page, Delete Page Pic

	// Users - Add, Edit, Update, View, Delete
	public function AddUser(){

		$username = $this->input->post('username');
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$email = $this->input->post('email');
		$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$role = $this->input->post('role');

		// Form Validations
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'User Name', 'trim|required|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if($this->form_validation->run() == FALSE){
			//nothing to do
		}else{
			// insert into users table
			$this->load->model('admin_model');
			$res = $this->admin_model->insertUser($username, $fname, $lname, $email, $password, $role);
			if($res){
				$this->session->set_flashdata('user', '<div class="alert alert-success">User Added Successfully.</div>');
				redirect('Admin/ViewUsers');
			}
		}

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/add-user');
		$this->load->view('admin/templates/footer');
	}

	public function EditUser($id){
		$this->load->model('admin_model');
		$data['user'] = $this->admin_model->selectUser($id);
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/edit-user', $data);
		$this->load->view('admin/templates/footer');
	}

	public function UpdateUser(){
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$role = $this->input->post('role');
		$id = $this->input->post('id');

		$this->load->model('admin_model');
		$res = $this->admin_model->updateUser($fname, $lname, $password, $role, $id);
		if($res){
			$this->session->set_flashdata('user', '<div class="alert alert-success">User updated Successfully.</div>');
			redirect('Admin/ViewUsers');
		}
	}

	public function ViewUsers(){
		$this->load->model('admin_model');
		$data['users'] = $this->admin_model->selectUsers();

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/view-users', $data);
		$this->load->view('admin/templates/footer');
	}

	public function DeleteUser($id){
		$this->load->model('admin_model');
		$res = $this->admin_model->deleteUser($id);
		if($res){
			$this->session->set_flashdata('user', '<div class="alert alert-success">User Deleted Successfully.</div>');
				redirect('Admin/ViewUsers');
		}
	}


	// Widgets - Add, Edit, Update, View, Delete
}