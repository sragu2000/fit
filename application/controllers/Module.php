<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//class to add articles, edit, delete, update
class Module extends CI_Controller {
    public function __construct($config="rest") {
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		parent::__construct();
		$this->load->model('Mdl_user');
		$this->load->model('Mdl_courses');
		if(! $this->Mdl_user->sessionCheck()){
			$pageUrl=current_url();
            $this->session->set_userdata('myurl',$pageUrl);
			redirect("authenticate/login");
		}
	}
	public function addArticles(){
		$this->load->view("vw_header");
		$this->load->view("vw_navbar");
		$this->load->view("courses/vw_addarticles");
	}

    //call from addarticle view
    public function submitArticle(){
        $flag=$this->Mdl_courses->addArticles();
        $this->sendJson(array("message"=>$flag["message"],"result"=>$flag["result"]));
    }

    private function sendJson($data) {
        $this->output->set_header('Content-Type: application/json; charset=utf-8')->set_output(json_encode($data));
    }

    public function showArticles($moduleid){
        echo $this->Mdl_courses->mdlshowArticle($moduleid);
    }
}
