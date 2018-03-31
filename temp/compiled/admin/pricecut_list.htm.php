<!-- $Id: valuecard_list.htm 14216 2008-03-10 02:27:21Z testyang $ -->

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>

<!-- 订单搜索 -->
<div class="form-div">
  <form action="javascript:searchVc()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    <?php echo $this->_var['lang']['notice_status']; ?>
	<select name="status" size=1>
	<option value="-1">不限</option>
	<?php $_from = $this->_var['notice_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('skey', 'status');if (count($_from)):
    foreach ($_from AS $this->_var['skey'] => $this->_var['status']):
?>
	<option value="<?php echo $this->_var['skey']; ?>"><?php echo $this->_var['status']; ?></option>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</select>
    <?php echo $this->_var['lang']['mobile']; ?>
    <input name="mobile" type="text" id="mobile" size="15">
    <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />
  </form>
</div>

<form method="POST" action="pricecut.php" name="listForm">
<!-- start user_bonus list -->
<div class="list-div" id="listDiv">
<?php endif; ?>

  <table cellpadding="3" cellspacing="1">
    <tr>
      <th>
        <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox">
        <?php echo $this->_var['lang']['pricecut_id']; ?></th>
		<th><?php echo $this->_var['lang']['mobile']; ?></th>
      <th><?php echo $this->_var['lang']['email']; ?></th>
	  <th><?php echo $this->_var['lang']['goods_name']; ?></th>
      <th><?php echo $this->_var['lang']['price_min']; ?></th>
      <th><?php echo $this->_var['lang']['price_notice']; ?></th>
	  <th><?php echo $this->_var['lang']['notice_status']; ?></th>
	  <th><?php echo $this->_var['lang']['add_time']; ?></th>
	  <th><?php echo $this->_var['lang']['remark']; ?></th>
      <th><?php echo $this->_var['lang']['handler']; ?></th>
    </tr>
    <?php $_from = $this->_var['notice_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'notice');if (count($_from)):
    foreach ($_from AS $this->_var['notice']):
?>
    <tr>
      <td><span><input value="<?php echo $this->_var['notice']['pricecut_id']; ?>" name="checkboxes[]" type="checkbox"><?php echo $this->_var['notice']['pricecut_id']; ?></span></td>
	  <td><?php echo $this->_var['notice']['mobile']; ?></td>        
      <td><?php echo $this->_var['notice']['email']; ?></td>      
	  <td align=center><?php echo $this->_var['notice']['goods_name']; ?></td>  
      <td align=center><?php echo $this->_var['notice']['min_price_format']; ?></td>
      <td align=center><?php echo $this->_var['notice']['price_format']; ?></td>
	  <td align=center><?php echo $this->_var['notice']['notice_status']; ?></td>
	  <td align=center><?php echo $this->_var['notice']['add_time']; ?></td>
	  <td align=center><?php echo $this->_var['notice']['remark']; ?></td>
      <td align="center">
        <a href="pricecut.php?act=edit&id=<?php echo $this->_var['notice']['pricecut_id']; ?>"><img src="images/icon_edit.gif" border=0 ></a>
        <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['notice']['pricecut_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>', 'remove')"><img src="images/icon_drop.gif" border="0" height="16" width="16"></a>
        </td>
    </tr>
    <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="11"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>

  <table cellpadding="4" cellspacing="0">
    <tr>
      <td></td>
      <td align="right"><?php echo $this->fetch('page.htm'); ?></td>
    </tr>
  </table>

<?php if ($this->_var['full_page']): ?>
</div>
<!-- end user_bonus list -->
</form>

<script type="text/javascript" language="JavaScript">
  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;
  listTable.query = "query";

  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

  
  onload = function()
  {
    // 开始检查订单
    startCheckOrder();
    document.forms['listForm'].reset();
  }

    function searchVc()
    {
        listTable.filter['status'] = Utils.trim(document.forms['searchForm'].elements['status'].value);
		listTable.filter['mobile'] = Utils.trim(document.forms['searchForm'].elements['mobile'].value);
        listTable.filter['page'] = 1;
        listTable.loadList();
    }

  
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>