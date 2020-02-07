<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
	public function index(){
		echo "Blog Index Controller Method";
	}

	public function category(){
		echo "Blog Category Controller Method";
	}

	public function post(){
		echo "Blog Post Controller Method";
	}

	public function page(){
		echo "Blog Page Controller Method";
	}
}