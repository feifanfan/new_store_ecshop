<?php

/**
 * 鸿宇多用户商城 注册
 * ============================================================================
 * 版权所有 2015-2016 HongYu科技有限公司，并保留所有权利。
 * 网站地址: http://bbs.hongyuvip.com；
 * ----------------------------------------------------------------------------
 * 仅供学习交流使用，如需商用请购买正版版权。鸿宇不承担任何法律责任。
 * 踏踏实实做事，堂堂正正做人。
 * ============================================================================
 * $Author: Shadow & 鸿宇
 * $Id: register.php 17217 2015-08-07 06:29:08Z niqingyang $
 */
define('IN_ECS', true);

require (dirname(__FILE__) . '/includes/init.php');

/* 载入语言文件 */
require_once (ROOT_PATH . 'languages/' . $_CFG['lang'] . '/user.php');

$action = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'default';

$affiliate = unserialize($GLOBALS['_CFG']['affiliate']);
$smarty->assign('affiliate', $affiliate);
$back_act = '';

/* 如果是显示页面，对页面进行相应赋值 */
if(true)
{
	assign_template();
	$position = assign_ur_here(0, $_LANG['user_center']);
	$smarty->assign('page_title', $position['title']); // 页面标题
	$smarty->assign('ur_here', $position['ur_here']);
	$sql = "SELECT value FROM " . $ecs->table('shop_config') . " WHERE id = 419";
	$row = $db->getRow($sql);
	$car_off = $row['value'];
	$smarty->assign('car_off', $car_off);
	/* 是否显示积分兑换 */
	if(! empty($_CFG['points_rule']) && unserialize($_CFG['points_rule']))
	{
		$smarty->assign('show_transform_points', 1);
	}
	$smarty->assign('helps', get_shop_help()); // 网店帮助
	$smarty->assign('data_dir', DATA_DIR); // 数据目录
	$smarty->assign('action', $action);
	$smarty->assign('lang', $_LANG);
}

/* 路由 */

$function_name = 'action_' . $action;

if(! function_exists($function_name))
{
	$function_name = "action_default";
}

call_user_func($function_name);

/* 路由 */

/* 发送注册邮箱验证码到邮箱 */
function action_send_email_code ()
{
	// 获取全局变量
	$user = $GLOBALS['user'];
	$_CFG = $GLOBALS['_CFG'];
	$_LANG = $GLOBALS['_LANG'];
	$smarty = $GLOBALS['smarty'];
	$db = $GLOBALS['db'];
	$ecs = $GLOBALS['ecs'];
	$user_id = $_SESSION['user_id'];
	
	/* 载入语言文件 */
	require_once (ROOT_PATH . 'languages/' . $_CFG['lang'] . '/user.php');
	
	require_once (ROOT_PATH . 'includes/lib_validate_record.php');
	
	$email = trim($_REQUEST['email']);
	
	if(empty($email))
	{
		exit("邮箱不能为空");
		return;
	}
	else if(! is_email($email))
	{
		exit("邮箱格式不正确");
		return;
	}
	else if(check_validate_record_exist($email))
	{
		
		$record = get_validate_record($email);
		
		/**
		 * 检查是过了限制发送邮件的时间
		 */
		if(time() - $record['last_send_time'] < 60)
		{
			echo ("每60秒内只能发送一次注册邮箱验证码，请稍候重试");
			return;
		}
	}
	
	require_once (ROOT_PATH . 'includes/lib_passport.php');
	
	/* 设置验证邮件模板所需要的内容信息 */
	$template = get_mail_template('reg_email_code');
	// 生成邮箱验证码
	$email_code = rand_number(6);
	
	$GLOBALS['smarty']->assign('email_code', $email_code);
	$GLOBALS['smarty']->assign('shop_name', $GLOBALS['_CFG']['shop_name']);
	$GLOBALS['smarty']->assign('send_date', date($GLOBALS['_CFG']['date_format']));
	
	$content = $GLOBALS['smarty']->fetch('str:' . $template['template_content']);
	
	/* 发送激活验证邮件 */
	$result = send_mail($email, $email, $template['template_subject'], $content, $template['is_html']);
	if($result)
	{
		// 保存验证码到Session中
		$_SESSION[VT_EMAIL_REGISTER] = $email;
		// 保存验证记录
		save_validate_record($email, $email_code, VT_EMAIL_REGISTER, time(), time() + 30 * 60);
		
		echo 'ok';
	}
	else
	{
		echo '注册邮箱验证码发送失败';
	}
}

