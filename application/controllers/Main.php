<?php
class MainController extends CI_Controller {
	function index(){
		echo 'this is work origin';
	}
	
	function view() {
		if (ENVIRONMENT!='development')
			throw new MyException('',MyException::NO_RIGHTS);
		$url=$this->input->get('view');
		$this->load->view($url);
	}
}