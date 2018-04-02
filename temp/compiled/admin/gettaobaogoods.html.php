<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<div id="tabbody-div">
<form name="theForm" method="get" action="getTaoBaoGoods.php">
  <table width="100%">
  <tbody>
  <tr>
    <td class="label">淘宝商品ID:</td>
    <td><input type="text" name="id" value=""><br>(如：http://item.taobao.com/item.htm?id=3445077081 输入id 后面的数字3445077081即可)</td>
  </tr>
  <tr>
    <td class="label">保存到相册中的图片数量:</td>
    <td><input type="text" name="num" value="10"><br>(图片会下载到服务器本地，部分商品图片可能很多导致执行超时 建议控制一下数量)</td>
  </tr>
  <tr>
    <td class="label">操作:</td>
    <td><input type="radio" name="do" checked value="1">导入 <input type="radio" name="do" value="2">预览</td>
  </tr>
  <tr>
    <td class="label">使用淘宝商品名称：</td>
    <td><input type="radio" name="istitle" value="1">是<input type="radio" name="istitle" checked="checked" value="0">否</td>
  </tr>
  <tr>
    <td class="label">抓取评价并伪造为购买记录：</td>
    <td><input type="text" name="cnum" value="20">条（请填写20的倍数,例如20 40 80）</td>
  </tr>
  <tr>
  <input type="hidden" name="gid" value="<?php echo $this->_var['gid']; ?>">
    <td colspan="2" align="center">
      <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" />
    <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />
    </td>
  </tr>
</tbody></table>
</form>
</div>

<?php echo $this->fetch('pagefooter.htm'); ?>