<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	// Admin User Login
	public function index(){
		$this->login();
	}

	public function login(){
		$this->load->view('admin/templates/header');
		$this->load->view('admin/login');
		$this->load->view('admin/templates/footer');
	}

	public function loginProcess(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run() == FALSE){
			$this->login();
		}else{
			$this->load->model('admin_model');
			$data = $this->admin_model->loginUser($email, $password);
			if($data['response']){
				$user = $data['user'];
				$this->session->set_userdata('id', $user['id']);
				$this->session->set_userdata('login', true);
				$this->session->set_userdata('last_login', time());
				redirect('/Admin/Dashboard');
			}else{
				$this->session->set_flashdata('login', '<div class="alert alert-danger">Login Failed, please check your login credentials.</div>');
				redirect('Admin/login');
			}
		}	

	}

	public function Dashboard(){
		// echo "<pre>";
		// print_r($this->session->userdata());
		// echo "</pre>";
		$this->checkLogin();
		$this->checkUserAdmin();
		$data['commentscount'] = $this->admin_model->selectComments(true);
		$data['publishedcount'] = $this->admin_model->selectPostStatus('published');
		$data['draftcount'] = $this->admin_model->selectPostStatus('draft');
		$data['posts'] = $this->admin_model->selectPosts();
		$data['comments'] = $this->admin_model->selectComments();

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/templates/footer');
	}

	private function checkLogin(){
		if($this->session->login != 'true'){
			$this->session->sess_destroy();
			redirect('Admin/Login');
		}
		if(empty($this->session->id)){
			$this->session->sess_destroy();
			redirect('Admin/Login');
		}
		if(empty($this->session->last_login)){
			$this->session->sess_destroy();
			redirect('Admin/Login');
		}
	}

	private function checkUserAdmin(){
		$this->load->model('admin_model');
		$user = $this->admin_model->selectUser($this->session->id);

		if(($user['role'] == 'administrator') || ($user['role'] == 'editor')){
			//echo "Admin or Editor";
		}else{
			redirect('Blog');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('Admin/Login');
	}

	// Categories - Add, Edit, Update, View, Delete
	public function AddCategory(){
		$this->checkLogin();
		$this->checkUserAdmin();

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
		$this->checkLogin();
		$this->checkUserAdmin();

		$this->load->model('admin_model');
		$data['category'] = $this->admin_model->selectCategory($id);

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/edit-category', $data);
		$this->load->view('admin/templates/footer');
	}

	public function UpdateCategory(){
		$this->checkLogin();
		$this->checkUserAdmin();

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
		$this->checkLogin();
		$this->checkUserAdmin();

		$this->load->model('admin_model');
		$data['categories'] = $this->admin_model->selectCategories();

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/view-categories', $data);
		$this->load->view('admin/templates/footer');
	}

	public function DeleteCategory($id){
		$this->checkLogin();
		$this->checkUserAdmin();

		$this->load->model('admin_model');
		$res = $this->admin_model->deleteCategory($id);
		if($res){
			$this->session->set_flashdata('category', '<div class="alert alert-success">Category Deleted Successfully.</div>');
			redirect('Admin/ViewCategories');
		}
	}

	// Posts - Add, Edit, Update, View, Delete Post, Delete Post Pic
	public function AddPost(){
		$this->checkLogin();
		$this->checkUserAdmin();

		$title = $this->input->post('title');
		$content = $this->input->post('content');
		$categories = $this->input->post('categories');
		$status = $this->input->post('status');
		$slug = $this->input->post('slug');
		$uid = $this->session->id;

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
				$res = $this->admin_model->insertPost($title, $content, $status, $slug, $categories, $filename, $uid);
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
		$this->checkLogin();
		$this->checkUserAdmin();

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
		$this->checkLogin();
		$this->checkUserAdmin();

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
			$this->EditPost($id);
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
		$this->checkLogin();
		$this->checkUserAdmin();

		$this->load->model('admin_model');
		$data['posts'] = $this->admin_model->selectPosts();

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/view-posts', $data);
		$this->load->view('admin/templates/footer');
	}

	public function DeletePost($id){
		$this->checkLogin();
		$this->checkUserAdmin();

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
		$this->checkLogin();
		$this->checkUserAdmin();

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
		$this->checkLogin();
		$this->checkUserAdmin();

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
		$this->checkLogin();
		$this->checkUserAdmin();

		$this->load->model('admin_model');
		$data['user'] = $this->admin_model->selectUser($id);
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/edit-user', $data);
		$this->load->view('admin/templates/footer');
	}

	public function UpdateUser(){
		$this->checkLogin();
		$this->checkUserAdmin();

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
		$this->checkLogin();
		$this->checkUserAdmin();

		$this->load->model('admin_model');
		$data['users'] = $this->admin_model->selectUsers();

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/view-users', $data);
		$this->load->view('admin/templates/footer');
	}

	public function DeleteUser($id){
		$this->checkLogin();
		$this->checkUserAdmin();

		$this->load->model('admin_model');
		$res = $this->admin_model->deleteUser($id);
		if($res){
			$this->session->set_flashdata('user', '<div class="alert alert-success">User Deleted Successfully.</div>');
				redirect('Admin/ViewUsers');
		}
	}

	// Comments
	public function ViewComments(){
		$this->checkLogin();
		$this->checkUserAdmin();

		$this->load->model('admin_model');
		$data['comments'] = $this->admin_model->selectComments();
		$data['role'] = $this->admin_model->userRole($this->session->id);

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/comments', $data);
		$this->load->view('admin/templates/footer');
	}

	public function processComment($id, $status){
		$this->checkLogin();
		$this->checkUserAdmin();

		$this->load->model('admin_model');

		if(($status == 'approved') || ($status == 'disapproved')){
			$res = $this->admin_model->commentStatus($id, $status);
			if($res){
				// success message
				$this->session->set_flashdata('comment', '<div class="alert alert-success">Comment Status Updated Successfully.</div>');
					redirect('Admin/ViewComments');
			}else{
				// failure message
				$this->session->set_flashdata('comment', '<div class="alert alert-danger">Failed to Update Comment Status.</div>');
				redirect('Admin/ViewComments');
			}
		}else{
			$this->session->set_flashdata('comment', '<div class="alert alert-danger">This Status is not Acceptable.</div>');
			redirect('Admin/ViewComments');
		}
	}

	public function EditComment($id){
		$this->checkLogin();
		$this->checkUserAdmin();

		$this->load->model('admin_model');
		$data['comment'] = $this->admin_model->selectComment($id);

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/edit-comment', $data);
		$this->load->view('admin/templates/footer');
	}

	public function UpdateComment(){
		$this->checkLogin();
		$this->checkUserAdmin();

		$comment = $this->input->post('comment');
		$status = $this->input->post('status');
		$id = $this->input->post('id');

		$this->load->model('admin_model');
		$res = $this->admin_model->updateComment($comment, $status, $id);
		if($res){
			$this->session->set_flashdata('comment', '<div class="alert alert-success">Comment Udpated.</div>');
			redirect('Admin/ViewComments');
		}
	}

	// Widgets - Add, Edit, Update, View, Delete

	public function AddWidget(){
		$this->checkLogin();
		$this->checkUserAdmin();

		$title = $this->input->post('title');
		$type = $this->input->post('type');
		$content = $this->input->post('content');
		$order = $this->input->post('order');

		//Form Validations
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Widget Title', 'required');
		$this->form_validation->set_rules('type', 'Widget Type', 'required');
		$this->form_validation->set_rules('content', 'Widget Content', 'required');
		$this->form_validation->set_rules('order', 'Widget Order', 'required');

		if($this->form_validation->run() == FALSE){
			// load the views & display the errors
		}else{
			// load the model method & execute the insert operation
			$this->load->model('admin_model');
			$res = $this->admin_model->insertWidget($title, $type, $content, $order);
			if($res){
				$this->session->set_flashdata('widget', '<div class="alert alert-success">Widget Added Successfully.</div>');
				redirect('Admin/ViewWidgets');
			}else{
				$this->session->set_flashdata('widget', '<div class="alert alert-danger">Failed to Add Widget.</div>');
				redirect('Admin/ViewWidgets');
			}
		}

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/add-widget');
		$this->load->view('admin/templates/footer');
	}

	public function ViewWidgets(){
		$this->checkLogin();
		$this->checkUserAdmin();

		$this->load->model('admin_model');
		$data['widgets'] = $this->admin_model->selectWidgets();

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/view-widgets', $data);
		$this->load->view('admin/templates/footer');
	}

	public function EditWidget($id){
		$this->checkLogin();
		$this->checkUserAdmin();

		$this->load->model('admin_model');
		$data['widget'] = $this->admin_model->selectWidget($id);

		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/navigation');
		$this->load->view('admin/edit-widget', $data);
		$this->load->view('admin/templates/footer');
	}

	public function UpdateWidget(){
		$this->checkLogin();
		$this->checkUserAdmin();

		$title = $this->input->post('title');
		$type = $this->input->post('type');
		$content = $this->input->post('content');
		$order = $this->input->post('order');
		$id = $this->input->post('id');

		//Form Validations
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Widget Title', 'required');
		$this->form_validation->set_rules('type', 'Widget Type', 'required');
		$this->form_validation->set_rules('content', 'Widget Content', 'required');
		$this->form_validation->set_rules('order', 'Widget Order', 'required');

		if($this->form_validation->run() == FALSE){
			// load the views & display the errors
		}else{
			$this->load->model('admin_model');
			$res = $this->admin_model->updateWidget($title, $type, $content, $order, $id);
			if($res){
				$this->session->set_flashdata('widget', '<div class="alert alert-success">Widget Updated Successfully.</div>');
				redirect('Admin/ViewWidgets');
			}
		}

	}

	public function DeleteWidget($id){
		$this->checkLogin();
		$this->checkUserAdmin();

		$this->load->model('admin_model');
		$res = $this->admin_model->deleteWidget($id);
		if($res){
			$this->session->set_flashdata('widget', '<div class="alert alert-success">Widget Deleted Successfully.</div>');
			redirect('Admin/ViewWidgets');
		}else{
			$this->session->set_flashdata('widget', '<div class="alert alert-danger">Failed to Delete Widget.</div>');
			redirect('Admin/ViewWidgets');
		}
	}
}