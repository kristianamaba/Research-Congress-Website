<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller{
	public function __construct(){
		parent::__construct();

		// Load Model
		$this->load->model('Rcw_model');

		// Load base_url
		$this->load->helper('url');
	}
  
	function view($page = 'index')
	{
		$page = strtolower($page);
		/**
		USELESS CODES START
		$WebAr = array("rcw","rms","cms");
		
			WebAr -  Folder Name Per Group
			0 - Research Conference Website
			1 - Research Management System
			2 - Conference Management System 
			
			To change website, use this
			$this->session->set_userdata('web', '0');
		$web = (empty($this->session->userdata('web')) ? $WebAr[0] : $this->session->userdata('web'));
		USELESS CODES END
		*/
		$pageAr = explode("-", $page);
		
		
		if($pageAr[0]=="admin"){
			$web="admin";
			$page = (count($pageAr)>=2 ? (empty($pageAr[1])? "index": $pageAr[1]):"index");
		}
		else{
			$web="rcw";
		}
		
		if( !file_exists("application/views/pages/$web/".$page.'.php'))
		{
			$this->load->view("pages/rcw/404");
		}
		else{
			
			/*
			PAGE CODES
			
			
			
			*/
			
			
			
			//DEFINE FOLDER (admin/rcw)
			$data["web"] = $web;
			
			
			//Research Conference Website START
			if($web=="rcw"){
				$data["data2"] = $this->Rcw_model->getAllConference(5,array(),"");
				$data["data3"] = $this->Rcw_model->getArticles(3);
				if($page=="conferences"){
					$m = (isset($_GET['month']) ? $_GET['month'] : array());
					$s = (isset($_GET['all']) ? $_GET['all'] : "");
					$data["data"] = $this->Rcw_model->getAllConference(30,$m,$s);
				}
				else if($page=="archives"){
					$data["data"] = $this->Rcw_model->getAllConference(30,array(),3);
				}
				else if($page=="archive"){
					if(isset($_GET['id'])){
						$data["data"] = $this->Rcw_model->getArchive(30,$_GET['id']);
					}
				}
				else if($page=="index"){
					//$data["data"] = $this->Rcw_model->getResearches(5,array(),"","20","DESC");
					$data["data"] = $this->Rcw_model->getArticles(10);
				}
				else if($page=="search"){ 
					$c = (isset($_GET['country']) ? $_GET['country'] : array());
					$s = (isset($_GET['s']) ? $_GET['s'] : "xmnxczvcznx");
					$y = (isset($_GET['years']) ? date("Y")- preg_replace('/\D/', '',$_GET['years'])  : date("Y")-20);
					$so = (isset($_GET['sort']) ? $_GET['sort'] : "REV");
					$data["data"] = $this->Rcw_model->getResearches(30,$c,$s,$y,$so);
				}
				else if($page=="research"&&!empty($_GET['r'])){ 
					if(strlen($_GET['r'])>=11){
						$id = $_GET['r'];
						$id = substr_replace($id, "", -5);
						$id = substr($id, 5);
						$data["data"] = $this->Rcw_model->getResearch($id);
					}
				}
				else if($page=="history"){
					$data["data"] = $this->Rcw_model->getHistory();
				}
				else if($page=="tracking"&&!empty($_GET['id'])){
					$words = explode("-", $_GET['id']);
					if(count($words)==3&&trim($words[0])=="RCS")
						$data["data"] = $this->Rcw_model->getTracking(preg_replace('/\D/', '',"0".$words[1])-2049,preg_replace('/\D/', '',"0".$words[2])-3630);
				}
				else if($page=="conference"){
					if(isset($_GET['id']))
						$data["data"] = $this->Rcw_model->getConferenceDetails($_GET['id']);
						if (isset($data["data"][0]['ConferenceID'])&&$this->session->userdata('LoggedIn')=="1"){
							$data["confirm"] =  $this->Rcw_model->checkSubmissionSameDay($data["data"][0]['ConferenceID']);
						}
				}
				else if($page=="submit-now"){
					if(isset($_GET['id'])){
						$data["data"] = $this->Rcw_model->getConferenceDetails($_GET['id']);
						 
						if (isset($data["data"][0]['ConferenceID'])){
							$data["confirm"] =  $this->Rcw_model->checkSubmissionSameDay($data["data"][0]['ConferenceID']);
						}
					}
				}
				else if($page=="article"&&!empty($_GET['r'])){ 
					if(strlen($_GET['r'])>=11){
						$id = $_GET['r'];
						$id = substr_replace($id, "", -5);
						$id = substr($id, 5);
						$data["data"] = $this->Rcw_model->getArticle($id);
					}
				}
			}
			//Research Conference Website END
			
			
			
			//LOAD WEBPAGE
			$this->load->view("pages/$web/".$page, $data);
		}
		
	}
	
}


?>