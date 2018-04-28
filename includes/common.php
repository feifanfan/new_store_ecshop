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
function log_account_change_new($user_id, $user_money = 0, $user_cash = 0, $user_point = 0, $user_upgrade=0,$pay_points = 0,$change_desc = '', $change_type = ACT_OTHER){
	    /* 插入帐户变动记录 */
	    $account_log = array(
	        'user_id'       => $user_id,
	        'user_money'    => $user_money,
	        'act_user_money' => $user_money,
	        '$act_user_cash' =>$user_cash,
	        'user_cash'  => $user_cash,
	        'user_point'   => $user_point,
	        'pay_points'=>$pay_points,
	        'upgrade_point'=>$user_upgrade,
	        'change_time'   => gmtime(),
	        'change_desc'   => $change_desc,
	        'change_type'   => $change_type
	    );
	    $GLOBALS['db']->autoExecute($GLOBALS['ecs']->table('account_log'), $account_log, 'INSERT');

	    /* 更新用户信息 */
	    $sql = "UPDATE " . $GLOBALS['ecs']->table('users') .
	            " SET user_money = user_money + ('$user_money')," .
	            " user_cash = user_cash + ('$user_cash')," .
	            " user_point = user_point + ('$user_point')," .
	            "user_upgrade = user_upgrade+('$user_upgrade'),".
	            "pay_points = pay_points+('$pay_points')".
	            " WHERE user_id = '$user_id' LIMIT 1";
	         //var_dump($sql);die;
	    $GLOBALS['db']->query($sql);
	}
function tupu($user_id){
	$user[0] = $GLOBALS['db']->getRow("SELECT * FROM ".$GLOBALS['ecs']->table('users')." where user_id = ".$user_id);

	$user[1] = $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table('users') ." where parent_id = ".$user_id ." and parent_side = 1");

	$user[2] = $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table('users') ." where parent_id = ".$user_id ." and parent_side = 2");
	//var_dump($user);die;
	if($user[1]!=''){
		$user[3] =  $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table('users') ." where parent_id = ".$user[1]['user_id'] ." and parent_side = 1");
		$user[4] =  $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table('users') ." where parent_id = ".$user[1]['user_id'] ." and parent_side = 2");
	}
	if($user[2]!=''){
		$user[5] =  $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table('users') ." where parent_id = ".$user[2]['user_id'] ." and parent_side = 1");
		$user[6] =  $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table('users') ." where parent_id = ".$user[2]['user_id'] ." and parent_side = 2");
	}
	return $user;
}

