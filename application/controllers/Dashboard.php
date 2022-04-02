<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct($config="rest") {
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		parent::__construct();
		$this->load->model('Mdl_user');
		$this->load->model('Mdl_courses');
		if(! $this->Mdl_user->sessionCheck()){
			redirect("authenticate/login");
		}
	}
	public function index()
	{
		$role=$this->Mdl_user->getUserRole();
		$this->load->view("vw_header");
		$this->load->view("vw_navbar");
		if($role=="fitpageadmin"){

			$this->load->view("vw_admincontrolpanel");
		}
		$this->load->view('vw_dashboard');
	}

	public function getcourses(){
		echo $this->Mdl_courses->listcourses();
	}

	public function logout(){
		$this->session->unset_userdata("useroffit");
		redirect("authenticate");
	}

	public function viewuserdetails(){
		$this->load->view("vw_header");
		$this->load->view("vw_navbar");
		$data["user"]=$this->session->userdata("useroffit");
		$this->load->view("vw_usersettings",$data);
	}

	public function getuserprofile(){
		echo $this->Mdl_user->getprofile();
	}

	public function deleteuser(){
		$a=$this->Mdl_user->deleteusermdl();
		if($a){
			echo "<script>alert('Account Deleted Sucessfully')</script>";
			$this->logout();
		}else{
			echo "<script>alert('Try Again..')</script>";
		}
		
	}
}
