<?php

Class Admin Extends CI_Controller
{
	public  function  __construct()
	{
		parent::__construct();
    	$this->load->helper('url');		
		$this->load->helper('Tools');
	}
	public function  index(){
		$this->load->view('Admin/index');
	}

}