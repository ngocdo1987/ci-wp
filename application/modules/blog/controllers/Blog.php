<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->template->template = 'site';
	}

    function index()
    {
        echo 'lol';
    }

    function test_template()
    {
    	$data = [
    		// layout vars
    		'mt' => 'This is example of test template',
    		'md' => 'This is meta description',
    		// view vars
    		'var1' => 'This is content'
    	];
    	//$this->template->set('mt', 'This is example of test template');
    	//$this->template->set('md', 'This is meta description');
    	$this->template->load('test_template', $data);
    }
}