function collide_point($user_id,$amount,$order_sn){

	$user_info =$GLOBALS['db']->getRow("select parent_id,node_id,deep,user_rank,node_list,side_list from ".$GLOBALS['ecs']->table('users') ." where user_id = ".$user_id);
	if(empty($user_info)||$user_info=='')
		return;
	//买主的side_list倒叙数组
	$side_list_array = array_reverse(explode(",",$user_info['side_list']));
	$node_list_array = array_reverse(explode(",",$user_info['node_list']));
	$node_id = $user_info['node_id'];
	for($a=0;$a<count($side_list_array);$a++){
		
		if($node_id<=0)
			return;
		//var_dump($node_id);
		/*初始化每次循环重复使用的数据*/
		unset($res);
		//unset($info);
		
		echo "<br>";
		$parent_node_list = $GLOBALS['db']->getOne("SELECT side_list from ".$GLOBALS['ecs']->table("users")." where user_id = ".$node_id);
				//var_dump($parent_node_list);
		$sql = "select user_id,side_list,deep from ".$GLOBALS['ecs']->table('users')." where deep = $user_info[deep] and node_list LIKE '%".$node_id."%' and node_list LIKE '".$node_list_array[count($side_list_array)]."%'";//√查询出所有该层的成员
		$info = $GLOBALS['db']->getAll($sql);
		
		echo "<br>";
				/*****************************/
			for($i=0;$i<count($info);$i++){
					$pre_other_side_list = array_reverse(explode(",",$info[$i]['side_list']));
					//var_dump($pre_other_side_list);
					//另一边的用户  如果查询出有另一边的用户，则检查是否可以update,否则insert
					if($pre_other_side_list[$a]!=$side_list_array[$a]){
						if($pre_other_side_list[$a]==1){
							$sql = " and user_left = ".$info[$i]['user_id']." and user_right is null";
						}else{
							$sql = " and user_right = ".$info[$i]['user_id'] ." and user_left is null";
						}
						$sql = "select * from ".$GLOBALS['ecs']->table('user_money_log')." where parent_id = ".$node_id .$sql;
						//var_dump($sql);echo "<br>";
						//查询user_money_log的行是否存在 如果存在，update；如果不存在，插入一行
						//跳出此次循环
						if(!$res){
							$res = $GLOBALS['db']->getRow($sql);
						}
						
					}
				}
				//var_dump($res);die;
				//如果$res不为空，说明该层存在一个等待配对的订单，那么更新
				//如果$res为空，说明该层不存在，则insert
				if($res){


					if($side_list_array[$a]==1){
						$up_sql = " set user_left = ".$user_id.",left_sn = ".$order_sn.",left_amount = ".$amount;
					}else{
						$up_sql = " set user_right = ".$user_id .",right_sn=".$order_sn.",right_amount = ".$amount;
					}
					//更新user_money_log表，完成配对
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

					

					$sons_id = $GLOBALS['db']->getRow("select user_left,user_right,percent from ".$GLOBALS['ecs']->table('user_money_log')." where id = ".$res['id']); 
					if($sons_id['percent']>20){
						$peng = "层碰奖";
					}else{
						$peng = "对碰奖";
					}
					$change_desc = "编号".$sons_id['user_left']."与编号".$sons_id['user_right'].$peng;
					//层碰的奖金分配
					$percent = $sons_id['percent'];
					$send_jin = $jin*$percent/100;
					$act_user_money = $send_jin*0.8;
					$act_user_cash = $send_jin*0.2;
					//完成配对的情况下，当碰对奖低于20%时，需要更新业绩
					//只有对碰的时候才会发生业绩的变化和管理奖
					if($sons_id['percent']<20){
						manage($node_id,$send_jin);
						minus_team_total($sons_id['user_left'],$amount);
						minus_team_total($sons_id['user_right'],$amount);
						$user_left_node = $GLOBALS['db']->getOne("select node_id from ".$GLOBALS['ecs']->table('users')." where user_id =".$sons_id['user_left']);
						$user_right_node = $GLOBALS['db']->getOne("select node_id from ".$GLOBALS['ecs']->table('users')." where user_id =".$sons_id['user_right']);

						while ($user_left_node != $user_right_node ) {
							minus_team_total($user_left_node,$amount);
							minus_team_total($user_right_node,$amount);
							$user_left_node = $GLOBALS['db']->getOne("select node_id from ".$GLOBALS['ecs']->table('users')." where user_id =".$user_left_node);
							$user_right_node = $GLOBALS['db']->getOne("select node_id from ".$GLOBALS['ecs']->table('users')." where user_id =".$user_right_node);
						}

					}

					$result = is_fengding($node_id);
					if($result>=$send_jin){
						$change_time = time();
						$send_money = $send_jin * 0.8;
						$send_cash =$send_jin * 0.2;
					}else{
						$send_money = $result * 0.8;
						$send_cash =$result * 0.2;
						$change_desc .=",奖金已达到今日最高值，分配剩余值:".$result;
					}
			
					$change_time = time();
					$send_sql = "update ".$GLOBALS['ecs']->table('users')." set user_money = user_money+".$send_money." ,user_cash = user_cash+".$send_cash.",fd_num = fd_num+".$send_jin." where user_id = ".$node_id;
					$GLOBALS['db']->query($send_sql);

					$account_log_sql = "insert into ".$GLOBALS['ecs']->table('account_log')."(user_id,user_money,act_user_money,user_cash,act_user_cash,change_time,change_desc,change_type) values ( '$parent_id','$send_money','$act_user_money','$send_cash','$act_user_cash','$change_time','$change_desc','99')";
					
					$GLOBALS['db']->query($account_log_sql);
					//如果是首单，则再次寻找并插入一个对碰
					if($sons_id['percent']>20){
						//var_dump($res);echo "<br>";
						if($res['user_left']==''){
							$p_sql = " and isnull(user_left) and user_right = ".$res['user_right'];
							$u_sql = " set user_left = ".$user_id.",left_sn = ".$order_sn.",left_amount = ".$amount;
						}elseif ($res['user_right']=='') {
							$p_sql = " and isnull(user_right) and user_left = ".$res['user_left'];
							$u_sql = " set user_right = ".$user_id .",right_sn=".$order_sn.",right_amount = ".$amount;
						}
						//var_dump($u_sql);echo "<br>";
						$p_sql = "select * from ".$GLOBALS['ecs']->table('user_money_log')." where  parent_id='$res[parent_id]' and parent_deep='$res[parent_deep]'".$p_sql;
						$lt_res = $GLOBALS['db']->getRow($p_sql);
						//var_dump($p_sql);echo "<br>";
						$u_sql = "update ".$GLOBALS['ecs']->table('user_money_log').$u_sql." where id = ".$lt_res['id'];
						$GLOBALS['db']->query($u_sql);
						$rl_user_amount = $GLOBALS['db']->getRow("select left_amount,right_amount from ".$GLOBALS['ecs']->table('user_money_log')." where id = ".$lt_res['id']);
						//if($rl_user_amount['left'])

						//分配奖金
						//manage($node_id,$send_jin);
					}
				}else{
					//查询相对父亲的首单奖励和次单奖励百分比，根据deep去设置比例
				$parent_user_rank = $GLOBALS['db']->getOne("select user_rank from ".$GLOBALS['ecs']->table('users')." where user_id = ".$node_id);
				 //echo $parent_id."--".$parent_user_rank."<br>";
				$first_char = chr($parent_user_rank+96)."_card_first";
				$top_char = chr($parent_user_rank+96)."_card_achievement";

				$is_first = $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table('user_money_log')." where parent_id = ".$node_id." and parent_deep = ".$user_info['deep']);
				//var_dump($is_first);
				if(!empty($is_first)){
					$b = $top_char;
				}else{
					$b = $first_char;
				}
				//var_dump($b);
				$percent = $GLOBALS['db']->getOne("select value from ".$GLOBALS['ecs']->table('shop_config')." where code ='$b'");
				$c_percent = $GLOBALS['db']->getOne("select value from ".$GLOBALS['ecs']->table('shop_config')." where code ='$top_char'");
				//根据当前用户的相对于相对父亲的side，插入到user_money_log
				if($side_list_array[$a]==1){
					$in_sql = " (user_left,left_sn,left_amount,parent_id,parent_deep,percent) values ('$user_id','$order_sn','$amount','$node_id','$user_info[deep]','$percent')";
				}else{
					$in_sql = " (user_right,right_sn,right_amount,parent_id,parent_deep,percent) values ('$user_id','$order_sn','$amount','$node_id','$user_info[deep]','$percent')";
				}
				$sql = "INSERT INTO ".$GLOBALS['ecs']->table('user_money_log').$in_sql;
				$GLOBALS['db']->query($sql);
				//在此插入一条等待配对的对碰
				if(!$is_first){
					if($side_list_array[$a]==1){
						$c_sql = " (user_left,left_sn,left_amount,parent_id,parent_deep,percent) values ('$user_id','$order_sn','$amount','$node_id','$user_info[deep]','$c_percent')";
					}else{
						$c_sql = " (user_right,right_sn,right_amount,parent_id,parent_deep,percent) values ('$user_id','$order_sn','$amount','$node_id','$user_info[deep]','$c_percent')";
					}
					$c_sql = "INSERT INTO ".$GLOBALS['ecs']->table('user_money_log').$c_sql;
					$GLOBALS['db']->query($c_sql);
				}

				
				}
				
				$node_id = $GLOBALS['db']->getOne("select node_id from ".$GLOBALS['ecs']->table('users') ." where user_id = ".$node_id);
	}
}
//cengpeng
function duipeng($user_id,$amount){


	$user_info =$GLOBALS['db']->getRow("select parent_id,node_id,deep,user_rank,node_list,side_list from ".$GLOBALS['ecs']->table('users') ." where user_id = ".$user_id);
	if(empty($user_info)||$user_info=='')
		return;
	//买主的side_list倒叙数组
	$side_list_array = array_reverse(explode(",",$user_info['side_list']));
	$node_list_array = array_reverse(explode(",",$user_info['node_list']));
	$node_id = $user_info['node_id'];
	for($a=0;$a<count($side_list_array);$a++){
		if($node_id<=0)
			return;
		$parent_node_list = $GLOBALS['db']->getOne("SELECT side_list from ".$GLOBALS['ecs']->table("users")." where user_id = ".$node_id);
				//var_dump($parent_node_list);
		$sql = "select user_id,side_list,deep from ".$GLOBALS['ecs']->table('users')." where deep = $user_info[deep] and node_list LIKE '%".$node_id."%' and node_list LIKE '".$node_list_array[count($side_list_array)]."%'";//√查询出所有该层的成员
		$info = $GLOBALS['db']->getAll($sql);
		echo "相对父亲：";
		var_dump($node_id);echo "<br>";
		$node_parent_info = $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table("users"). " where user_id = ".$node_id);
		echo "相对父亲的层数：".$node_parent_info;
		echo "<br>";
		//var_dump($info);
		// echo "<br>";
		//查出此时相对的父亲和边的另一边的业绩

		//相对父亲：$node_id,父亲下面的孩子
		if($side_list_array[$a]==1){
			$mb_son_side = 2;
		}elseif ($side_list_array[$a]==2) {
			$mb_son_side = 1;
		}


		$son = $GLOBALS['db']->getRow("select * from ".$GLOBALS['ecs']->table("users")." where node_id = ".$node_id." and parent_side=".$mb_son_side);

		$son_team_total = $GLOBALS['db']->getOne("select team_total from ".$GLOBALS['ecs']->table("users")." where user_id = ".$son['user_id']);

		if($amount >=$son_team_total){
			$amount = $son_team_total;
		}else{
			$amount = $amount;
		}
		echo "此次配对的金额".$amount;
		if($amount<=0)
			return;
		

		echo "要查询的儿子：".$son['user_id'];
		echo "<br>";
		echo "报单人的层：".$user_info['deep'];
		echo "<br>";
		//1.据此查询数据库，判断相对该父亲是否在该层有过配对，有过则只分配对碰（然后分配管理奖给该人的parent_id）；未有，则分配层碰+对碰（和管理奖）
		//2.依据前条件，判断查询该父亲的对碰或者层碰+对碰的奖金百分比
		echo "报单人相对该父亲的层数：".($user_info['deep']-$node_parent_info['deep']);echo "<br>";
		$relative_num = $user_info['deep']-$node_parent_info['deep'];

		$have_sql = "select * from ".$GLOBALS['ecs']->table("user_money_log")." where parent_id = ".$node_id." and parent_deep = ".$relative_num;

		$have = $GLOBALS['db']->getRow($have_sql);
		//var_dump($have);echo "<br>";
		if($side_list_array[$a]==1){
			$user_left = $user_id;
			$user_right = $son['user_id'];
		}elseif ($side_list_array[$a]==2) {
			$user_left = $son['user_id'];
			$user_right = $user_id;
		}
		//查出该父亲的等级对应的字母
		
		$rank_word = chr($node_parent_info['user_rank']+96);
		echo "父亲等级对应的字母：".$rank_word;echo "<br>";

		$addtime = time();
		if($have){//如果已经存在配对，则说明只能对碰
			$achievement_word = $rank_word."_card_achievement";
			//查询出对碰百分比
			$achievement_per = $GLOBALS['db']->getOne("select value from ".$GLOBALS['ecs']->table('shop_config')." where code = '$achievement_word'");
			echo "对碰百分比：".$achievement_per;
			$achievement_amount_money = $amount*$achievement_per*0.8/100;
			$achievement_amount_cash = $amount*$achievement_per*0.2/100;

			$is_fengding = is_fengding($node_id);
			if($is_fengding < $achievement_amount_money+$achievement_amount_cash){
				//前2：应该插入的金额 后2：实际插入的金额
				$act_achievement_amount_money = $achievement_amount_money;
				$act_achievement_amount_cash = $achievement_amount_cash;
				$achievement_amount_money = $is_fengding*$first_per*0.8/100;
				$achievement_amount_cash = $is_fengding*$first_per*0.2/100;
			}else{
				$act_achievement_amount_money = $achievement_amount_money;
				$act_achievement_amount_cash = $achievement_amount_cash;
			}
			//管理奖的参数amount
			$manage_amount = $achievement_amount_money+$achievement_amount_cash;
			//对碰奖
			//插入配对表sql
			$insert_achievement_sql = "insert into".$GLOBALS['ecs']->table("user_money_log")." (user_left,user_right,amount,parent_id,parent_deep,percent,addtime) values (".$user_left.",".$user_right.",".$amount.",".$node_id.",".$relative_num.",".$achievement_per.",".$addtime.")";
			echo $insert_achievement_sql."<br>";
			//更新用户表sql
			$update_achievement_sql = "update ".$GLOBALS['ecs']->table("users")." set user_money = user_money+".$achievement_amount_money.",user_cash=user_cash+".$achievement_amount_cash.",fd_num = fd_num+".$manage_amount." where user_id = ".$node_id;
			echo $update_achievement_sql."<br>";
			//插入资金记录表的sql
			$change_desc = "用户".$user_id."与市场".$son['user_id']."的对碰奖";
			$insert_achievement_account_sql = "insert into ".$GLOBALS['ecs']->table("account_log")." (user_id,user_money,act_user_money,user_cash,act_user_cash,change_time,change_desc,change_type) values (".$node_id.",".$achievement_amount_money.",".$act_achievement_amount_money.",".$achievement_amount_cash.",".$act_achievement_amount_cash.",".$addtime.",'$change_desc',99)";
			echo $insert_achievement_account_sql."<br>";

			//执行sql
			$GLOBALS['db']->query($insert_achievement_sql);
			$GLOBALS['db']->query($update_achievement_sql);
			$GLOBALS['db']->query($insert_achievement_account_sql);

			//碰对奖完成，管理奖
			manage($node_id,$manage_amount);
		}else{//否则层碰+对碰
			$achievement_word = $rank_word."_card_achievement";
			$first_word = $rank_word."_card_first";
			//查询出对碰百分比
			$achievement_per = $GLOBALS['db']->getOne("select value from ".$GLOBALS['ecs']->table('shop_config')." where code = '$achievement_word'");
			$first_per = $GLOBALS['db']->getOne("select value from ".$GLOBALS['ecs']->table('shop_config')." where code = '$first_word'");
			echo "对碰百分比：".$achievement_per;
			$achievement_amount_money = $amount*$achievement_per*0.8/100;
			$achievement_amount_cash = $amount*$achievement_per*0.2/100;
			echo "层碰百分比：".$first_per;
			//应该插入的金额
			$first_amount_money = $amount*$first_per*0.8/100;
			$first_amount_cash = $amount*$first_per*0.2/100;

			echo "<br>";
			//每次插入之前都要调用is_fengding
			//(1)插入user_money_log表记录
			//(2)更新用户金额
			//(3)插入金额变化表user_account_log
			//首先分配层碰奖
			$is_fengding = is_fengding($node_id);
			echo $is_fengding."封顶值<br>";
			if($is_fengding < $first_amount_money+$first_amount_cash){
				//前2：应该插入的金额 后2：实际插入的金额
				$act_first_amount_money = $first_amount_money;
				$act_first_amount_cash = $first_amount_cash;
				$first_amount_money = $is_fengding*$first_per*0.8/100;
				$first_amount_cash = $is_fengding*$first_per*0.2/100;
			}else{
				$act_first_amount_money = $first_amount_money;
				$act_first_amount_cash = $first_amount_cash;
			}
			$insert_first_sql = "insert into".$GLOBALS['ecs']->table("user_money_log")." (user_left,user_right,amount,parent_id,parent_deep,percent,addtime) values (".$user_left.",".$user_right.",".$amount.",".$node_id.",".$relative_num.",".$first_per.",".$addtime.")";
			echo $insert_first_sql."<br>";
			$fd_num = $first_amount_money+$first_amount_cash;
			$update_first_sql = "update ".$GLOBALS['ecs']->table("users")." set user_money = user_money+".$first_amount_money.",user_cash=user_cash+".$first_amount_cash.",fd_num = fd_num+".$fd_num." where user_id = ".$node_id;
			echo $update_first_sql."<br>";

			$change_desc = "用户".$user_id."与市场".$son['user_id']."的层碰奖";
			$insert_first_account_sql = "insert into ".$GLOBALS['ecs']->table("account_log")." (user_id,user_money,act_user_money,user_cash,act_user_cash,change_time,change_desc,change_type) values (".$node_id.",".$first_amount_money.",".$act_first_amount_money.",".$first_amount_cash.",".$act_first_amount_cash.",".$addtime.",'$change_desc',99)";
			echo $insert_first_account_sql."<br>";
			//以上为层碰奖，此时要执行各条sql
			$GLOBALS['db']->query($insert_first_sql);//插入配对表
			$GLOBALS['db']->query($update_first_sql);//更新用户金额
			$GLOBALS['db']->query($insert_first_account_sql);//插入金额记录表


			$is_fengding = is_fengding($node_id);
			if($is_fengding < $achievement_amount_money+$achievement_amount_cash){
				//前2：应该插入的金额 后2：实际插入的金额
				$act_achievement_amount_money = $achievement_amount_money;
				$act_achievement_amount_cash = $achievement_amount_cash;
				$achievement_amount_money = $is_fengding*$first_per*0.8/100;
				$achievement_amount_cash = $is_fengding*$first_per*0.2/100;
			}else{
				$act_achievement_amount_money = $achievement_amount_money;
				$act_achievement_amount_cash = $achievement_amount_cash;
			}
			//对碰奖
			$insert_achievement_sql = "insert into".$GLOBALS['ecs']->table("user_money_log")." (user_left,user_right,amount,parent_id,parent_deep,percent,addtime) values (".$user_left.",".$user_right.",".$amount.",".$node_id.",".$relative_num.",".$achievement_per.",".$addtime.")";
			echo $insert_achievement_sql."<br>";

			$manage_amount = $achievement_amount_money+$achievement_amount_cash;
			$update_achievement_sql = "update ".$GLOBALS['ecs']->table("users")." set user_money = user_money+".$achievement_amount_money.",user_cash=user_cash+".$achievement_amount_cash.",fd_num = fd_num+".$manage_amount." where user_id = ".$node_id;
			echo $update_achievement_sql."<br>";

			$change_desc = "用户".$user_id."与市场".$son['user_id']."的对碰奖";
			$insert_achievement_account_sql = "insert into ".$GLOBALS['ecs']->table("account_log")." (user_id,user_money,act_user_money,user_cash,act_user_cash,change_time,change_desc,change_type) values (".$node_id.",".$achievement_amount_money.",".$act_achievement_amount_money.",".$achievement_amount_cash.",".$act_achievement_amount_cash.",".$addtime.",'$change_desc',99)";
			echo $insert_achievement_account_sql."<br>";


			//执行sql
			$GLOBALS['db']->query($insert_achievement_sql);
			$GLOBALS['db']->query($update_achievement_sql);
			$GLOBALS['db']->query($insert_achievement_account_sql);

			//碰对完成，管理奖
			manage($node_id,$manage_amount);
		}

		echo "<br>";
		echo "<br>";
		//$son和$user_id都要减去业绩
		$son_sub_sql = "update ".$GLOBALS['ecs']->table("users")." set team_total = team_total-".$amount." where user_id = ".$son['user_id'];
		$user_sub_sql = "update ".$GLOBALS['ecs']->table("users")." set team_total = team_total-".$amount." where user_id = ".$user_id;

		$GLOBALS['db']->query($son_sub_sql);
		$GLOBALS['db']->query($user_sub_sql);

		$node_id = $GLOBALS['db']->getOne("select node_id from ".$GLOBALS['ecs']->table('users') ." where user_id = ".$node_id);
	}

}
function manage($user_id,$amount){
	$parent_id = $GLOBALS['db']->getOne("select parent_id from ".$GLOBALS['ecs']->table('users')." where user_id=".$user_id);
	$i = 0;
	while ($parent_id>0) {
		$user_rank = $GLOBALS['db']->getRow("SELECT user_name,user_rank,user_id FROM ".$GLOBALS['ecs']->table('users')." where user_id = ".$parent_id);
		$cengshu = $i+1;
		$i++;
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
		$fengding = is_fengding($parent_id);
		$chars = $char."_card_manage_".$d;
		$percent = $GLOBALS['db']->getOne("select value from ecs_shop_config where code='$chars'");
		
		$zong  = $amount * $percent/100;
		
		$act_user_money = $zong*0.8;
		$act_user_cash = $zong*0.2;
		if($zong>$fengding){
			$zong  = $fengding;
		}else{
			$zong=$zong;
		}
		$user_money = $zong*0.8;
		$user_cash = $zong * 0.2;
		$change_desc = '第'.$cengshu.'代'.$user_rank['user_name'].'的管理奖';
		$change_time = time();
		$up_sql = "update ".$GLOBALS['ecs']->table('users')." set user_money = user_money+".$user_money.",user_cash=user_cash+".$user_cash.",fd_num=fd_num+".$zong." where user_id = ".$parent_id;
		
		$insert_sql = "insert into ".$GLOBALS['ecs']->table("account_log")." (user_money,act_user_money,user_cash,act_user_cash,change_desc,change_time,user_id,change_type) values ( '$user_money','$act_user_money','$user_cash','$act_user_cash','$change_desc','$change_time','$parent_id','99')";
		$GLOBALS['db']->query($up_sql);
		$GLOBALS['db']->query($insert_sql);	
		$parent_id = $GLOBALS['db']->getOne("select parent_id from ".$GLOBALS['ecs']->table('users')." where user_id=".$parent_id);
	}
}