/* 发送注册手机验证码到邮箱 */
function action_send_mobile_code ()
{
	
	// 获取全局变量
	$user = $GLOBALS['user'];
	$_CFG = $GLOBALS['_CFG'];
	$_LANG = $GLOBALS['_LANG'];
	$smarty = $GLOBALS['smarty'];
	$db = $GLOBALS['db'];
	$ecs = $GLOBALS['ecs'];
	$user_id = $_SESSION['user_id'];
	
	/* 载入语言文件 */
	require_once (ROOT_PATH . 'languages/' . $_CFG['lang'] . '/user.php');
	
	require_once (ROOT_PATH . 'includes/lib_validate_record.php');
	
	$mobile_phone = trim($_REQUEST['mobile_phone']);
	
	if(empty($mobile_phone))
	{
		exit("手机号不能为空");
		return;
	}
	else if(! is_mobile_phone($mobile_phone))
	{
		exit("手机号格式不正确");
		return;
	}
	else if(check_validate_record_exist($mobile_phone))
	{
		// 获取数据库中的验证记录
		$record = get_validate_record($mobile_phone);
		
		/**
		 * 检查是过了限制发送短信的时间
		 */
		$last_send_time = $record['last_send_time'];
		$expired_time = $record['expired_time'];
		$create_time = $record['create_time'];
		$count = $record['count'];
		
		// 每天每个手机号最多发送的验证码数量
		$max_sms_count = 10;
		// 发送最多验证码数量的限制时间，默认为24小时
		$max_sms_count_time = 60 * 60 * 24;
		
		if((time() - $last_send_time) < 60)
		{
			echo ("每60秒内只能发送一次短信验证码，请稍候重试");
			return;
		}
		else if(time() - $create_time < $max_sms_count_time && $record['count'] > $max_sms_count)
		{
			echo ("您发送验证码太过于频繁，请稍后重试！");
			return;
		}
		else
		{
			$count ++;
		}
	}
	
	require_once (ROOT_PATH . 'includes/lib_passport.php');
	
	// 设置为空
	$_SESSION['mobile_register'] = array();
	
	require_once (ROOT_PATH . 'sms/sms.php');
	
	// 生成6位短信验证码
	$mobile_code = rand_number(6);

    // 短信数组
    $content = array($_CFG['sms_register_tpl'], "{\"code\":\"$mobile_code\",\"product\":\"注册\"}",$_CFG['sms_sign']);

    /* 发送激活验证短信 */
    $result = sendSMS($mobile_phone, $content);
	if($result)
	{
		
		if(! isset($count))
		{
			$ext_info = array(
				"count" => 1
			);
		}
		else
		{
			$ext_info = array(
				"count" => $count
			);
		}
		
		// 保存手机号码到SESSION中
		$_SESSION[VT_MOBILE_REGISTER] = $mobile_phone;
		// 保存验证信息
		save_validate_record($mobile_phone, $mobile_code, VT_MOBILE_REGISTER, time(), time() + 30 * 60, $ext_info);
		echo 'ok';
	}
	else
	{
		echo '短信验证码发送失败';
	}
}

/**
 * 验证邮箱是否可以注册，true-已存在，不能注册 false-不存在可以注册
 */
