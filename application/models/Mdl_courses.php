<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_courses extends CI_Model {
    public function listcourses(){
        $flag=$this->db->query("SELECT * FROM fitmodules")->result();
        // $flag= $this->db->query("SELECT * FROM fitmodules");
        return json_encode($flag,true);

    }
    public function mdlshowArticle($modid){
        $flag=$this->db->query("SELECT authorid as user, articleid as aid, adate as date,articleheading as heading,articletext as lesson FROM fitarticles WHERE moduleid='$modid'")->result();
        return json_encode($flag,true);
    }
    public function addArticles(){
        $arr['moduleid']=$this->input->post('module');
        $arr['authorid']=$this->session->userdata('useroffit');
        $arr['adate']=date("Y/m/d");
        $arr['atime']=date("h:i:sa");
        $arr['articleheading']=$this->input->post('heading');
        $arr['articletext']=$this->input->post('articletext');
        if(!(empty($arr['moduleid'])&&empty($arr['articletext'])&&empty($arr['articleheading']))){
            if($this->db->insert("fitarticles",$arr)){
                return array("message"=>"Success","result"=>true);
            }else{
                return array("message"=>"Failed","result"=>false);
            }
        }else{
            return array("message"=>"Empty Input","result"=>false);
        }
        
    }
}
