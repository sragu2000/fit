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
		if(!$this->Mdl_user->sessionCheck()){
            $pageUrl=current_url();
            $this->session->set_userdata('myurl',$pageUrl);
			redirect("authenticate/login");
		}
	}
    //list articles
    public function myarticles(){
        echo $this->Mdl_articles->showMyArticles();
    }
    //read Articles
    public function readArticle($articleid=NULL){
        $this->load->view("vw_header");
        $this->load->view("vw_navbar");
        $arr["articleid"]=$articleid;
        $this->load->view("vw_readarticles",$arr); 
    }
    public function postRead($articleid=NULL){
        echo $this->Mdl_articles->getOneArticle($articleid);
    }
    public function editarticle($articleid=NULL){
        $this->load->view("vw_header");
        $this->load->view("vw_navbar");
        $canUserEdit=$this->Mdl_articles->canUserEditThisArticle($articleid);
        if($canUserEdit){
            $data["articleid"]=$articleid;
            $this->load->view("vw_updatearticles",$data);
        }else{
            $this->load->view("vw_showerror");
        }
        
    }
    //from vw_updatearticles
    public function postUpdate(){
        $articleid=$this->input->post('aid');
        if($this->Mdl_articles->canUserEditThisArticle($articleid)){
            $flag=$this->Mdl_articles->updateOneArticle();
            $this->sendJson(array("message"=>$flag["message"],"result"=>$flag["result"]));  
        }else{
            $this->sendJson(array("message"=>"You can't edit this article","result"=>false));  
        }
    }

    public function deletearticle($articleid=NULL){
        if($this->Mdl_articles->canUserEditThisArticle($articleid)){
            $flag=$this->Mdl_articles->deleteOneArticle($articleid);
            if($flag){
                echo "<script>alert('Deleted successfully');</script>";
            }else{
                echo "<script>alert('Error Try Again');</script>";
            }
            redirect("view/myarticles");
        }else{
            echo "You cant Delete this article...";
        }
       
    }

    private function sendJson($data=NULL) {
        $this->output->set_header('Content-Type: application/json; charset=utf-8')->set_output(json_encode($data));
    }

    public function fetchArticle($num=NULL){
        echo $this->Mdl_articles->getOneArticle($num);;
    }
}
