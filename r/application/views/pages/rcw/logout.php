<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($this->session->userdata('remember')=="1"){
	$this->session->set_userdata('LoggedIn', '0');
}
else{
	$this->session->sess_destroy();
}

header('Location: ./index');


?>