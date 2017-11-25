<?php
class MainController extends CI_Controller {
	function index(){
		echo 'this is work origin';
	}
	
	function addPush($key='') {
		if (md5(md5($key).'work')!='ce785304c29f93d3d02248ff6032f147')
			throw new MyException('',MyException::NO_RIGHTS);
		$ref=$this->input->post('ref');
		if (substr($ref, -6)==''){
			exec('git reset --hard && git pull -r >/tmp/null');
		}
	}
}