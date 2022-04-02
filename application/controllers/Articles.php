<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Controller {
	public function __construct($config="rest") {
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		parent::__construct();
		$this->load->model('Mdl_user');
		$this->load->model('Mdl_courses');
        $this->load->model('Mdl_articles');
		if(! $this->Mdl_user->sessionCheck()){
			redirect("authenticate/login");
		}
	}
    //list articles
    public function myarticles(){
        echo $this->Mdl_articles->showMyArticles();
    }
    //read Articles
    public function readArticle($articleid){
        $this->load->view("vw_header");
        $this->load->view("vw_navbar");
        $arr["articleid"]=$articleid;
        $this->load->view("vw_readarticles",$arr); 
    }
    public function postRead($articleid){
        echo $this->Mdl_articles->getOneArticle($articleid);
    }
    public function editarticle($articleid){
        $data["articledata"]=$this->Mdl_articles->getOneArticle($articleid);
        $this->load->view("vw_header");
        $this->load->view("vw_navbar");
        $this->load->view("vw_updatearticles",$data);
    }
    //from vw_updatearticles
    public function postUpdate(){
        $flag=$this->Mdl_articles->updateOneArticle();
        $this->sendJson(array("message"=>$flag["message"],"result"=>$flag["result"]));
    }

    public function deletearticle($articleid){
        $flag=$this->Mdl_articles->deleteOneArticle($articleid);
        if($flag){
            echo "<script>alert('Deleted successfully');</script>";
        }else{
            echo "<script>alert('Error Try Again');</script>";
        }
        redirect("view/myarticles");
    }

    private function sendJson($data) {
        $this->output->set_header('Content-Type: application/json; charset=utf-8')->set_output(json_encode($data));
    }
}
