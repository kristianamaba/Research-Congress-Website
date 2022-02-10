<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rcw_model extends CI_Model {
  
	public function __construct(){
	parent::__construct();

	// Load base_url 
	$this->load->helper('url');
	$this->load->library('encryption');
	}
	
	
	function insertIP($id){
		$this->db->query("SET sql_mode = '' ");
		$data = array(
				'SubmissionID' => $id,
				'IP' => $this->getIP(),
				'DateDownloaded' => date('Y-m-d H:i:s')
		);
		$this->db->insert('download_stats', $data);
	}
	
	function getIP(){
		$ip = "";
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		
		return $ip;
	}
	
	
	function getArticle($id){
		$this->db->query("SET sql_mode = '' ");
		
		$response = array();
		$this->db->select("a.ArticleID, b.FirstName, b.LastName, a.Photo, a.Title, a.Content, a.CreatedAt");
		$this->db->join('user b', 'a.UserID = b.UserID');
		
		$WhereArray = array('a.Status' => '1', 'a.ArticleID' => $id);
		$this->db->where($WhereArray); 
		$this->db->order_by('a.ArticleID','DESC');
		$records = $this->db->get('articles a');
		$response = $records->result_array();
		return $response;
	}
	
	function getArticles($limit){
		$this->db->query("SET sql_mode = '' ");
		
		$response = array();
		$this->db->select("a.ArticleID, b.FirstName, b.LastName, a.Photo, a.Title, a.Content, a.CreatedAt");
		$this->db->join('user b', 'a.UserID = b.UserID');
		
		$WhereArray = array('a.Status' => '1');
		$this->db->where($WhereArray); 
		$this->db->order_by('a.ArticleID','DESC');
		$this->db->limit($limit);
		$records = $this->db->get('articles a');
		$response = $records->result_array();
		return $response;
	}
	
	
	function changeForgotPass($UserID,$Password){
		$this->db->query("SET sql_mode = '' ");
		$data = array(
        'Password' => $this->encryption->encrypt($Password)
		);
		$WhereArray = array('UserID' => $UserID);
		$this->db->where($WhereArray); 
		$this->db->update('user', $data);
	}
	
	
	function forgotPass($postData=array()){
		$this->db->query("SET sql_mode = '' ");
		
		$response = array();
		$email = $this->cleanS($postData['email']);
		
		if(!empty($email)){
			// Select ID and PIN stat
			$this->db->select('UserID,FirstName,LastName,Email,Disabled');
			$WhereArray = array('Email' => $email);
			$this->db->where($WhereArray); 
			$records = $this->db->get('user');
			$response = $records->result_array();
		}
		return $response;
	}
	
	function sendMail($subject,$toEmail,$content){
	  
		if(isset($subject)&&isset($toEmail)&&isset($content)){
			
			
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,false);
			$params = array(
				"s"=>$subject,
				"to"=>$toEmail,
				"m"=>$content);
			curl_setopt($ch,CURLOPT_URL,'https://teachermaestro.pyo.kuy.mybluehost.me/r/mail');
			curl_setopt($ch,CURLOPT_POST,true);
			curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($params));
			curl_setopt($ch, CURLOPT_USERAGENT, 'api');
			curl_setopt($ch, CURLOPT_TIMEOUT, 1); 
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
			curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 10); 
			curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
			curl_exec($ch);   
			curl_close($ch);
		}
	}
	
	function getTracking($ConferenceID,$SubmissionID){
		$UserID = $this->session->userdata('UserID');
		$this->db->query("SET sql_mode = '' ");
		
		$response = array();
		$this->db->select("*,
				concat('{\"Description\": [', GROUP_CONCAT(concat('\"',b.Description, '\"')), ']',
			'}') as Array_String");
		$this->db->join('conference c', 'a.ConferenceID = c.ConferenceID');
		$this->db->join('submission_log b', 'a.SubmissionID = b.SubmissionID');
		
		$WhereArray = array('c.ConferenceID' => $ConferenceID, 'a.SubmissionID' => $SubmissionID);
		$this->db->where($WhereArray); 
		$this->db->group_by('a.SubmissionID');
		$records = $this->db->get('submission a');
		$response = $records->result_array();
		return $response;
	}
	
	function getHistory(){
		$UserID = $this->session->userdata('UserID');
		$this->db->query("SET sql_mode = '' ");
		
		$response = array();
		$this->db->select("*,
				concat('{\"Description\": [', GROUP_CONCAT(concat('\"',b.Description, '\"')), ']',
			'}') as Array_String");
		$this->db->join('conference c', 'a.ConferenceID = c.ConferenceID');
		$this->db->join('submission_log b', 'a.SubmissionID = b.SubmissionID');
		
		$WhereArray = array('a.UserID' => $UserID);
		$this->db->where($WhereArray); 
		$this->db->group_by('a.SubmissionID');
		$this->db->order_by('a.SubmissionID','DESC');
		$records = $this->db->get('submission a');
		$response = $records->result_array();
		return $response;
	}
	
	function getResearch($id){
		$this->db->query("SET sql_mode = '' ");
		
		$response = array();
		$this->db->select("a.ConferenceID,c.Name,c.Acronym,a.Keywords,c.TopicKeywords, a.SubmissionID, a.Title, a.Abstract,a.File,a.Date,
			concat('{',
				concat('\"Authors\": [', GROUP_CONCAT(concat('\"',b.LastName, '\",'),concat('\"',b.FirstName, '\"')), ']'),
			'}') as Array_String");
		$this->db->join('conference c', 'a.ConferenceID = c.ConferenceID');
		$this->db->join('submission_author b', 'a.SubmissionID = b.SubmissionID');
		
		$WhereArray = "a.Status = 2";
		$this->db->where(array("a.SubmissionID" => $id));
		$this->db->where($WhereArray); 
		$this->db->group_by('a.SubmissionID');
		
		$records = $this->db->get('submission a');
		$response = $records->result_array();
		return $response;
	}
	
	function getArchive($limit,$id){
		$this->db->query("SET sql_mode = '' ");
		
		$response = array();
		
		
		$this->db->select("a.ConferenceID,c.Acronym,a.Keywords,c.TopicKeywords,c.Name, a.SubmissionID, a.Title, a.Abstract,a.File,a.Date,
			concat('{',
				concat('\"Authors\": [', GROUP_CONCAT(concat('\"',b.LastName, '\",'),concat('\"',b.FirstName, '\"')), ']'),
			'}') as Array_String ");
		$this->db->join('conference c', 'a.ConferenceID = c.ConferenceID');
		$this->db->join('submission_author b', 'a.SubmissionID = b.SubmissionID');
		
		$WhereArray = array("a.Status" => "2",
							"c.Acronym" => $id);
		
		$this->db->where($WhereArray); 
		$this->db->group_by('a.SubmissionID');
		
		$this->db->order_by('a.SubmissionID','desc');
		$this->db->limit($limit);
		$records = $this->db->get('submission a');
		$response = $records->result_array();
		return $response;
	}
	
	
	function getResearches($limit,$c,$s,$y,$so){
		$s = $this->cleanS($s);
		$this->db->query("SET sql_mode = '' ");
		$year = strtotime(date("Y").' -'.$y.' year');
		
		$response = array();
		
		
		$words = explode(" ", $s);
		$wordscode = ",";
		foreach ($words as $code) {
			$wordscode .= "( c.Acronym LIKE '%" . $code . "%' ) +";
			$wordscode .= "( a.Keywords LIKE '%" . $code . "%' ) +";
			$wordscode .= "( a.Title LIKE '%" . $code . "%' ) +";
			$wordscode .= "( a.Abstract LIKE '%" . $code . "%' ) +";
			$wordscode .= "( b.LastName LIKE '%" . $code . "%' ) +";
			$wordscode .= "( b.FirstName LIKE '%" . $code . "%' ) +";
		}
		$wordscode = substr($wordscode,0,-2);
		$wordscode .= "AS score";
		
		
		$this->db->select("a.ConferenceID,c.Acronym,a.Keywords,c.TopicKeywords, a.SubmissionID, a.Title, a.Abstract,a.File,a.Date,
			concat('{',
				concat('\"Authors\": [', GROUP_CONCAT(concat('\"',b.LastName, '\",'),concat('\"',b.FirstName, '\"')), ']'),
			'}') as Array_String ".(strlen($wordscode)<=10 ? "": $wordscode));
		$this->db->join('conference c', 'a.ConferenceID = c.ConferenceID');
		$this->db->join('submission_author b', 'a.SubmissionID = b.SubmissionID');
		
		
		$countrycode = "AND (";
		foreach ($c as $code) {
			$countrycode .= " b.country = '" . $code . "' OR";
		}
		$countrycode = substr($countrycode,0,-2);
		$countrycode .= ")";
		
		
		
		
		$words = explode(" ", $s);
		$wordscode = "AND (";
		foreach ($words as $code) {
			$wordscode .= " c.Acronym LIKE '%" . $code . "%' OR";
			$wordscode .= " a.Keywords LIKE '%" . $code . "%' OR";
			$wordscode .= " a.Title LIKE '%" . $code . "%' OR";
			$wordscode .= " a.Abstract LIKE '%" . $code . "%' OR";
			$wordscode .= " b.LastName LIKE '%" . $code . "%' OR";
			$wordscode .= " b.FirstName LIKE '%" . $code . "%' OR";
		}
		$wordscode = substr($wordscode,0,-2);
		$wordscode .= ")";
		
		$WhereArray = "a.Status = 2 AND YEAR(a.Date) >= ".date('Y', $year)." ".(strlen($countrycode)<=10 ? "": $countrycode)." ".(strlen($wordscode)<=10 ? "": $wordscode);

		
		
		
		$this->db->where($WhereArray); 
		$this->db->group_by('a.SubmissionID');
		
		if($so=="REV")
			$this->db->order_by('score','DESC');
		else
			$this->db->order_by('a.SubmissionID',$so);
		$this->db->limit($limit);
		$records = $this->db->get('submission a');
		$response = $records->result_array();
		return $response;
	}
	
	
	
	
	function submitResearch($postData=array(), $data_loc){
		$UserID = $this->session->userdata('UserID');
		$this->db->query("SET sql_mode = '' ");
		$data = array(
				'ConferenceID' => $postData['id'],
				'UserID' => $UserID,
				'Title' => $this->cleanS($postData['title']),
				'Abstract' => $this->cleanS($postData['abstract']),
				'Keywords' => $this->cleanS($postData['keys']),
				'Date' => date('Y-m-d'),
				'File' => $data_loc,
				'Status' => '1'
		);
		$this->db->insert('submission', $data);
		
		$SubmissionID = $this->db->insert_id();
		for($i=0; $i<count($postData['first_name']); $i++){
			$this->db->query("SET sql_mode = '' ");  

			$data = array(
					'SubmissionID' => $SubmissionID,
					'FirstName' => $this->cleanS($postData['first_name'][$i]),
					'LastName' => $this->cleanS($postData['last_name'][$i]),
					'Email' => $this->cleanS($postData['email'][$i]),
					'Country' => $this->cleanS($postData['country'][$i]),
					'Organization' =>$this->cleanS($postData['institution'][$i])
			);
			$this->db->insert('submission_author', $data);
		}
		
		$this->db->query("SET sql_mode = '' ");
		$data = array(
				'SubmissionID' => $SubmissionID,
				'Description' => date('Y-m-d H:i:s').": ".$this->session->userdata('FullName')." submitted this document."
		);
		$this->db->insert('submission_log', $data);
		
	}
	
	function checkSubmissionSameDay($id){
		$UserID = $this->session->userdata('UserID');
	    $this->db->query("SET sql_mode = '' ");
		$response = array();
		$this->db->select('count(*)');
		$WhereArray = array('ConferenceID' => $id,
							'Date' => date('Y-m-d'),
							'UserID' => $UserID);
		$this->db->where($WhereArray); 
		$this->db->from('submission');
		$records = $this->db->get();
		
		$response = $records->result_array();
		
		return $response[0]['count(*)'];
	}
	
	
	function getConferenceDetails($id){
		
		$this->db->query("SET sql_mode = '' ");
		
		
		$response = array();
		$this->db->select('*');
		$WhereArray = array('Acronym' => $id);
		$this->db->where($WhereArray); 
		$records = $this->db->get('conference');
		$response = $records->result_array();
		
		return $response;
	}
	
	
	function getAllConference($limit, $m, $s){
		$this->db->query("SET sql_mode = '' ");
		
		$response = array();
		$this->db->select('ConferenceID,Name,Acronym,Venue,DeadlineSubmission,DeadlineAbstract,TopicKeywords');
		
		$wordscode = "(";
		foreach ($m as $code) {
			$wordscode .= " MONTH(DeadlineSubmission) = " . $code . " OR";
		}
		$wordscode = substr($wordscode,0,-2);
		$wordscode .= ")";
		
		$WhereArray = (strlen($wordscode)<=10 ? "": $wordscode);
		if (!empty($WhereArray))
			$this->db->where($WhereArray); 
			
		if($s==2||$s==3)
			$this->db->where(" DeadlineSubmission ". ($s==2 ? ">= ":"< "), date('Y-m-d')); 
			
		
		$this->db->order_by('DeadlineSubmission','DESC');
		$this->db->limit($limit);
		$records = $this->db->get('conference');
		$response = $records->result_array();
		for($i = 0; $i < count($response); $i++){
		  $response[$i]['ConferenceID'] = $this->encryption->encrypt($response[$i]['ConferenceID']);
		}
		return $response;
	}
	
	function addUserLogs($UserID,$Action,$CreatedAt){ 

		$this->db->query("SET sql_mode = '' ");
		$data = array(
				'UserID' => $UserID,
				'Action' => $Action,
				'CreatedAt' => $CreatedAt,
				'Date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('user_log', $data);
	}
	
	
	
	
	function getAccountDetailsFromEmailandPass($postData=array()){
		$this->db->query("SET sql_mode = '' ");
		
		$response = array();
		$email = $this->cleanS($postData['email']);
		
		
		if(!empty($email)&&!empty($postData['pass'])){

			// Select ID and PIN stat
			$this->db->select('UserID,FirstName,LastName,Password,RoleID,Email,RoleID,Disabled');
			$WhereArray = array('Email' => $email);
			$this->db->where($WhereArray); 
			$records = $this->db->get('user');
			$response = $records->result_array();
			if(count($response)>=1){
				if($this->encryption->decrypt($response[0]['Password'])!=$postData['pass'])
					$response = array();
			}
		}
		return $response;
	}
	
	function changeSettings($postData=array()){
		$UserID = $this->session->userdata('UserID');
		$this->db->query("SET sql_mode = '' ");
		$data = array(
        'Password' => $this->encryption->encrypt($postData['pass'])
		);
		$WhereArray = array('UserID' => $UserID);
		$this->db->where($WhereArray); 
		$this->db->update('user', $data);
		return '1';
		
	}
	
	function createAccount($postData=array()){
		//$this->encryption->encrypt("zxczxc");
		$this->db->query("SET sql_mode = '' ");
		if(!empty($postData['email'])&&!empty($postData['first_name'])&&!empty($postData['type']&&($postData['type']==4||$postData['type']==5)) ){
			
			if($this->checkEmailExist($postData['email'],'')=='0'){
				
				$email = $this->cleanS($postData['email']);
				$cDate = date('Y-m-d H:i:s');
				
				$data = array(
					'Created' => $cDate,
					'Updated' => $cDate,
					'UpdatedBy' => '0',
					'FirstName' => $this->cleanS($postData['first_name']),
					'LastName' => $this->cleanS($postData['last_name']),
					'Email' => $email,
					'Password' => $this->encryption->encrypt($postData['pass']),
					'RoleID' => $this->cleanS($postData['type']),
					'InvitedBy' => '0');
				
				if($postData['type']==5)
					$data['Activated'] = $cDate;
				else if($postData['type']==4)
					$data['Disabled'] = $cDate;
					
				$this->db->insert('user', $data);
				
				return '1';
			}
			else{
				return 'Email Already Exist';
			}
		}
		return 'Something Went Wrong';
	}
  
	function checkEmailExist($email= null,$curEmail= null){
	    $this->db->query("SET sql_mode = '' ");
		$response = array();
		$this->db->select('count(*)');
		$WhereArray = array('Email' => $email);
		$this->db->where($WhereArray); 
		$this->db->from('user');
		$records = $this->db->get();
		
		$response = $records->result_array();
		
		return ($curEmail==$email? '0': $response[0]['count(*)']);
	}
  
	function generate_string($strength = null) {
		$this->db->query("SET sql_mode = '' ");
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$permitted_chars_length = strlen($permitted_chars);
		$random_string = '';
		for($i = 0; $i < $strength; $i++) {
			$random_character = $permitted_chars[mt_rand(0, $permitted_chars_length - 1)];
			$random_string .= $random_character;
		}
		return $random_string;
	}
	
	function numOnly($t){
		return preg_replace('/\D/', '', $t);
	}
  
	function cleanS($t){
		return mysql_real_escape_string(str_replace(array(';','\\',"'",'"'), '',strip_tags($t)));
	}

}
?>