<?php if ($this->_var['vote']): ?>
<style type="text/css">
.boxCenterList p{height:25px;line-height:25px; vertical-align:middle}
</style>
<div id="ECS_VOTE">
  <div  class="boxCenterList" style="padding:8px;">
    <form id="formvote" name="ECS_VOTEFORM" method="post" action="javascript:submit_vote()">
    <?php $_from = $this->_var['vote']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'title');if (count($_from)):
    foreach ($_from AS $this->_var['title']):
?>
     <p><?php echo $this->_var['title']['vote_name']; ?></p>
     <p>(<?php echo $this->_var['lang']['vote_times']; ?>:<?php echo $this->_var['title']['vote_count']; ?>)</p>
     <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
     <?php $_from = $this->_var['vote']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'title');if (count($_from)):
    foreach ($_from AS $this->_var['title']):
?>
          <?php $_from = $this->_var['title']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item_0_92230100_1521594223');if (count($_from)):
    foreach ($_from AS $this->_var['item_0_92230100_1521594223']):
?>
            <?php if ($this->_var['title']['can_multi'] == 0): ?>
            <p><input type="checkbox" name="option_id" value="<?php echo $this->_var['item_0_92230100_1521594223']['option_id']; ?>" />
            <?php echo $this->_var['item_0_92230100_1521594223']['option_name']; ?> (<?php echo $this->_var['item_0_92230100_1521594223']['percent']; ?>%)</p>
            <?php else: ?>
            <p><input type="radio" name="option_id" value="<?php echo $this->_var['item_0_92230100_1521594223']['option_id']; ?>" />
            <?php echo $this->_var['item_0_92230100_1521594223']['option_name']; ?> (<?php echo $this->_var['item_0_92230100_1521594223']['percent']; ?>%)</p>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <input type="hidden" name="type" value="<?php echo $this->_var['title']['can_multi']; ?>" />
     <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
     <input type="hidden" name="id" value="<?php echo $this->_var['vote_id']; ?>" />
     <div style="height:3px; line-height:3px; clear:both;"></div>
 <input type="submit" name="submit" value="<?php echo $this->_var['lang']['submit']; ?>"  style="background:#ff6400; width:63px; height:25px; border:none; color:#fff;"/>
<input type="reset" value="<?php echo $this->_var['lang']['reset']; ?>"  style="background:#ff6400; width:63px; height:25px; border:none; color:#fff;" />
     </form>
  </div>

</div>
<div class="blank5"></div>
<script type="text/javascript">

/**
 * 处理用户的投票
 */
function submit_vote()
{
  var frm     = document.forms['ECS_VOTEFORM'];
  var type    = frm.elements['type'].value;
  var vote_id = frm.elements['id'].value;
  var option_id = 0;

  if (frm.elements['option_id'].checked)
  {
    option_id = frm.elements['option_id'].value;
  }
  else
  {
    for (i=0; i<frm.elements['option_id'].length; i++ )
    {
      if (frm.elements['option_id'][i].checked)
      {
        option_id = (type == 0) ? option_id + "," + frm.elements['option_id'][i].value : frm.elements['option_id'][i].value;
      }
    }
  }

  if (option_id == 0)
  {
    return;
  }
  else
  {
    Ajax.call('vote.php', 'vote=' + vote_id + '&options=' + option_id + "&type=" + type, voteResponse, 'POST', 'JSON');
  }
}

/**
 * 处理投票的反馈信息
 */
function voteResponse(result)
{
  if (result.message.length > 0)
  {
    alert(result.message);
  }
  if (result.error == 0)
  {
    var layer = document.getElementById('ECS_VOTE');

    if (layer)
    {
      //layer.innerHTML = result.content;
    }
  }
}

</script>
<?php endif; ?>
