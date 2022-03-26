<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_articles extends CI_Model {
    public function showMyArticles(){
        $authorid=$this->session->userdata('useroffit');
        $flag=$this->db->query("SELECT articleid as id, adate as date,articleheading as heading,articletext as lesson FROM fitarticles WHERE authorid='$authorid'")->result();
        return json_encode($flag,true);
    }

    public function getOneArticle($aid){
        $res=$this->db->query("select articleid as id, adate as date, articleheading as heading, articletext as lesson from fitarticles where articleid='$aid'")->result();
        return json_encode($res,true);        
    }

    public function getOneArticleNormal($aid){
        $res=$this->db->query("select articleid as id, adate as date, articleheading as heading, articletext as lesson from fitarticles where articleid='$aid'")->result();
        return $res;        
    }

    public function deleteOneArticle($aid){
        if($this->db->query("delete from fitarticles where articleid='$aid'")){
            return true;
        }else{
            return false;
        }
    }

    public function updateOneArticle(){
        $heading=$this->input->post('heading');
        $articletext=$this->input->post('articletext');
        $aid=$this->input->post('aid');
        if($this->db->query("update fitarticles set articletext='$articletext' , articleheading='$heading' where articleid='$aid'")){
            return array("message"=>"Update Success","result"=>true);
        }else{
            return array("message"=>"Update Failed","result"=>false);
        }
    }
}