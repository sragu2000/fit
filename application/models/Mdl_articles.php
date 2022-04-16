<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_articles extends CI_Model {
    public function showMyArticles(){
        $authorid=$this->session->userdata('useroffit');
        $flag=$this->db->query("SELECT articleid as id, adate as date,articleheading as heading,articletext as lesson FROM fitarticles WHERE authorid='$authorid'")->result();
        return json_encode($flag,true);
    }

    public function canUserEditThisArticle($articleid){
        $val=$this->db->query("SELECT * FROM fitarticles WHERE articleid='$articleid'")->first_row()->authorid;
        if ($val==$_SESSION['useroffit']){
            return true;
        }else{
            return false;
        }
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
        $arr["articleheading"]=$this->input->post('heading');
        $arr["articletext"]=$this->input->post('articletext');
        $aid=$this->input->post('aid');
        $user=$this->session->userdata('useroffit');
        if($this->db->query("select * from fitarticles where articleid='$aid'")->first_row()->authorid == $user){
            if(!(empty($arr["articleheading"])||empty($arr["articletext"]))){
                $this->db->where('articleid',$aid);
                if($this->db->update('fitarticles',$arr)){
                    return array("message"=>"Update Success","result"=>true);
                }else{
                    return array("message"=>"Update Failed","result"=>false);
                }
            }else{
                return array("message"=>"Empty Article","result"=>false);
            }
        }else{
            return array("message"=>"You can't edit this article...","result"=>false);
        }
    }
}