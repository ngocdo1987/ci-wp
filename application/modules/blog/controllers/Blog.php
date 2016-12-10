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

    function check_fb_login()
    {
    	$fb = new \Facebook\Facebook([
    		'app_id' => FB_APP_ID,
    		'app_secret' => FB_APP_SECRET,
    		'default_graph_version' => 'v2.2',
    	]);

   		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['manage_pages', 'publish_pages', 'user_managed_groups', 'publish_actions']; 
		$redirect_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		$loginUrl = $helper->getLoginUrl(FB_CALLBACK.'?redirect_url='.$redirect_url, $permissions);

		echo '<a href="'.$loginUrl.'">Login FB</a>';
    }
}