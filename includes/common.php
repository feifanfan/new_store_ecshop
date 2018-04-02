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
<<<<<<< HEAD
	
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
=======
function tupu($user_id){
	$user[0] = $GLOBALS['db']->getRow("SELECT * FROM ".$GLOBALS['ecs']->table('users')." where user_id = ".$user_id);
	$user[1] = $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table('users') ." where parent_id = ".$user_id ." and parent_side = 1");
	$user[2] = $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table('users') ." where parent_id = ".$user_id ." and parent_side = 2");
	if($user[1]){
		$user[3] =  $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table('users') ." where parent_id = ".$user[1]['user_id'] ." and parent_side = 1");
		$user[4] =  $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table('users') ." where parent_id = ".$user[1]['user_id'] ." and parent_side = 2");
	}
	if($user[2]){
		$user[5] =  $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table('users') ." where parent_id = ".$user[2]['user_id'] ." and parent_side = 1");
		$user[6] =  $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table('users') ." where parent_id = ".$user[2]['user_id'] ." and parent_side = 2");
	}
	return $user;
}


function collide_point($user_id,$amount,$order_sn){
	$user_info =$GLOBALS['db']->getRow("select parent_id,deep,user_rank,id_list,side_list from ".$GLOBALS['ecs']->table('users') ." where user_id = ".$user_id);
	//买主的side_list倒叙数组
	$side_list_array = array_reverse(explode(",",$user_info['side_list']));
	$id_list_array = array_reverse(explode(",",$user_info['id_list']));
	$parent_id = $user_info['parent_id'];
	for($a=0;$a<count($side_list_array);$a++){
		$parent_id_list = $GLOBALS['db']->getOne("SELECT side_list from ".$GLOBALS['ecs']->table("users")." where user_id = ".$parent_id);
		
		$sql = "select user_id,side_list,deep from ".$GLOBALS['ecs']->table('users')." where deep = $user_info[deep] and id_list LIKE '%".$parent_id."%' and id_list LIKE '".$id_list_array[count($side_list_array)]."%'";//√查询出所有该层的成员
		$info = $GLOBALS['db']->getAll($sql);
		/*初始化每次循环重复使用的数据*/
		unset($res);
		
		/*****************************/
		for($i=0;$i<count($info);$i++){
			$pre_other_side_list = array_reverse(explode(",",$info[$i]['side_list']));
			//另一边的用户  如果查询出有另一边的用户，则检查是否可以update,否则insert
			if($pre_other_side_list[$a]!=$side_list_array[$a]){
				if($pre_other_side_list[$a]==1){
					$sql = " and user_left = ".$info[$i]['user_id']." and user_right is null";
				}else{
					$sql = " and user_right = ".$info[$i]['user_id'] ." and user_left is null";
				}
				$sql = "select * from ".$GLOBALS['ecs']->table('user_money_log')." where parent_id = ".$parent_id .$sql;
				//var_dump($sql);echo "<br>";
				//查询user_money_log的行是否存在 如果存在，update；如果不存在，插入一行
				//跳出此次循环
				if(!$res){
					$res = $GLOBALS['db']->getRow($sql);
				}
				
			}
		}
		
		//如果$res不为空，说明该层存在一个等待配对的订单，那么更新
		//如果$res为空，说明该层不存在，则insert
		if($res){


			if($side_list_array[$a]==1){
				$up_sql = " set user_left = ".$user_id.",left_sn = ".$order_sn.",left_amount = ".$amount;
			}else{
				$up_sql = " set user_right = ".$user_id .",right_sn=".$order_sn.",right_amount = ".$amount;
			}
			$sql = "update ".$GLOBALS['ecs']->table('user_money_log').$up_sql." where id = ".$res['id'];
			$GLOBALS['db']->query($sql);
			if($res['left_amount']){
				if($res['left_amount']>$amount){
					$jin = $amount;
				}else{
					$jin = $res['left_amount'];
				}
			}elseif ($res['right_amount']) {
				if($res['right_amount']>$amount){
					$jin = $amount;
				}else{
					$jin = $res['right_amount'];
				}
			}

			if($percent>20){
				$peng = "层碰奖";
			}else{
				$peng = "对碰奖";
			}

			$sons_id = $GLOBALS['db']->getRow("select user_left,user_right,percent from ".$GLOBALS['ecs']->table('user_money_log')." where id = ".$res['id']); 
			$change_desc = "编号".$sons_id['user_left']."与编号".$sons_id['user_right'].$peng;

			$percent = $sons_id['percent'];
			$send_jin = $jin*$percent/100;

			$result = is_fengding($parent_id);
			$result = is_fengding($parent_id);
			if($result==0){
				$change_time = time();
				$send_money = $send_jin * 0.8;
				$send_cash =$send_jin * 0.2;
				//正常分配奖金
				
			}elseif ($result>0) {
				//判断此单是否超过剩余额度，若超过则插入剩余钱，否则正常插入
				if($result- $send_jin>=0){
					$send_money = $send_jin * 0.8;
					$send_cash =$send_jin * 0.2;
				}else{
					$send_money = $result * 0.8;
					$send_cash =$result * 0.2;
					$change_desc .=",奖金已达到今日最高值，分配剩余值"; 
				}
			}else{
				//不分配奖，原因：当天奖金超额
				$send_money = 0;
				$send_cash =0;
				$change_desc .=",奖金已达到今日最高值,不再享受分配"; 
			}
			$change_time = time();
			$send_sql = "update ".$GLOBALS['ecs']->table('users')." set user_money = user_money+".$send_money." ,user_cash = user_cash+".$send_cash." where user_id = ".$parent_id;
			$GLOBALS['db']->query($send_sql);
			$account_log_sql = "insert into ".$GLOBALS['ecs']->table('account_log')."(user_id,user_money,user_cash,change_time,change_desc,change_type) values ( '$parent_id','$send_money','$send_cash','$change_time','$change_desc','99')";

			$GLOBALS['db']->query($account_log_sql);
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";


		}else{
		echo "插入<br>";
			//查询相对父亲的首单奖励和次单奖励百分比，根据deep去设置比例
		$parent_user_rank = $GLOBALS['db']->getOne("select user_rank from ".$GLOBALS['ecs']->table('users')." where user_id = ".$parent_id);
		echo $parent_id."--".$parent_user_rank."<br>";
		$first_char = chr($parent_user_rank+96)."_card_first";
		$top_char = chr($parent_user_rank+96)."_card_achievement";
		$is_first = $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table('user_money_log')." where parent_id = ".$parent_id." and parent_deep = ".$user_info['deep']);

		if(!empty($is_first)){
			$b = $top_char;
		}else{
			$b = $first_char;
		}
		$percent = $GLOBALS['db']->getOne("select value from ".$GLOBALS['ecs']->table('shop_config')." where code ='$b'");
		//根据当前用户的相对于相对父亲的side，插入到user_money_log
		if($side_list_array[$a]==1){
			$in_sql = " (user_left,left_sn,left_amount,parent_id,parent_deep,percent) values ('$user_id','$order_sn','$amount','$parent_id','$user_info[deep]','$percent')";
		}else{
			$in_sql = " (user_right,right_sn,right_amount,parent_id,parent_deep,percent) values ('$user_id','$order_sn','$amount','$parent_id','$user_info[deep]','$percent')";
		}
		$sql = "INSERT INTO ".$GLOBALS['ecs']->table('user_money_log').$in_sql;
		$GLOBALS['db']->query($sql);
		}
		
		$parent_id = $GLOBALS['db']->getOne("select parent_id from ".$GLOBALS['ecs']->table('users') ." where user_id = ".$parent_id);
		echo("<br>");
	}
}

function is_fengding($user_id){
	$now_date = date('Ymd',time());
	$sql = "select user_rank,fd_num,fd_date from ".$GLOBALS['ecs']->table('users')." where user_id = ".$user_id;
	$user_info = $GLOBALS['db']->getRow($sql);
	
	if($user_info['fd_date']<$now_date){
		$GLOBALS['db']->query("update ".$GLOBALS['ecs']->table('users')." set fd_num=0, fd_date = ".$now_date." where user_id = ".$user_id);
		return 0;
	}elseif ($user_info['fd_date']==$now_date) {
		$rank_word = chr($user_info['user_rank']+96)."_card_top";

		$card_top = $GLOBALS['db']->getOne("select value from ".$GLOBALS['ecs']->table('shop_config')." where code = '$rank_word'");
		if($user_info['fd_num']<$card_top){
			return $card_top - $user_info['fd_num'];
		}else{
			return -1;
		}
	}

}
>>>>>>> zmx/master
?>