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
	
	function test($user_id,$amount,$order_id){
		$res = $GLOBALS['db']->getRow("SELECT user_name,id_list,user_id,parent_id FROM ".$GLOBALS['ecs']->table('users')." where user_id = ".$user_id);
		$id_list = explode(',',$res['id_list']);
		$arr = array_reverse($id_list);
		for($i = 0; $i < count($arr)-1; $i++){
			$parent_id = $arr[$i+1];
			var_dump($parent_id);
			$user_rank = $GLOBALS['db']->getRow("SELECT user_name,user_rank,user_id FROM ".$GLOBALS['ecs']->table('users')." where user_id = ".				$parent_id);
			
			$cengshu = $i+1;
			var_dump($cengshu);
			$char = chr($user_rank['user_rank']+96);
			if(1>=$cengshu || $cengshu<=2){
				$d = 1;
			}elseif(3>=$cengshu || $cengshu<=5){
				$d = 2;
			}elseif(6>=$cengshu || $cengshu<=8){
				$d = 3;
			}elseif(9>=$cengshu || $cengshu<=15){
				$d = 4;
			}else{
				return;
			}
			$chars = $char."_card_manage_".$d;
			var_dump($chars);
			// $percent = $GLOBALS['db']->getOne("select value from ".$GLOBALS['ecs']->table('shop_config')." where code = ".$chars);
			$percent = $GLOBALS['db']->getOne("select value from ecs_shop_config where code='$chars'");
			
			$zong  = $amount * $percent/100;
			$user_money = $zong*0.8;
			$user_cash = $zong * 0.2;
			$change_desc = '第'.$cengshu.'代'.$user_rank['user_name'].'的管理奖';
			$change_time = time();
			$up_sql = "update ".$GLOBALS['ecs']->table('users')." set user_money = user_money+".$user_money.",user_cash=user_cash+".$user_cash. " where user_id = ".$parent_id;
			
			$insert_sql = "insert into ".$GLOBALS['ecs']->table("account_log")." (user_money,user_cash,change_desc,change_time,user_id,change_type) values ( '$user_money','$user_cash','$change_desc','$change_time','$parent_id','99')";
			$GLOBALS['db']->query($up_sql);
			$GLOBALS['db']->query($insert_sql);	
			
		}
		
	}
	
	// function test($user_id){
		// $i= 1;
		// if($user_id!=null){
			// $res = $GLOBALS['db']->getRow("SELECT user_name,user_rank,user_id,parent_id FROM ".$GLOBALS['ecs']->table('users')." where user_id = ".$user_id);
			
			// if($res) {
				// //查询父级操作parent_id然后作为user_id
				// $sql = "select user_name,user_rank,user_id,parent_id from ".$GLOBALS['ecs']->table('users')." where user_id = ".$res['parent_id'];
				// $result = $GLOBALS['db']->getRow($sql);
				// // var_dump($result['user_id']);
				
					// if($result['user_rank'] == 1){
						// for($i = 1;$i <= 4; $i++){
							// $arr = $GLOBALS['db']->getOne("select value from ecs_shop_config where code='a_card_manage_$i'");
							// var_dump($arr);
						// }
					// }elseif($result['user_rank'] == 2){
						// for($i = 1;$i <= 4; $i++){
							// $arr = $GLOBALS['db']->getOne("select value from ecs_shop_config where code='b_card_manage_$i'");
						// }
					// }elseif($result['user_rank'] == 3){
						// for($i = 1;$i <= 4; $i++){
							// $arr = $GLOBALS['db']->getOne("select value from ecs_shop_config where code='c_card_manage_$i'");
						// }
					// }elseif($result['user_rank'] == 4){
						// for($i = 1;$i <= 4; $i++){
							// $arr = $GLOBALS['db']->getOne("select value from ecs_shop_config where code='d_card_manage_$i'");
						// }
					// }
					// // var_dump($arr);
				// $i++;
				// test($result['user_id']);
			// }
			// return $result;
		// }
	// }
	
	// function test($user_id){
		// $i= 1;
		// if($user_id!=null){
		// $res = $GLOBALS['db']->getRow("SELECT user_name,user_rank,user_id,parent_id FROM ".$GLOBALS['ecs']->table('users')." where user_id = ".$user_id);
		// // var_dump($res['parent_id']);
		// // 查询是否有父级
		// $sql = "select * from ".$GLOBALS['ecs']->table('users')." where user_id = ".$res['parent_id'];
		// $data = $GLOBALS['db']->getRow($sql);
		// // 如果有
		// if($data) {
			// //查询父级操作parent_id然后作为user_id
			// $result = $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table('users')." where user_id = ".$data['parent_id']);
			// var_dump($result['user_id']);
			// $i++;
			// test($result['user_id']);
		// }
		// return $result;
		// }
	// }
	
	
	// 获取指定分类所有父ID号
    // function getAllFcateIds($user_id)
    // {
        // //初始化ID数组
        // $array[] = $user_id;
         
        // do
        // {
            // $ids = '';
            // $where['user_id'] = array('in',$user_id);
            // $cate = M('cate')->where($where)->select();
            // echo M('cate')->_sql();
            // foreach ($cate as $v)
            // {
                // $array[] = $v['parent_id'];
                // $ids .= ',' . $v['parent_id'];
            // }
            // $ids = substr($ids, 1, strlen($ids));
            // $user_id = $ids;
        // }
        // while (!empty($cate));
 
        // $ids = implode(',', $array);
         // return $ids;   //  返回字符串
        // //return $array //返回数组
    // }
	
	
	
function manage($user_id,$amount,$order_id){
	$word = '';
	for($i = 0; $i < 15; $i++){
		$user_rank =  $GLOBALS['db']->getAll("SELECT user_rank FROM ".$GLOBALS['ecs']->table('users')." where parent_id = ".$user_id);
		$cengshu = $i+1;
	}
}	
?>