<?php
class Template {
	var $template_data = array();
	var $template = 'site'; // by default
	
	/*	
	function set($content_area, $value)
	{
		$this->template_data[$content_area] = $value;
	}
	*/
	
	function load(/*$name = '', */$view = '' , $view_data = array(), $return = FALSE)
	{               
		$this->CI =& get_instance();
			
		//$this->set('content', /*$name, */$this->CI->load->view($view, $view_data, TRUE));
		//$this->CI->load->view('layouts/'.$this->template, $this->template_data);
		$view_data['content'] = $this->CI->load->view($view, $view_data, TRUE);
		$this->CI->load->view('layouts/'.$this->template, $view_data);
	}
}	