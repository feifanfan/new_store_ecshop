<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="http://www.thefirst.com/" />
<meta name="Generator" content="HongYuJD v7_2" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

<title><?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="themes/68ecshopcom_360buy/js/jquery-1.9.1.min.js"></script>
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.json.js,transport.js')); ?>

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,user.js')); ?>
<script>
String.prototype.trim = function() {
// 用正则表达式将前后空格
//用空字符串替代。
     return this.replace(/(^\s*)|(\s*$)/g, "");
} 
function select_tag(rec_id,tag_id)
{
	var a = document.getElementById("tag_select_"+rec_id).value;
	var b = false;
	var c = new Array();
	var d = new Array();
	var e = 0;
	if (a != '')
	{
		var sa=a.split(",");
		for (var i = 0 ; i < sa.length ; i ++)
		{
			if (sa[i] == tag_id)
			{
				b = true;
				//sa.splice(i,1);
			}
			else
			{
				c[i] = sa[i];
			}
		}
		if (b == false)
		{
			c[c.length] = tag_id;	
		}
	}
	else
	{
		c[0] = tag_id;
	}
	for (var i = 0 ; i < c.length ; i ++)
	{
		if (Number(c[i]) > 0)
		{
			d[e] = c[i];
			e ++;
		}
	}
	
	
	
	var now_tag = d.join(",");
	if (b == false)
	{
		document.getElementById("tag_dt_"+rec_id+"_"+tag_id).className = "cur";
	}
	else
	{
		document.getElementById("tag_dt_"+rec_id+"_"+tag_id).className = '';	
	}
	document.getElementById("tag_select_"+rec_id).value = now_tag;
}

function check_my_comment_send(rec_id, goods_id, order_id)
{
//	if (document.getElementById("tag_select_"+rec_id).value == '' && document.getElementById("tags_zi_"+rec_id).innerHTML == '')
//	{
//		alert("给商品打个标签呗？");
//		show_add_tags(rec_id);
//		return false;	
//	}

    if (document.getElementById("hidden1"+goods_id).value == '') {
        alert("请为描述评分！");
        return false;
    }
    if (order_id != '') {
	    if (document.getElementById("hidden2"+goods_id).value == '') {
	        alert("请为服务评分！");
	        return false;
	    } else if (document.getElementById("hidden3"+goods_id).value == '') {
	        alert("请为发货评分！");
	        return false;
	    } else if (document.getElementById("hidden4"+goods_id).value == '') {
	        alert("请为物流评分！");
	        return false;
	    }
    }
	if (document.getElementById("content_"+rec_id).value.trim() == '')
	{
		alert("请输入购买心得！");
		document.getElementById("content_"+rec_id).focus();
		return false;	
	}
}

function show_commtr(rec_id)
{
	if (document.getElementById("commtr_"+rec_id).style.display == "none")
	{
		if (document.getElementById("commtr_have").value != '0')
		{
			var commtr_have_val = document.getElementById("commtr_have").value;
			document.getElementById("commtr_" + commtr_have_val ).style.display = "none";
		}
		document.getElementById("commtr_" + rec_id ).style.display = "";
		document.getElementById("commtr_have").value = rec_id;	
	}
	else
	{
		document.getElementById("commtr_" + rec_id ).style.display = "none";
		document.getElementById("commtr_have").value = 0;
	}
}

function check_shaidan_send()
{
	if (document.getElementById("title").value == '')
	{
		alert("请输入标题！");
		document.getElementById("title").focus();
		return false;	
	}

	editor.sync();
	if (document.getElementById("message").value == '')
	{
		alert("请输入内容！");
		document.getElementById("message").focus();
		return false;	
	}

	var pic = document.getElementById("J_imageView").innerHTML;
	if (pic == '')
	{
		alert("请上传图片！");
		return false;	
	}
}

