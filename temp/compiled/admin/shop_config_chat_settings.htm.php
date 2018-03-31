<!-- $Id: group_buy_info.htm 14216 2015-02-10 02:27:21Z derek $ -->
<?php echo $this->fetch('pageheader.htm'); ?> <?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js')); ?>
<script type="text/javascript" src="../js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./js/validate/jquery.validate.js"></script>
<script type="text/javascript" src="./js/validate/messages_zh.js"></script>
<script type="text/javascript" src="./js/validator.js"></script>
<style type="text/css">
label.error {
	color: red;
	background: url(./images/warning_small.gif) no-repeat;
	padding-left: 18px;
}

label.success {
	background: url(./images/yes.gif) no-repeat;
	padding-left: 18px;
}

#btn_visit{
	background: #24a0d6 none repeat scroll 0 0;
    border: medium none;
    color: #fff;
    cursor: pointer;
    margin: 2px;
    padding: 7px 15px;
}
</style>
<form id="form1" method="post" action="chat_settings.php" name="theForm">
	<input type="hidden" id="act" name="act" value="post">
	<div class="main-div">
		<table id="group-table" cellspacing="1" cellpadding="3" width="100%">
			<tr>
				<td class="label"><?php echo $this->_var['lang']['label_chat_server_ip']; ?></td>
				<td>
					<input type="text" id="chat_server_ip" name="chat_server_ip" value="<?php echo $this->_var['chat']['chat_server_ip']; ?>" class="required" />
				</td>
			</tr>
			<tr>
				<td class="label"><?php echo $this->_var['lang']['label_chat_server_port']; ?></td>
				<td>
					<input type="text" id="chat_server_port" name="chat_server_port" value="<?php echo $this->_var['chat']['chat_server_port']; ?>" class="required" />
				</td>
			</tr>
			<tr>
				<td class="label"><?php echo $this->_var['lang']['label_chat_http_bind_port']; ?></td>
				<td>
					<input type="text" id="chat_http_bind_port" name="chat_http_bind_port" value="<?php echo $this->_var['chat']['chat_http_bind_port']; ?>" class="required" />
				</td>
			</tr>
			<tr>
				<td class="label"><?php echo $this->_var['lang']['label_chat_server_admin_username']; ?></td>
				<td>
					<input type="text" id="chat_server_admin_username" name="chat_server_admin_username" value="<?php echo $this->_var['chat']['chat_server_admin_username']; ?>" class="required" />
				</td>
			</tr>
			<tr>
				<td class="label"><?php echo $this->_var['lang']['label_chat_server_admin_password']; ?></td>
				<td>
					<input type="password" id="chat_server_admin_password" name="chat_server_admin_password" value="" class="<?php if ($this->_var['password_empty'] == 1): ?> required <?php endif; ?>" />
					<!-- <?php if ($this->_var['password_empty'] == 0): ?> -->
					<div style="margin-left: 5px;">留空则不更新</div>
					<!-- <?php endif; ?> -->
				</td>
			</tr>
			<tr>
				<td class="label"><?php echo $this->_var['lang']['label_chat_server_admin_repassword']; ?></td>
				<td>
					<input type="password" id="chat_server_admin_repassword" name="chat_server_admin_repassword" value="<?php echo $this->_var['chat']['chat_server_admin_repassword']; ?>" class="" />
				</td>
			</tr>
			<!-- 
			<tr>
				<td class="label"><?php echo $this->_var['lang']['label_chat_server_timout']; ?></td>
				<td>
					<input type="text" id="chat_server_timout" name="chat_server_timout" value="<?php echo $this->_var['chat']['chat_server_timout']; ?>" class="required" />
				</td>
			</tr>
			 -->
			<tr>
				<td class="label">&nbsp;</td>
				<td>
					<input name="act_id" type="hidden" id="act_id" value="<?php echo $this->_var['customer']['act_id']; ?>">
					<input type="button" id="btn_submit" name="btn_submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" />
					<a id="btn_visit" href="javascript:;" target="_blank" style="margin-left: 10px;"><?php echo $this->_var['lang']['visit_openfire']; ?></a>
				</td>
			</tr>
		</table>
	</div>
</form>
<script language="JavaScript">

$().ready(function(){
	
	$.validator.addMethod("ip", function(value, element) {
	    var ip = /^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
	    return this.optional(element) || (ip.test(value) && (RegExp.$1 < 256 && RegExp.$2 < 256 && RegExp.$3 < 256 && RegExp.$4 < 256));
	}, "Ip地址格式错误");
	
	var validator = $("#form1").validate({
	    debug: false,
	    rules: {
	        chat_server_ip: {
	        	required: true,
	        	ip: true
	        },
	        chat_server_port: {
	            required: true,
	            range: [0, 65535]
	        },
	        chat_http_bind_port: {
	        	required: true,
	            range: [0, 65535]
	        },
	        chat_server_admin_repassword: {
	        	equalTo: "#chat_server_admin_password"
	        }
	    },
	    messages: {
	    	chat_server_ip: {
	    		required: "IP地址不能为空",
	            ip: "IP地址格式不正确"
	        },
	    	chat_server_port: {
	    		required: "端口号不能为空",
	    		range: "请输入 0 至 65535 之间的有效的端口号"
	        },
	        chat_http_bind_port: {
	    		required: "HTTP-BIND端口号不能为空",
	        	range: "请输入 0 至 65535 之间的有效的端口号"
	        },
	        chat_server_admin_username: {
	        	required: "聊天服务器管理员登录账户不能为空"
	        },
	        chat_server_admin_password: {
	        	required: "聊天服务器管理员登录密码不能为空"
	        },
	        chat_server_admin_repassword: {
	        	required: "确认密码不能为空",
	        	equalTo: "两次输入的密码不一样，请重新输入"
	        }
	    },
	    errorPlacement: function(error, element) {
	        error.appendTo(element.parent());  
	    }
	});
	
	$("#btn_submit").click(function(){
		if(!validator.form()){
			return false;
		}
		$("#form1").submit();
		return false;
	});
	
	$("#btn_visit").click(function(){
		var ip = $("#chat_server_ip").val();
		var port = $("#chat_server_port").val();
		$(this).attr("href", "http://"+ip+":"+port+"/");
	});
});

//-->

</script>
<?php echo $this->fetch('pagefooter.htm'); ?>