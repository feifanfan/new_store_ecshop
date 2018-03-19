<?php
/*
	*自定義函數庫
	* 
 */
//edit by ff 3.16
function ismobile(){
	$ua = strtolower($_SERVER['HTTP_USER_AGENT']);

	$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile)/i";
	$smartuachar = "/(ipad)/i";
		
	//if(($ua == '' || preg_match($uachar, $ua))&& !strpos(strtolower($_SERVER['REQUEST_URI']),'wap'))
	if(!(preg_match($smartuachar, $ua)) && ($ua == '' || preg_match($uachar, $ua))&& !strpos(strtolower($_SERVER['REQUEST_URI']),'wap'))
	{

	    if (!empty($Loaction))
	    {
	        return false;
	    }else{
	    	return true;

	    }

	}
	}
?>