function action_check_email_exist ()
{
	$_LANG = $GLOBALS['_LANG'];
	$_CFG = $GLOBALS['_CFG'];
	$smarty = $GLOBALS['smarty'];
	$db = $GLOBALS['db'];
	$ecs = $GLOBALS['ecs'];
	
	$email = empty($_POST['email']) ? '' : $_POST['email'];
	
	$user = $GLOBALS['user'];
	
	if($user->check_email($email))
	{
		echo 'true';
	}
	else
	{
		echo 'false';
	}
}
function action_check_username_exist ()
{
	$_LANG = $GLOBALS['_LANG'];
	$_CFG = $GLOBALS['_CFG'];
	$smarty = $GLOBALS['smarty'];
	$db = $GLOBALS['db'];
	$ecs = $GLOBALS['ecs'];
	
	$username = empty($_POST['username']) ? '' : $_POST['username'];
	$username = htmlspecialchars($username);
	if(strlen($username)<6){
		echo "lenfalse";
		return;
	}
	$sql = "SELECT * FROM ".$ecs->table('users') ." where user_name = '$username'";
	$result = $db->getOne($sql);
	if($result!=''){
		echo "false";
	}else{
		echo "true";
	}
}

function action_check_user_parent(){
	$_LANG = $GLOBALS['_LANG'];
	$_CFG = $GLOBALS['_CFG'];
	$smarty = $GLOBALS['smarty'];
	$db = $GLOBALS['db'];
	$ecs = $GLOBALS['ecs'];
	$user_parent = empty($_POST['user_parent']) ? '' : trim($_POST['user_parent']);
	if(is_numeric($user_parent)){
		$result = $GLOBALS['db']->getOne("select user_name from ".$GLOBALS['ecs']->table("users")." where user_id = ".$user_parent);
		if($result){
			echo $result;
		}else{
			echo "false";
		}
	}
}
function action_check_user_node(){
	$user_node = empty($_POST['user_node'])?'':trim($_POST['user_node']);
	if($user_node>0){
		$result = $GLOBALS['db']->getOne("select user_name from ".$GLOBALS['ecs']->table('users')." where user_id = ".$user_node);
		$count = $GLOBALS['db']->getOne("select count(*) from ".$GLOBALS['ecs']->table('users')." where node_id = ".$user_node);
		if($count<=1&&$result){
			echo $result;
		}else{
			echo "false";
		}
	}
}
function action_check_bd_id(){
	$_LANG = $GLOBALS['_LANG'];
	$_CFG = $GLOBALS['_CFG'];
	$smarty = $GLOBALS['smarty'];
	$db = $GLOBALS['db'];
	$ecs = $GLOBALS['ecs'];
	$bd_id = trim($_POST['bd_id']);
	if(!empty($bd_id)){
		$user_info = $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table('users')." where user_id = ".$bd_id);
		if($user_info['bd_status']){
			echo $user_info['user_name'];
		}else{
			echo "false";
		}
	}
}
function check_mobile($mobile){
	$sql = "select * from ".$GLOBALS['ecs']->table('users')." where mobile_phone='$mobile'";
	$result = $GLOBALS['db']->getRow($sql);
	if(!empty($result)){
		return $result;
	}else{
		return false;
	}
}
function action_check_mobile_exist ()
{
	$_LANG = $GLOBALS['_LANG'];
	$_CFG = $GLOBALS['_CFG'];
	$smarty = $GLOBALS['smarty'];
	$db = $GLOBALS['db'];
	$ecs = $GLOBALS['ecs'];
	
	$mobile = empty($_POST['mobile']) ? '' : $_POST['mobile'];
	
	$user = $GLOBALS['user'];
	
	if($user->check_mobile_phone($mobile))
	{
		echo 'true';
	}
	else
	{
		echo 'false';
	}
}

/**
 * 显示会员注册界面
 */
