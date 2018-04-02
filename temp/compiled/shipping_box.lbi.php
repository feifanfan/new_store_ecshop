<ul class="shipping_jm">
	<?php $_from = $this->_var['shipping_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'shipping');if (count($_from)):
    foreach ($_from AS $this->_var['shipping']):
?>
	<li><input name="shipping" type="radio" value="<?php echo $this->_var['shipping']['shipping_id']; ?>" <?php if ($this->_var['order']['shipping_id'] == $this->_var['shipping']['shipping_id']): ?>checked="true"<?php endif; ?> supportCod="<?php echo $this->_var['shipping']['support_cod']; ?>" supoortPickup="<?php echo $this->_var['shipping']['support_pickup']; ?>" insure="<?php echo $this->_var['shipping']['insure']; ?>" onclick="selectShipping(this)" /> <?php echo $this->_var['shipping']['shipping_name']; ?> （<?php echo $this->_var['shipping']['format_shipping_fee']; ?> 免费额度：<?php echo $this->_var['shipping']['free_money']; ?>  <?php echo sub_str($this->_var['shipping']['shipping_desc'],25); ?>）</li>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	<li style="text-align:right;"><input name="need_insure" id="ECS_NEEDINSURE" type="checkbox"  onclick="selectInsure(this.checked)" value="1" <?php if ($this->_var['order']['need_insure']): ?>checked="true"<?php endif; ?> <?php if ($this->_var['insure_disabled']): ?>disabled="true"<?php endif; ?>  /><?php echo $this->_var['lang']['need_insure']; ?></li>
	</ul>
