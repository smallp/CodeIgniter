<?php
class WelcomeController extends CI_Controller {
	function index(){
		$this->load->model('welcome');
		echo implode($this->welcome->test(), '|');
	}
}