function action_default ()
{
	
	// 获取全局变量
	$_CFG = $GLOBALS['_CFG'];
	$_LANG = $GLOBALS['_LANG'];
	$smarty = $GLOBALS['smarty'];
	$db = $GLOBALS['db'];
	$ecs = $GLOBALS['ecs'];
	
	$parent_user_id = trim($_GET['parent_user_id']);//推荐人手机号
	if($parent_user_id!=''){
		$parent_info = $GLOBALS['db']->getRow("SELECT * FROM ".$GLOBALS['ecs']->table("users")." where user_id = ".$parent_user_id);
		//var_dump($parent_info);die;
		if($parent_info!=''){
			$smarty->assign('parent_info',$parent_info);
		}
	}
	if((! isset($back_act) || empty($back_act)) && isset($GLOBALS['_SERVER']['HTTP_REFERER']))
	{
		$back_act = strpos($GLOBALS['_SERVER']['HTTP_REFERER'], 'user.php') ? './index.php' : $GLOBALS['_SERVER']['HTTP_REFERER'];
	}
	
	/* 取出注册扩展字段 */
	$sql = 'SELECT * FROM ' . $ecs->table('reg_fields') . ' WHERE type < 2 AND display = 1 ORDER BY dis_order, id';
	$extend_info_list = $db->getAll($sql);
	$smarty->assign('extend_info_list', $extend_info_list);
	
	/* 验证码相关设置 */
	if((intval($_CFG['captcha']) & CAPTCHA_REGISTER) && gd_version() > 0)
	{
		$smarty->assign('enabled_captcha', 1);
		$smarty->assign('rand', mt_rand());
	}
	
	/* 密码提示问题 */
	$smarty->assign('passwd_questions', $_LANG['passwd_questions']);
	/* 代码增加_start By bbs.hongyuvip.com */
	$smarty->assign('sms_register', $_CFG['sms_register']);
	/* 代码增加_end By bbs.hongyuvip.com */
	/* 代码增加_star By bbs.hongyuvip.com */
	$smarty->assign('sms_register', $_CFG['sms_register']);
	/* 代码增加_end By bbs.hongyuvip.com */
	/* 增加是否关闭注册 */
	$smarty->assign('shop_reg_closed', $_CFG['shop_reg_closed']);
	// 登陆注册-注册类型
	$register_type = empty($_REQUEST['register_type']) ? 'mobile' : $_REQUEST['register_type'];
	if($register_type != 'email' && $register_type != 'mobile')
	{
		$register_type = 'mobile';
	}
	$smarty->assign('register_type', $register_type);
	// $smarty->assign('back_act', $back_act);
	$smarty->display('user_register.dwt');
}

/**
 * 注册会员的处理
 */