function team_total($user_id,$amount){
	while ($user_id>0) {
		$sql = "update ".$GLOBALS['ecs']->table('users')." set team_total = team_total+".$amount." where user_id = ".$user_id;
		$GLOBALS['db']->query($sql);
		$user_id = $GLOBALS['db']->getOne("select node_id from ".$GLOBALS['ecs']->table('users')." where user_id = ".$user_id);
	}
}
function minus_team_total($user_id,$amount){
	$sql = "update ".$GLOBALS['ecs']->table('users')." set team_total = team_total-".$amount." where user_id = ".$user_id;
		$GLOBALS['db']->query($sql);
}


function store_self_bonus($user_id,$amount,$order_sn){
	$add_user_id = $GLOBALS['db']->getOne("SELECT s.user_id from ".$GLOBALS['ecs']->table('supplier')." as s LEFT JOIN ".$GLOBALS['ecs']->table('pickup_point')." as p on s.supplier_id = p.supplier_id LEFT JOIN ".$GLOBALS['ecs']->table('order_info')." as o ON o.pickup_point=p.id WHERE o.order_sn=".$order_sn);
	$jin = $amount*0.01;
	$user_money = $jin*0.8;
	$user_cash = $jin*0.2;
	$change_desc = "订单".$order_sn."商城消费自提";
	$change_time = time();
	$up_sql = "update ".$GLOBALS['ecs']->table('users')." set user_money = user_money+".$user_money.",user_cash = user_cash+".$user_cash." where user_id = ".$add_user_id;
	$insert_sql = "insert into ".$GLOBALS['ecs']->table('account_log')." (user_money,user_cash,change_time,change_desc,change_type,user_id) values ( '$user_money','$user_cash','$change_time','$change_desc','99','$add_user_id')";
	$GLOBALS['db']->query($up_sql);
	$GLOBALS['db']->query($insert_sql);
}
//检测奖金是否封顶
function is_fengding($user_id){
	$now_date = date('Ymd',time());
	$sql = "select user_rank,fd_num,fd_date from ".$GLOBALS['ecs']->table('users')." where user_id = ".$user_id;
	$user_info = $GLOBALS['db']->getRow($sql);
	$rank_word = chr($user_info['user_rank']+96)."_card_top";
	$card_top = $GLOBALS['db']->getOne("select value from ".$GLOBALS['ecs']->table('shop_config')." where code = '$rank_word'");
	if($user_info['fd_date']<$now_date){
		$GLOBALS['db']->query("update ".$GLOBALS['ecs']->table('users')." set fd_num=0, fd_date = ".$now_date." where user_id = ".$user_id);
		return $card_top;
	}elseif ($user_info['fd_date']==$now_date) {
		if($user_info['fd_num']<$card_top){
			return $card_top - $user_info['fd_num'];
		}else{
			return 0;
		}
	}
}