function add_tag_one(rec_id)
{
	var s=document.getElementById('tags_zi_'+rec_id);
	var lis=s.getElementsByTagName("li");
	var li= document.createElement("li");
	var txt = document.getElementById("add_tag_text_"+rec_id).value;
	
	if (txt == '')
	{
		alert("请输入标签内容！");
		document.getElementById("add_tag_text_"+rec_id).focus();
		return false;
	}
		for (var j=0;j<lis.length;j++)
	{
		var strj = lis[j].getElementsByTagName("strong");
		if (strj[0].innerHTML == txt)
		{
			alert("标签内容重复！");
			document.getElementById("add_tag_text_"+rec_id).focus();
			return falsse;
		}
	}

	li.innerHTML="<span>X</span><strong>"+txt+"</strong><input type='hidden' name='tags_zi[]' value='"+txt+"' />";
	s.appendChild(li);
		
	for (var i=0;i<lis.length;i++)
	{
		var str = lis[i].getElementsByTagName("strong");
		lis[i].innerHTML = "<span onclick='del_tag_one("+rec_id+","+i+")'>X</span><strong>"+str[0].innerHTML+"</strong><input type='hidden' name='tags_zi[]' value='"+str[0].innerHTML+"' />";
	}
	document.getElementById("add_tag_text_"+rec_id).value = '';
}
function del_tag_one(rec_id,n)
{
	var s=document.getElementById('tags_zi_'+rec_id);
	var lis=s.getElementsByTagName("li");
	for (var i=0;i<lis.length;i++)
	{
		if (i==n)
		{
			s.removeChild(lis[i]);
		}
	}
}
function hide_add_tags(rec_id)
{
	document.getElementById("add_tags_"+rec_id).style.display = "none";
}
function show_add_tags(rec_id)
{
	document.getElementById("add_tags_"+rec_id).style.display = "";
}
$(document).ready(function(e) {
    var tags = document.getElementsByClassName("tags_zi");
	var tags_len = $(tags).children().length;
	if(tags_len >0){
		$(tags).toggle();
	}
});
</script>
</head>
<body>
<script type="text/javascript" src="themes/68ecshopcom_360buy/js/base-2011.js"></script>
<div id="site-nav">
<?php echo $this->fetch('library/page_header.lbi'); ?>
<div class="blank"></div>

  <?php echo $this->fetch('library/ur_here.lbi'); ?>

