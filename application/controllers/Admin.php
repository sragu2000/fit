<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct($config="rest") {
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		parent::__construct();
		$this->load->model('Mdl_user');
		$this->load->model("Mdl_admin");
		$this->load->model('Mdl_courses');
		if(! $this->Mdl_user->sessionCheck()){
			redirect("authenticate/login");
		}
        $role=$this->Mdl_user->getUserRole();
        if($role != "fitpageadmin"){
            redirect("authenticate/login");
        }
	}
	public function manageModule(){
		$this->load->view("vw_header");
        $this->load->view("vw_navbar");
        $this->load->view("vw_modules");
	}
    public function index(){
        $this->load->view("vw_header");
        $this->load->view("vw_navbar");
        $this->load->view("vw_admin");
    }
	public function promoteUser(){
		$this->load->view("vw_header");
		$this->load->view("vw_navbar");
		$this->load->view("adminarea/vw_promoteuser");
	}
	public function listuser(){
		echo $this->Mdl_admin->listuserprofiles();
	}
	public function promote(){
		$flag=$this->Mdl_admin->promoteme();
		$this->sendJson(array("message"=>$flag["message"], "result"=>$flag["message"]));
	}
	private function sendJson($data) {
	  $this->output->set_header('Content-Type: application/json; charset=utf-8')->set_output(json_encode($data));
	}
	public function deleteModule($moduleId){
		$flag=$this->Mdl_admin->deleteThisModule($moduleId);
		if($flag){
			echo "<script> alert('Module Deleted Successfully'); </script>";
			redirect("admin/manageModule");
		}else{
			echo "<script> alert('Error'); </script>";
		}
	}

	public function editModule($oldmoduleid, $modulename, $moduleid, $forcourse){
		$flag=$this->Mdl_admin->editThisModule(urldecode($oldmoduleid), urldecode($modulename), urldecode($moduleid), urldecode($forcourse));
		if($flag){
			echo "<script> alert('Module Edited Successfully'); </script>";
			redirect("admin/manageModule");
		}else{
			echo "<script> alert('Error'); </script>";
		}
	}
}