function action_register ()
{
	
	// 获取全局变量
	$_CFG = $GLOBALS['_CFG'];
	$_LANG = $GLOBALS['_LANG'];
	$smarty = $GLOBALS['smarty'];
	$db = $GLOBALS['db'];
	$ecs = $GLOBALS['ecs'];
	
	/* 增加是否关闭注册 */
	if($_CFG['shop_reg_closed'])
	{
		$smarty->assign('action', 'register');
		$smarty->assign('shop_reg_closed', $_CFG['shop_reg_closed']);
		$smarty->display('user_passport.dwt');
	}
	else
	{
		include_once (ROOT_PATH . 'includes/lib_passport.php');
		
		$username = isset($_POST['username']) ? trim($_POST['username']) : '';
		
		$password = isset($_POST['password']) ? trim($_POST['password']) : '';
		$email = isset($_POST['email']) ? trim($_POST['email']) : '';
		$other['msn'] = isset($_POST['extend_field1']) ? $_POST['extend_field1'] : '';
		$other['qq'] = isset($_POST['extend_field2']) ? $_POST['extend_field2'] : '';
		$other['office_phone'] = isset($_POST['extend_field3']) ? $_POST['extend_field3'] : '';
		$other['home_phone'] = isset($_POST['extend_field4']) ? $_POST['extend_field4'] : '';
		$other['mobile_phone'] = isset($_POST['extend_field5']) ? $_POST['extend_field5'] : '';
		$sel_question = empty($_POST['sel_question']) ? '' : compile_str($_POST['sel_question']);
		$passwd_answer = isset($_POST['passwd_answer']) ? compile_str(trim($_POST['passwd_answer'])) : '';
		$mobile_phone =isset($_POST['mobile_phone'])?trim($_POST['mobile_phone']):'';
		$user_parent = isset($_POST['user_parent'])?trim($_POST['user_parent']):'';
		$user_bd = isset($_POST['user_bd'])?trim($_POST['user_bd']):'';
		$user_rank = isset($_POST['user_rank'])?trim($_POST['user_rank']):'';
		$user_node = isset($_POST['user_node'])?trim($_POST['user_node']):'';
		$sons = $GLOBALS['db']->getAll("select user_id,node_list from ".$GLOBALS['ecs']->table('users')." where parent_id=".$user_node);
		//var_dump($user_node);
		$node_id_id[0] = $user_node;
		$flag = true;
		$x = 0;
		while ($flag) {		
			$node_id_id[$x+1] = $GLOBALS['db']->getOne("select user_id from ".$GLOBALS['ecs']->table('users')." where node_id = ".$node_id_id[$x]);
			//var_dump($node_id_id[$x+1]);
			if(!empty($node_id_id[$x+1])){
				$flag=true;
			}else{
				$flag=false;
			}
			$x++;
		}
		// var_dump($node_id_id[count($node_id_id)-2]);
		// $b = array_reverse(explode(",",$node_id_id));
		$b =$node_id_id[count($node_id_id)-2];
		//var_dump($b);
		//var_dump($sons);
		if($sons){
			foreach ($sons as $key => $value) {
				$a =  array_reverse(explode(",",$value['node_list']));
				//var_dump(in_array($user_node, $a));die;
				if(in_array($user_node, $a)){
					$user_node = $user_node;
					break;
				}else{
					$user_node = $b;
					continue;
				}
			}
		}else{
			$user_node = $b;
		}

		//var_dump($user_node);die;

		if(empty($user_rank)||$user_rank>4||$user_rank<=0){
			show_message("请选择会员等级");
		}
		if($user_parent==''||empty($user_parent)){
			show_message("请填写推荐人手机号");
		}
		if($user_bd==''||empty($user_bd)){
			show_message("请填写报单人手机号");
		}
		if($user_node==''||empty($user_node)){
			show_message("请填写节点人");
		}
		// 注册类型：email、mobile
		$register_type = isset($_POST['register_type']) ? trim($_POST['register_type']) : '';
		
		$back_act = isset($_POST['back_act']) ? trim($_POST['back_act']) : '';
		
		if(empty($_POST['agreement']))
		{
			show_message($_LANG['passport_js']['agreement']);
		}
		
		// 注册类型不能为空
		if(empty($register_type))
		{
			show_message($_LANG['passport_js']['msg_register_type_blank']);
		}
		
		// 用户名将自动生成
		if(strlen($username) < 3)
		{
			// show_message($_LANG['passport_js']['username_shorter']);
		}
		
		if(strlen($password) < 6)
		{
			show_message($_LANG['passport_js']['password_shorter']);
		}
		
		if(strpos($password, ' ') > 0)
		{
			show_message($_LANG['passwd_balnk']);
		}
		
		/* 验证码检查 */
		if((intval($_CFG['captcha']) & CAPTCHA_REGISTER) && gd_version() > 0)
		{
			if(empty($_POST['captcha']))
			{
				show_message($_LANG['invalid_captcha'], $_LANG['sign_up'], 'register.php', 'error');
			}
			
			/* 检查验证码 */
			include_once ('includes/cls_captcha.php');
			
			$captcha = new captcha();
			
			if(! $captcha->check_word(trim($_POST['captcha'])))
			{
				show_message($_LANG['invalid_captcha'], $_LANG['sign_up'], 'register.php', 'error');
			}
		}

		if($register_type == "mobile")
		{
			
			require_once (ROOT_PATH . 'includes/lib_validate_record.php');
			
			$mobile_phone = ! empty($_POST['mobile_phone']) ? trim($_POST['mobile_phone']) : '';
			$mobile_code = ! empty($_POST['mobile_code']) ? trim($_POST['mobile_code']) : '';
			
			$record = get_validate_record($mobile_phone);
			
           	//1.检测该节点是否满足
           	$node = $GLOBALS['db']->getOne("select count(*) from ".$GLOBALS['ecs']->table('users')." where node_id = ".$user_node);
           	if($node>=2){
           		show_message("节点人不满足");
           	}
			//2.检测父亲是否存在
			$parent = $GLOBALS['db']->getOne("select user_name from ".$GLOBALS['ecs']->table("users")." where user_id= ".$user_parent);
			if(empty($parent)){
				show_message("推荐人不存在");
			}
			/* 手机注册 */
			$result = register_by_mobile($username, $password, $mobile_phone, $other);
			
			if($result)
			{
				/* 删除注册的验证记录 */
				remove_validate_record($mobile_phone);
			}
		}
		else
		{
			/* 无效的注册类型 */
			show_message($_LANG['register_type_invalid'], $_LANG['sign_up'], 'register.php', 'error');
		}
		
		/* 随机生成用户名 */
		// $username = generate_username();
		
		if($result)
		{
			$user_info = $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table('users')." where user_name = '$username'");
			// $user_parent = isset($_POST['user_parent'])?trim($_POST['user_parent']):'';
			// $user_bd = isset($_POST['bd_phone'])?trim($_POST['bd_phone']):'';
			 $user_rank = isset($_POST['user_rank'])?trim($_POST['user_rank']):'';
			// $user_node = isset($_POST['user_node'])?trim($_POST['user_node']):'';
			$node_son = $GLOBALS['db']->getOne("select count(*) from ".$GLOBALS['ecs']->table('users')." where node_id = ".$user_node);
			$node_info =$GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table('users')." where user_id = ".$user_node);

			$node_id = $user_node;//上级节点
			if($node_info){
				if($node_son==0){
					$side_list = $node_info['side_list'].",1";
					$parent_side = 1;
				}elseif($node_son==1){
					$side_list = $node_info['side_list'].",2";
					$parent_side = 2;
				}
				$node_list = $node_info['node_list'].",".$user_info['user_id'];
				$deep = $node_info['deep']+1;
			}else{
				if($node_son==0){
					$side_list = 1;
					$parent_side = 1;
				}elseif($node_son==1){
					$side_list = 2;
					$parent_side = 2;
				}
				$node_list = $user_info['user_id'];
				$deep = 1;
			}
			if($user_bd){
				$bd_id = $user_bd;
			}else{
				$bd_id = 0;
			}


			$parent_info = $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table("users")." where user_id = ".$user_parent);
			if(empty($parent_info)){
				$parent_id = 0;
				$parent_list = 0;
			}else{
				$parent_id = $user_parent;
				$parent_list = $parent_info['parent_list'].",".$user_info['user_id'];
			}
			$sql = "UPDATE ".$GLOBALS['ecs']->table("users")." set parent_id = '$parent_id',parent_list='$parent_list',node_id='$node_id',node_list='$node_list',parent_side='$parent_side',side_list='$side_list',bd_id='$bd_id',deep='$deep',user_rank='$user_rank' where user_id = ".$user_info['user_id'];
			$GLOBALS['db']->query($sql);
			/* 把新注册用户的扩展信息插入数据库 */
			$sql = 'SELECT id FROM ' . $ecs->table('reg_fields') . ' WHERE type = 0 AND display = 1 ORDER BY dis_order, id'; // 读出所有自定义扩展字段的id
			$fields_arr = $db->getAll($sql);
			
			$extend_field_str = ''; // 生成扩展字段的内容字符串
			foreach($fields_arr as $val)
			{
				$extend_field_index = 'extend_field' . $val['id'];
				if(! empty($_POST[$extend_field_index]))
				{
					$temp_field_content = strlen($_POST[$extend_field_index]) > 100 ? mb_substr($_POST[$extend_field_index], 0, 99) : $_POST[$extend_field_index];
					$extend_field_str .= " ('" . $_SESSION['user_id'] . "', '" . $val['id'] . "', '" . compile_str($temp_field_content) . "'),";
				}
			}
			$extend_field_str = substr($extend_field_str, 0, - 1);
			
			if($extend_field_str) // 插入注册扩展数据
			{
				$sql = 'INSERT INTO ' . $ecs->table('reg_extend_info') . ' (`user_id`, `reg_field_id`, `content`) VALUES' . $extend_field_str;
				$db->query($sql);
			}
			
			/* 写入密码提示问题和答案 */
			if(! empty($passwd_answer) && ! empty($sel_question))
			{
				$sql = 'UPDATE ' . $ecs->table('users') . " SET `passwd_question`='$sel_question', `passwd_answer`='$passwd_answer'  WHERE `user_id`='" . $_SESSION['user_id'] . "'";
				$db->query($sql);
			}
			
			/* 代码增加_start By bbs.hongyuvip.com */
			$now = gmtime();
			if($_CFG['bonus_reg_rand'])
			{
				$sql_bonus_ext = " order by rand() limit 0,1";
			}
			$sql_b = "SELECT type_id FROM " . $ecs->table("bonus_type") . " WHERE send_type='" . SEND_BY_REGISTER . "'  AND send_start_date<=" . $now . " AND send_end_date>=" . $now . $sql_bonus_ext;
			$res_bonus = $db->query($sql_b);
			$kkk_bonus = 0;
			while($row_bonus = $db->fetchRow($res_bonus))
			{
				$sql = "INSERT INTO " . $ecs->table('user_bonus') . "(bonus_type_id, bonus_sn, user_id, used_time, order_id, emailed)" . " VALUES('" . $row_bonus['type_id'] . "', 0, '" . $_SESSION['user_id'] . "', 0, 0, 0)";
				$db->query($sql);
				$kkk_bonus = $kkk_bonus + 1;
			}
			if($kkk_bonus)
			{
				$_LANG['register_success'] = '用户名 %s 注册成功,并获得官方赠送的红包礼品';
			}
			/* 代码增加_end By bbs.hongyuvip.com */
			
			/* 判断是否需要自动发送注册邮件 */
			if($GLOBALS['_CFG']['member_email_validate'] && $GLOBALS['_CFG']['send_verify_email'])
			{
				send_regiter_hash($_SESSION['user_id']);
			}
			$ucdata = empty($user->ucdata) ? "" : $user->ucdata;
			show_message(sprintf($_LANG['register_success'], $username . $ucdata), array(
				$_LANG['back_up_page'],$_LANG['profile_lnk']
			), array(
				$back_act,'user.php'
			), 'info');
		}
		else
		{
			$GLOBALS['err']->show($_LANG['sign_up'], 'register.php');
		}
	}
	/* 代码增加2014-12-23 by bbs.hongyuvip.com _star */
}

