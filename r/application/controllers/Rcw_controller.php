<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rcw_controller extends CI_Controller {
	public function __construct(){
	parent::__construct();

	// Load Model
	$this->load->model('Rcw_model');

	// Load base_url 
	$this->load->helper('url');
	}
	
	function test(){
		echo "this is a test";
	}
	
	function insertIP(){
		// POST data
		$postData = $this->input->post();
		if(strlen($postData['id'])>=11){
			$id = $postData['id'];
			$id = substr_replace($id, "", -5);
			$id = substr($id, 5);
			$this->Rcw_model->insertIP($id);
			echo "1";
		}else{
			echo "Error: Can't Download.";
		}
		
	}
	
	function changeForgotPass(){
		// POST data
		$postData = $this->input->post();

		// get data 
		$data = $this->Rcw_model->forgotPass($postData);
		
		if(count($data)<=0){
			echo "Account Does not Exist!";
		}
		else{
			if($data[0]['Disabled']=="1")
				echo "Account Disabled";
			else {
				$NewPass = $this->generate_string(10);
				$this->Rcw_model->changeForgotPass($data[0]['UserID'],$NewPass);
				$message = "Dear ". $data[0]['FirstName'] ." ".  $data[0]['LastName'] ." <br><br>
					You have requested for a password reset. The following is your new password.<br><br>
					
					". $NewPass  ."
					<br><br>
					
					Please Note that you can change your password on the account profile when you logged in.<br><br><br>
					______________________________________________<br><br>
					This is an automated message, do not reply.";
				$message = preg_replace('/\s+/', ' ', $message);
				$this->Rcw_model->sendMail("Research Conference Website Confirmation ".$this->generate_string(5),$data[0]['Email'],$message);
				echo "1";
			}
		}
	}
	
	public function forgotPass(){
		// POST data
		$postData = $this->input->post();

		// get data 
		$data = $this->Rcw_model->forgotPass($postData);
		
		if(count($data)<=0){
			echo "Account Does not Exist!";
		}
		else{
			if($data[0]['Disabled']=="1")
				echo "Account Disabled";
			else {
				$message = "Dear ". $data[0]['FirstName'] ." ".  $data[0]['LastName'] ." <br><br>
					We recieved a request for a password reset. To reset password, 
					please do enter this code on the form.<br><br>
					
					". $postData['code'] ."
					<br><br>
					
					Please Note that this code will only be valid on the form. If you fail to enter the code, you will have to re-apply for password reset again.<br><br><br>
					______________________________________________<br><br>
					This is an automated message, do not reply.";
				$message = preg_replace('/\s+/', ' ', $message);
				$this->Rcw_model->sendMail("Research Conference Website Confirmation ".$this->generate_string(5),$data[0]['Email'],$message);
				echo "1";
			}
		}
	} 
	
	
	function sendConfirm(){
		$postData = $this->input->post();
		
		// get data 
		$data = $this->Rcw_model->forgotPass($postData);
		
		if($this->checkEmpty($postData)){
			echo "Empty/Invalid Input";
		}
		else if(strlen(trim($postData['pass']))<8){
			echo "Invalid Password, Please Enter more then 8 characters.";
		}
		else if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
			echo "Invalid Email Address";
		}
		else if(count($data)<=0){
			$message = "Dear ". $postData['first_name'] ." ". $postData['last_name'] ." <br><br>
				We recieved a request to create an account for you. To create an account, 
				please do enter this code on the registration form.<br><br>
				
				". $postData['code'] ."
				<br><br>
				
				Please Note that this code will only be valid on the form. If you fail to enter the code, you will have to apply for an account again.<br><br><br>
				______________________________________________<br><br>
				This is an automated message, do not reply.";
			$message = preg_replace('/\s+/', ' ', $message);
			$this->Rcw_model->sendMail("Research Conference Website Confirmation ".$this->generate_string(5),$postData['email'],$message);
			echo "1";
		}
		else{
			echo "Email Already Exist";
		}
	}
	
	function checkEmpty($arr=array()){
		foreach ($arr as $key => $value) {
			if(is_array($value)){
				foreach ($value as $key2 => $value2) {
					if($key=="email"&&!filter_var($value2, FILTER_VALIDATE_EMAIL))
						return true;
					else if(empty($this->Rcw_model->cleanS($value2)))
						return true;
				}
			}
			else if(empty($this->Rcw_model->cleanS($value)))
				return true;
		}
		return false;
	}
	
	function askMail(){
		// POST data
		$postData = $this->input->post();
		
		if($this->checkEmpty($postData)){
			echo "Empty/Invalid Input";
		}
		else if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
			echo "Invalid Email Address";
		}
		else if ($this->session->userdata('askHelpDate')!=null){
			$to_time = strtotime($this->session->userdata('askHelpDate'));
			$from_time = strtotime(date('Y-m-d H:i:s'));
			if(round(abs($to_time - $from_time) / 60,2) <= 10){
				echo "Please wait a few minutes before you can send again.";
			}
			else{
				$this->session->set_userdata('askHelpDate', date('Y-m-d H:i:s'));
				$message = "A message recieved from ".$postData['email']."<br><br>".$postData['message']."<br><br>Ill expect a reply at: ".$postData['email'];
				$this->Rcw_model->sendMail("RCW-HELP: ".$postData['subject']." ".$this->generate_string(5),"kristianamaba.kka@gmail.com",$message);
				echo "1";
			}
		}
		else {
			$this->session->set_userdata('askHelpDate', date('Y-m-d H:i:s'));
			$message = "A message recieved from ".$postData['email']."<br><br>".$postData['message']."<br><br>Ill expect a reply at: ".$postData['email'];
			$this->Rcw_model->sendMail("RCW-HELP: ".$postData['subject']." ".$this->generate_string(5),"kristianamaba.kka@gmail.com",$message);
			echo "1";
		}
	}
	
	
	
	public function submitResearch(){
		// POST data
		$postData = $this->input->post();
		
		$new_name = time(). $this->generate_string(20);
		$config['file_name'] = $new_name;
		$config['upload_path']="./upload/";
        $config['allowed_types']='pdf';
        $this->load->library('upload',$config);
		if($this->checkEmpty($postData) || count(explode(",",$postData['keys'])) < 3){
			echo "Check Info Details";
		}
        else if($this->upload->do_upload("doc")){

			$doc_name = "./upload/".$this->upload->data()['file_name'];
			$this->Rcw_model->submitResearch($postData,$doc_name);
			echo "1";
		}
		else{
			echo "Insert a full copy of your research in PDF file";
		}
	}
	
	public function getConferenceTitle(){
		// POST data
		$postData = $this->input->post();

		// get data 
		$data = $this->Rcw_model->getConferenceDetails($postData);
		if(count($data)>=1)
			echo json_encode(array($data[0]['Name'],$data[0]['ConferenceID']));
		else
			echo json_encode(array("1"));
	}
	
	public function changeSettings(){
		// POST data
		$postData = $this->input->post();
		if($this->checkEmpty($postData)){
			echo "Empty/Invalid Input";
		}
		else if(strlen(trim($postData['pass']))<8){
			echo "Invalid Password, Please Enter more then 8 characters.";
		}
		else{
			// get data 
			$data = $this->Rcw_model->changeSettings($postData);
			echo $data;
		}
		
	} 
	
	public function createAccount(){
		// POST data
		$postData = $this->input->post();

		// get data 
		$data = $this->Rcw_model->createAccount($postData);
		echo $data;
	} 
	
	
	public function checkAccount(){
		// POST data
		$postData = $this->input->post();

		// get data 
		$data = $this->Rcw_model->getAccountDetailsFromEmailandPass($postData);
		

		if(count($data)<='0'){
			echo "Incorrect Email or Password";
		}
		else if(count($data)>='1'){
			if($data[0]['Disabled']!=null)
				echo "Account Deactivated, please contact admin";
			else {
				$this->session->set_userdata('FullName', $data[0]['LastName'].", ".$data[0]['FirstName']);
				$this->session->set_userdata('FirstName',$data[0]['FirstName']);
				$this->session->set_userdata('LastName',$data[0]['LastName']);
				if(isset($postData['remember'])){
					$this->session->set_userdata('remember', '1');
					$this->session->set_userdata('Pass', $postData['pass']);
				}
				else{
					$this->session->set_userdata('remember', '0');
				}
					
				$this->session->set_userdata('Email', $data[0]['Email']);
				$this->session->set_userdata('UserID', $data[0]['UserID']);
				$this->session->set_userdata('LoggedIn', '1');
				echo "1";
				if($data[0]['RoleID']==5){
					$this->session->set_userdata('web', '0');
					$this->Rcw_model->addUserLogs($data[0]['UserID'],'Logged In','Research Conference Website');
				}
				else if($data[0]['RoleID']<=3)
					$this->session->set_userdata('web', '2');
				}
			}
		}
	
	
	function generate_string($strength) {
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$permitted_chars_length = strlen($permitted_chars);
		$random_string = '';
		for($i = 0; $i < $strength; $i++) {
			$random_character = $permitted_chars[mt_rand(0, $permitted_chars_length - 1)];
			$random_string .= $random_character;
		}
		return $random_string;
	}
	

}

?>