//见点奖
function jiandian($user_id,$amount){
	$user_info =$GLOBALS['db']->getRow("select parent_id,node_id,deep,user_rank,node_list,side_list from ".$GLOBALS['ecs']->table('users') ." where user_id = ".$user_id);
	if(empty($user_info)||$user_info=='')
		return;
	//买主的side_list倒叙数组
	$node_list_array = array_reverse(explode(",",$user_info['node_list']));

	for ($i=1; $i <count($node_list_array); $i++) { 

		if($i>20){return;}		
		$zong = $amount*0.05;
		$act_money = $zong*0.8;
		$act_cash = $zong*0.2;

		$fengding = is_fengding($node_list_array[$i]);

		if($zong>$fengding){
			$zong  = $fengding;
		}else{
			$zong=$zong;
		}
		$money = $zong*0.8;
		$cash = $zong*0.2;

		$user_rank = $GLOBALS['db']->getOne("select user_rank from ". $GLOBALS['ecs']->table("users") . " where user_id = " . $node_list_array[$i]);
		$user_rank_word = chr($user_rank+96)."_card_advance";
		$user_buynum = chr($user_rank+96)."_card_buynum";

		$jiandian = $GLOBALS['db']->getOne("select jiandian from ".$GLOBALS['ecs']->table("users")." where user_id = ".$node_list_array[$i]);

		if($jiandian<$user_buynum){
			$up_sql = "update ".$GLOBALS['ecs']->table('users')." set user_money = user_money+".$money.",user_cash=user_cash+".$cash.",fd_num=fd_num+".$zong.",jiandian=jiandian + " .$zong." where user_id = ".$node_list_array[$i];
			$change_time = time();
			$desc = $user_id.'提供的第'.$i."层见点奖";
			$insert_sql = "insert into ".$GLOBALS['ecs']->table("account_log")." (user_money,act_user_money,user_cash,act_user_cash,change_desc,change_time,user_id,change_type) values ( '$money','$act_money','$cash','$act_cash','$desc','$change_time','$node_list_array[$i]','99')";
			$GLOBALS['db']->query($up_sql);
			$GLOBALS['db']->query($insert_sql);
		}
	}
}
?>