/**
 * 随机生成指定长度的数字
 *
 * @param number $length        	
 * @return number
 */
function rand_number ($length = 6)
{
	if($length < 1)
	{
		$length = 6;
	}
	
	$min = 1;
	for($i = 0; $i < $length - 1; $i ++)
	{
		$min = $min * 10;
	}
	$max = $min * 10 - 1;
	
	return rand($min, $max);
}

/**
 * 根据手机号生成用户名
 *
 * @param number $length
 * @return number
 */
function generate_username_by_mobile ($mobile)
{

	$username = 'u'.substr($mobile, 0, 3);

	$charts = "ABCDEFGHJKLMNPQRSTUVWXYZ";
	$max = strlen($charts);

	for($i = 0; $i < 4; $i ++)
	{
		$username .= $charts[mt_rand(0, $max)];
	}

	$username .= substr($mobile, -4);
	
	$sql = "select count(*) from " . $GLOBALS['ecs']->table('users') . " where user_name = '$username'";
	$count = $GLOBALS['db']->getOne($sql);
	if($count > 0)
	{
		return generate_username_by_mobile();
	}

	return $username;
}

/**
 * 根据邮箱地址生成用户名
 *
 * @param number $length
 * @return number
 */
function generate_username ()
{

	$username = 'u'.rand_number(3);

	$charts = "ABCDEFGHJKLMNPQRSTUVWXYZ";
	$max = strlen($charts);

	for($i = 0; $i < 4; $i ++)
	{
		$username .= $charts[mt_rand(0, $max)];
	}

	$username .= rand_number(4);
	
	$sql = "select count(*) from " . $GLOBALS['ecs']->table('users') . " where user_name = '$username'";
	$count = $GLOBALS['db']->getOne($sql);
	if($count > 0)
	{
		return generate_username();
	}

	return $username;
}

?>