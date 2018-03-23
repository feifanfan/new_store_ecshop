<?php
/*
	*自定義函數庫
	* 
 */
if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

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
function log_account_change_new($user_id, $user_money = 0, $user_cash = 0, $user_point = 0, $change_desc = '', $change_type = ACT_OTHER){
	    /* 插入帐户变动记录 */
	    $account_log = array(
	        'user_id'       => $user_id,
	        'user_money'    => $user_money,
	        'user_cash'  => $user_cash,
	        'user_point'   => $user_point,
	        'change_time'   => gmtime(),
	        'change_desc'   => $change_desc,
	        'change_type'   => $change_type
	    );
	    $GLOBALS['db']->autoExecute($GLOBALS['ecs']->table('account_log'), $account_log, 'INSERT');

	    /* 更新用户信息 */
	    $sql = "UPDATE " . $GLOBALS['ecs']->table('users') .
	            " SET user_money = user_money + ('$user_money')," .
	            " user_cash = user_cash + ('$user_cash')," .
	            " user_point = user_point + ('$user_point')" .
	            " WHERE user_id = '$user_id' LIMIT 1";
	    $GLOBALS['db']->query($sql);
	}
?>