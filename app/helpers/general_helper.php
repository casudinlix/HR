<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function initialize_elfinder($value=''){
	$CI =& get_instance();
	$CI->load->helper('path');
	$opts = array(
	    //'debug' => true, 
	    'roots' => array(
	      array( 
	        'driver' => 'LocalFileSystem', 
	        'path'   => './uploads/files_manager/', 
	        'URL'    => site_url('uploads/files_manager').'/'
	        // more elFinder options here
	      ) 
	    )
	);
	return $opts;
}

function tema($uri = '',$protocol = NULL){
		$CI =& get_instance();
		$tema="skin/hrmii_assets";


		$tema.="/";
		$tema.=$uri;

	return $CI->config->base_url($tema, $protocol);
}
function tokenhash(){
	$ci =& get_instance();
	 return $ci->security->get_csrf_hash();
}
function tokencookie(){
	$ci =& get_instance();
	 return $ci->security->get_csrf_token_name();
}
function hitungselisih(){
	$ci =& get_instance();
	
}