<div class="block clearfix">
  
  <div class="AreaL">
    <div class="box"> 
    <?php echo $this->fetch('library/user_info.lbi'); ?>
     <?php echo $this->fetch('library/user_menu.lbi'); ?> 
     </div>
  </div>
  
  
  <div class="AreaR">
    <div class="box">
     <div class="box_1">
      <div class="userCenterBox boxCenterList clearfix" style="_height:1%;">

			
            <?php if ($this->_var['action'] == 'my_comment'): ?>
            <div class="tabmenu">
            <ul class="tab pngFix">
              <li class="active"> <a href="#">商品评价/晒单（<?php echo $this->_var['num']['x']; ?>个待评价，<?php echo $this->_var['num']['y']; ?>个待晒单）</a> </li>
            </ul>
          </div>
            <div class="blank"></div>
            <table width="100%" border="0" cellspacing="1" cellpadding="0" class="item_list">
                <tr>
                    <th colspan="2">商品信息</th>
		            <th width="120">商品来源</th>
                    <th width="80">购买时间</th>
                    <th width="80">评价</th>
                    <th width="80">晒单</th>
                </tr>
              <input id="commtr_have" type="hidden" value="0" />
                <?php $_from = $this->_var['item_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['value']):
?>
                <tr>
                	<td width="50"><a href="<?php echo $this->_var['value']['url']; ?>" target="_blank">
                    <?php if ($this->_var['value']['goods_id'] > 0 && $this->_var['value']['extension_code'] != 'package_buy'): ?>
                       <img height="50" width="50" src="<?php echo $this->_var['value']['thumb']; ?>" />
                    <?php elseif ($this->_var['value']['goods_id'] > 0 && $this->_var['value']['extension_code'] == 'package_buy'): ?>
                                 <img src="themes/68ecshopcom_360buy/images/jmpic/ico_cart_package.gif" height="50" width="50"/>
                    <?php endif; ?> 
                    </a></td>
                    <td><a href="<?php echo $this->_var['value']['url']; ?>" target="_blank"><?php echo $this->_var['value']['goods_name']; ?></a></td>
		    <td align="center"><?php if ($this->_var['value']['supplier_id']): ?><a href="supplier.php?suppId=<?php echo $this->_var['value']['supplier_id']; ?>" target="_blank"><?php echo $this->_var['value']['shopname']; ?></a><?php else: ?><?php echo $this->_var['value']['shopname']; ?><?php endif; ?></td>
                    <td align="center"><?php echo $this->_var['value']['add_time_str']; ?></td>
                    <td align="center"><?php if ($this->_var['value']['comment_state'] == 0): ?>
                  <?php if ($this->_var['value']['shipping_time_end'] > $this->_var['min_time']): ?> <a href="javascript:;" onclick="show_commtr(<?php echo $this->_var['value']['rec_id']; ?>)">发表评价</a> <?php else: ?>
                  已超期
                  <?php endif; ?>
                  <?php endif; ?>
                  <?php if ($this->_var['value']['comment_state'] == 1): ?><a href="goods_comment.php?act=view&id=<?php echo $this->_var['value']['rec_id']; ?>" target="_self">已评价</a><?php endif; ?>
                        <?php if ($this->_var['value']['comment_state'] == 1 && $this->_var['value']['comment_status'] == 0): ?>
			<div style="color:#999">审核中</div>
			<?php endif; ?>
                    </td>
                    <td align="center"><?php if ($this->_var['value']['shaidan_state'] == 0): ?>
                  <?php if ($this->_var['value']['shipping_time_end'] > $this->_var['min_time']): ?> <a href="user.php?act=shaidan_send&id=<?php echo $this->_var['value']['rec_id']; ?>" target="_self">发表晒单</a> <?php else: ?>
                  已超期
                  <?php endif; ?>
                  <?php endif; ?>
                        <?php if ($this->_var['value']['shaidan_state'] == 1): ?><a href="goods_shaidan.php?act=view&id=<?php echo $this->_var['value']['shaidan_id']; ?>" target="_blank">已晒单</a><?php endif; ?>
                        <?php if ($this->_var['value']['shaidan_state'] == 1 && $this->_var['value']['shaidan_status'] == 0): ?>
			<div style="color:#999">审核中</div>
			<?php endif; ?>
			<?php if ($this->_var['value']['shaidan_points'] > 0): ?>
			<div style="color:#999">已获<?php echo $this->_var['value']['shaidan_points']; ?>积分</div>
			<?php endif; ?>
                    </td>
                </tr>
                <?php if ($this->_var['value']['comment_state'] == 0): ?>
              <?php if ($this->_var['value']['rec_id'] == $_GET['s']): ?>
              <tr id="commtr_<?php echo $this->_var['value']['rec_id']; ?>"> <?php else: ?>
              <tr id="commtr_<?php echo $this->_var['value']['rec_id']; ?>" style="display:none"> <?php endif; ?>
                <td colspan="6" style="background:#fffdee; padding:0px;"><div class="send_comment">
                <?php if ($this->_var['value']['shipping_time_end'] > $this->_var['min_time']): ?>
                    <form action="user.php?act=my_comment_send" method="post" onsubmit="return check_my_comment_send(<?php echo $this->_var['value']['rec_id']; ?>, <?php echo $this->_var['value']['goods_id']; ?>, <?php echo $this->_var['value']['order_id']; ?>)">
                      <input type="hidden" name="goods_id" value="<?php echo $this->_var['value']['goods_id']; ?>" />
                      <input type="hidden" name="rec_id" value="<?php echo $this->_var['value']['rec_id']; ?>" />
                      <table width="70%" border="0" cellspacing="1" cellpadding="0" style="float:left">
                      	 
                      	<script src="themes/68ecshopcom_360buy/js/jquery.raty.js" type="text/javascript"></script>
                      	<tr>
                        	
                        	<th>描述：</th>
                            <td class="stars_box">
                            	<div id="star1<?php echo $this->_var['value']['goods_id']; ?>" class="star_t"></div>
                                <div id="result1<?php echo $this->_var['value']['goods_id']; ?>" class="result"></div>
                                <input type="hidden" name="comment_rank" value="" id="hidden1<?php echo $this->_var['value']['goods_id']; ?>"/>
                                <input type="hidden" name="o1_id" value="<?php echo $this->_var['value']['o_id']; ?>" />
                                <div class="feel_con_box">
                                    <div class="feel_con"><span class="arrow"></span>1分，非常不满意</div>
                                    <div class="feel_con"><span class="arrow"></span>2分，不满意</div>
                                    <div class="feel_con"><span class="arrow"></span>3分，一般</div>
                                    <div class="feel_con"><span class="arrow"></span>4分，满意</div>
                                    <div class="feel_con"><span class="arrow"></span>5分，非常满意</div>
                                </div>
                            </td>
                        </tr>
                        <?php if ($this->_var['value']['order_id']): ?>
                        <tr>
                        	<th>服务：</th>
                            <td class="stars_box">
                            	<div id="star2<?php echo $this->_var['value']['goods_id']; ?>" class="star_t"></div>
                                <div id="result2<?php echo $this->_var['value']['goods_id']; ?>" class="result"></div>
                                <input type="hidden" name="server" value="" id="hidden2<?php echo $this->_var['value']['goods_id']; ?>"/>
                                 <input type="hidden" name="o_id" value="<?php echo $this->_var['value']['order_id']; ?>" />
                                <div class="feel_con_box">
                                    <div class="feel_con"><span class="arrow"></span>1分，非常不满意</div>
                                    <div class="feel_con"><span class="arrow"></span>2分，不满意</div>
                                    <div class="feel_con"><span class="arrow"></span>3分，一般</div>
                                    <div class="feel_con"><span class="arrow"></span>4分，满意</div>
                                    <div class="feel_con"><span class="arrow"></span>5分，非常满意</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                        	<th>发货：</th>
                            <td class="stars_box">
                            	<div id="star3<?php echo $this->_var['value']['goods_id']; ?>" class="star_t"></div>
                                <div id="result3<?php echo $this->_var['value']['goods_id']; ?>" class="result"></div>
                                <input type="hidden" name="send" value="" id="hidden3<?php echo $this->_var['value']['goods_id']; ?>"/>
                                <div class="feel_con_box">
                                    <div class="feel_con"><span class="arrow"></span>1分，非常不满意</div>
                                    <div class="feel_con"><span class="arrow"></span>2分，不满意</div>
                                    <div class="feel_con"><span class="arrow"></span>3分，一般</div>
                                    <div class="feel_con"><span class="arrow"></span>4分，满意</div>
                                    <div class="feel_con"><span class="arrow"></span>5分，非常满意</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                        	<th>物流：</th>
                            <td class="stars_box">
                            	<div id="star4<?php echo $this->_var['value']['goods_id']; ?>" class="star_t"></div>
                                <div id="result4<?php echo $this->_var['value']['goods_id']; ?>" class="result"></div>
                                <input type="hidden" name="shipping" value="" id="hidden4<?php echo $this->_var['value']['goods_id']; ?>"/>
                                <div class="feel_con_box">
                                    <div class="feel_con"><span class="arrow"></span>1分，非常不满意</div>
                                    <div class="feel_con"><span class="arrow"></span>2分，不满意</div>
                                    <div class="feel_con"><span class="arrow"></span>3分，一般</div>
                                    <div class="feel_con"><span class="arrow"></span>4分，满意</div>
                                    <div class="feel_con"><span class="arrow"></span>5分，非常满意</div>
                                </div>
                            </td>
                        </tr>
                      	<?php endif; ?>
                        
                        <script type="text/javascript">
						rat('star1<?php echo $this->_var['value']['goods_id']; ?>','result1<?php echo $this->_var['value']['goods_id']; ?>','hidden1<?php echo $this->_var['value']['goods_id']; ?>',1);
						rat('star2<?php echo $this->_var['value']['goods_id']; ?>','result2<?php echo $this->_var['value']['goods_id']; ?>','hidden2<?php echo $this->_var['value']['goods_id']; ?>',1);
						rat('star3<?php echo $this->_var['value']['goods_id']; ?>','result3<?php echo $this->_var['value']['goods_id']; ?>','hidden3<?php echo $this->_var['value']['goods_id']; ?>',1);
						rat('star4<?php echo $this->_var['value']['goods_id']; ?>','result4<?php echo $this->_var['value']['goods_id']; ?>','hidden4<?php echo $this->_var['value']['goods_id']; ?>',1);
						$('.star_t').find('img').mouseover(function(){
							var index=$(this).index();
							$(this).parents('.star_t').siblings('.feel_con_box').find('.feel_con').eq(index).css('display','inline-block').siblings('.feel_con').hide();	
						}).mouseout(function(){
							$(this).parents('.star_t').siblings('.feel_con_box').find('.feel_con').hide();		
						})
						function rat(star,result,hidden,m){
							star= '#' + star;
							result= '#' + result;
							hidden='#'+hidden;
							
							$(result).hide();//将结果DIV隐藏
						
							$(star).raty({
								hints: ['1','2', '3', '4', '5'],
								path: "themes/68ecshopcom_360buy/images",
								starOff: 'star-off-big.png',
								starOn: 'star-on-big.png',
								size: 24,
								start: 40,
								showHalf: true,
								targetKeep : true,//targetKeep 属性设置为true，用户的选择值才会被保持在目标DIV中，否则只是鼠标悬停时有值，而鼠标离开后这个值就会消失
								click: function (score, evt) {
									//第一种方式：直接取值
									$(result).show();
									if((score*m)==5){
										$(result).html('<span>'+score*m+'</span>分，非常满意');
									}else if((score*m)==4){
										$(result).html('<span>'+score*m+'</span>分，满意');	
									}else if((score*m)==3){
										$(result).html('<span>'+score*m+'</span>分，一般');	
									}else if((score*m)==2){
										$(result).html('<span>'+score*m+'</span>分，不满意');	
									}else if((score*m)==1){
										$(result).html('<span>'+score*m+'</span>分，非常不满意');	
									}
									
									
									$(hidden).val(score*m);
								}
							});
						}
					  	</script> 
                      	
                        <tr>
                          <th>标签：</th>
                          <td><input type="hidden" id="tag_select_<?php echo $this->_var['value']['rec_id']; ?>" name="comment_tag" value="" />
                            <dl class="tags clearfix">
                              <?php if ($this->_var['value']['goods_tags']): ?> 
                              <?php $_from = $this->_var['value']['goods_tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'tag');if (count($_from)):
    foreach ($_from AS $this->_var['tag']):
?>
                              <dt id="tag_dt_<?php echo $this->_var['value']['rec_id']; ?>_<?php echo $this->_var['tag']['tag_id']; ?>" onclick="select_tag(<?php echo $this->_var['value']['rec_id']; ?>,<?php echo $this->_var['tag']['tag_id']; ?>)"><?php echo $this->_var['tag']['tag_name']; ?></dt>
                              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
                              <?php endif; ?>
                              <dd class="zdy" onclick="show_add_tags(<?php echo $this->_var['value']['rec_id']; ?>)">自定义</dd>
                            </dl>
                            <ul class="tags_zi clearfix" id="tags_zi_<?php echo $this->_var['value']['rec_id']; ?>">
                            </ul>
                            <div class="add_tags clearfix" id="add_tags_<?php echo $this->_var['value']['rec_id']; ?>" style="display:none"> <span onclick="hide_add_tags(<?php echo $this->_var['value']['rec_id']; ?>)">关闭</span>
                              <input type="text" id="add_tag_text_<?php echo $this->_var['value']['rec_id']; ?>" value="" />
                              <input type="button" value="添加" onclick="add_tag_one(<?php echo $this->_var['value']['rec_id']; ?>)" />
                            </div></td>
                        </tr>
                        <tr>
                          <th>心得：</th>
                          <td><textarea name="content" class="inputBorder" id="content_<?php echo $this->_var['value']['rec_id']; ?>" style="height:80px; width:580px;"></textarea></td>
                        </tr>
                        <tr>
                          <th>&nbsp;</th>
                          <td><input type="image" src="themes/68ecshopcom_360buy/images/send_comment.gif" style="float:left" />
                            <div  style="float:left; padding:5px 0px 0 20px;">
                              <input type="checkbox" name="hide_username" value="1" />
                              匿名评价 </div></td>
                        </tr>
                      </table>
                    </form>
                    <?php else: ?>
                    此单已超期
                    <?php endif; ?>
                  </div>
                  </td>
              </tr>
              <?php endif; ?> 
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </table>

  			<div class="blank"></div>
            <?php if ($this->_var['item_list']): ?>
            <?php echo $this->fetch('library/pages.lbi'); ?>
            <?php else: ?>
            <table width="100%" border="0" cellspacing="1" cellpadding="0" class="item_list">
            	<tr>
           		   <td colspan="5" align="center">没有任何晒单评价记录</td>
              	</tr>
            </table>
            <?php endif; ?>
            <?php endif; ?>
            
            
            
            
            <?php if ($this->_var['action'] == 'shaidan_send'): ?>
            <?php if ($this->_var['pan_1'] == 0): ?> 
            此单已超期 
            <?php elseif ($this->_var['pan_2'] == 1): ?> 
            此单已晒单 
	    <?php elseif ($this->_var['pan_3'] == 1): ?> 
            这不是您的订单，请不要非法晒单。 
            <?php else: ?>
            <div class="tabmenu">
            <ul class="tab pngFix">
              <li class="active"> <a href="#">发表晒单</a> </li>
            </ul>
          </div>
          <div class="blank"></div>
                <div style="padding:15px; border:dashed #ddd 1px;">
                	<strong>关于晒单帖：</strong><br />
　　您可以将自己的使用感受、选购建议、实物照片、使用场景、拆包过程等与网友们分享；<br />
　　每个商品前10位成功晒单者且图片数在3张及以上的客户可获得100个京豆奖励；其他用户不再奖励京豆；图书音像商品、赠品晒单帖不奖励京豆；<br />
　　请保证所上传的图片是原创的及合法的，否则鸿宇商城有权删除图片及冻结帐号，且保留追究其法律责任的权利；<br />
　　<a target="_blank" href="article.php?id=36" style="color:#049">更多晒单说明</a>
                </div>
			
			
			
            	<div class="shaidan_form">
                    <form action="user.php?act=shaidan_save" method="post" onsubmit="return check_shaidan_send()">
                    <input type="hidden" name="goods_id" value="<?php echo $this->_var['goods']['goods_id']; ?>" />
                    <input type="hidden" name="rec_id" value="<?php echo $this->_var['goods']['rec_id']; ?>" />
                    <table width="100%" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                            <th width="90">晒单商品：</th>
                            <td><?php echo $this->_var['goods']['goods_name']; ?></td>
                        </tr>
                        <tr>
                            <th><span style="color:#F00">*</span> 标题：</th>
                            <td><input type="text" name="title" id="title" style="width:550px;" /></td>
                        </tr>
                        <tr>
                            <th><span style="color:#F00">*</span> 内容：</th>
                            <td>
							<script charset="utf-8" src="includes/kindeditor/kindeditor-min.js"></script>
                            <script charset="utf-8" src="includes/kindeditor/lang/zh_CN.js"></script>
                            <script>
                            	var editor;
                            	KindEditor.ready(function(K) {
									editor = K.create('textarea[name="message"]', {
									allowFileManager : false,
									items : [
										'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
										'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
										'insertunorderedlist', '|', 'emoticons']
									});
									
									K('#J_selectImage').click(function() {
										editor.loadPlugin('multiimage', function() {
											editor.plugin.multiImageDialog({
												clickFn : function(urlList) {
													var div = K('#J_imageView');
													div.html('');
													K.each(urlList, function(i, data) {
														div.append('<dl class="clearfix"><dt><img src="' + data.url + '" /></dt><dd><input type="hidden" name="img_srcs[]" value="' + data.url + '" /><textarea name="img_names[]" ></textarea></dd></dl>');
													});
													
													editor.hideDialog();
												}
											});
										});
									});
									
                            	});
				
                            </script>
                            <textarea name="message" id="message" style="width:90%;height:260px;visibility:hidden;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th><span style="color:#F00">*</span> 上传图片：</th>
                            <td>
								<div><img style="cursor:pointer" id="J_selectImage" src="themes/68ecshopcom_360buy/images/send_shaidan_img.gif" /></div>
								<div id="J_imageView" class="simgs"></div>

                            </td>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <td>请上传3-20张照片，每张照片不超过4M，支持的照片格式为jpg，jpeg，png，gif； 可一次选择多张；</td>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <td>
                                <input type="image" src="themes/68ecshopcom_360buy/images/send_shaidan.gif" style="float:left" />
                                
                                <div  style="float:left; padding:5px 0px 0 20px;"><input type="checkbox" name="hide_username" value="1" /> 匿名评价 </div>
                                


                            </td>
                        </tr>
                    </table>
                    </form>
                </div>

            <?php endif; ?>
            <?php endif; ?> 
      </div>
     </div>
    </div>
  </div>
  
</div>
<div class="blank"></div>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
<?php echo $this->fetch('library/site_bar.lbi'); ?>
</div>
</body>
<script type="text/javascript">
<?php $_from = $this->_var['lang']['clips_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</script>
</html>
