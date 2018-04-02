<table width="100%"  border="0" cellpadding="2" cellspacing="0">
	<!--<tr>
		<td width=15% align=right>选择区域：</td>
		<td width=85% >
		<select onchange="showztd(this.value)">
		<?php $_from = $this->_var['pinfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'name');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['name']):
?>
		<option value="<?php echo $this->_var['k']; ?>" <?php if ($this->_var['k'] == $this->_var['district']): ?>selected<?php endif; ?>><?php echo $this->_var['name']['name']; ?></option>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</select>
		</td>
	</tr>-->
	<tr><td colspan='2'>
	<?php $_from = $this->_var['pinfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
	<table class="ztd" width="100%" cellpadding="0" cellspacing="0" border="0" id="txt<?php echo $this->_var['key']; ?>" style="display:<?php if ($this->_var['key'] == $this->_var['district']): ?><?php else: ?>none<?php endif; ?>">
		<?php $_from = $this->_var['value']['info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'info');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['info']):
?>
		<tr>
			<td width=15% align=right><?php if ($this->_var['k'] == 0): ?>选择自提点：<?php else: ?>&nbsp;<?php endif; ?></td>
			<td width=85% >
				<table width="100%"  border="0" cellpadding="2" cellspacing="0" class="ziti_list">
					<tr>
						<td width="25%"><span class="ziti_name <?php if ($this->_var['info']['id'] == $this->_var['selectid']): ?>site-in-short<?php endif; ?>" onclick="select_point(this,<?php echo $this->_var['info']['id']; ?>)"><?php echo $this->_var['info']['shop_name']; ?><b></b></span></td>
						<td width="42%"><?php echo $this->_var['info']['address']; ?></td>
						<td width="15%"><?php echo $this->_var['info']['contact']; ?></td>
						<td width="18%"><?php echo $this->_var['info']['phone']; ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</table>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</td></tr>
	<tr>
	<td colspan="2" align="center" class="ziti_btn">
	<input type="hidden" id='s_pid' value='<?php echo $this->_var['selectid']; ?>'>
	<input type="button" name="button" class="bnt_blue_1" value="保存自提点" onclick="save_point(<?php echo $this->_var['suppid']; ?>)" />
	</td>
	</tr>
</table>
