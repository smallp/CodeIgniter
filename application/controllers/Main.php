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
	
	function push($key='') {
		if (md5(md5($key).'work')!='4890dcd81f7c84d3c2fe7ac6add1634e')
			throw new MyException('',MyException::NO_RIGHTS);
		$ref=$this->input->post('ref');
		if (substr($ref, -6)==''){
			exec('git reset --hard HEAD^ && git pull');
		}
	}
}