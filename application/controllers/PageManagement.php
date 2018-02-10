<?php
 // this is a test class

Class PageManagement Extends CI_Controller
{
		public function index()
	 {
	 		$this->load->view('login');
	 }

	 public function secondFunc()
	 {
			echo "test";
	 }

}