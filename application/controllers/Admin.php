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
			$pageUrl=current_url();
            $this->session->set_userdata('myurl',$pageUrl);
			redirect("authenticate/login");
		}
        $role=$this->Mdl_user->getUserRole();
        if($role != "fitpageadmin"){
            redirect("authenticate/login");
        }
	}
	public function manageModule(){
		$this->load->view("vw_header",array("title"=>"Manage Modules"));
        $this->load->view("vw_navbar");
        $this->load->view("vw_modules");
	}
    public function index(){
        $this->load->view("vw_header",array("title"=>"Admin"));
        $this->load->view("vw_navbar");
        $this->load->view("vw_admin");
    }
	public function promoteUser(){
		$this->load->view("vw_header",array("title"=>"Promote User"));
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
			$this->sendJson(array("message"=>"Success", "result"=>true));
		}else{
			$this->sendJson(array("message"=>"Failed", "result"=>false));
		}
	}

	public function editModule($oldmoduleid=NULL, $modulename=NULL, $moduleid=NULL, $forcourse=NULL){
		if(!(empty(trim($oldmoduleid)) && empty(trim($modulename)) && empty(trim($moduleid)) && empty(trim($forcourse)))){
			$flag=$this->Mdl_admin->editThisModule(urldecode($oldmoduleid), urldecode($modulename), urldecode($moduleid), urldecode($forcourse));
			if($flag){
				$this->sendJson(array("message"=>"Success", "result"=>true));
			}else{
				$this->sendJson(array("message"=>"Failed", "result"=>false));
			}
		}else{
			$this->sendJson(array("message"=>"Inputs cannot be blank", "result"=>false));
		}
		
	}

	public function createModule($modulename, $moduleid, $forcourse){
		if(!(empty(trim($moduleid))  && empty(trim($modulename)) && empty(trim($forcourse)))){
			$moduleid=preg_replace('/\s+/', '', urldecode($moduleid));
			$flag=$this->Mdl_admin->createThisModule(urldecode($modulename), urldecode($moduleid), urldecode($forcourse));
			if($flag){
				$this->sendJson(array("message"=>"Success", "result"=>true));
			}else{
				$this->sendJson(array("message"=>"Failed", "result"=>false));
			} 
		}else{
			$this->sendJson(array("message"=>"Inputs cannot be blank", "result"=>false));
		}
		
	}
}
