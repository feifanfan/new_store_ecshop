<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<script type="text/javascript" src="../js/jquery.ztree.all-3.5.min.js"></script>
<link href="styles/zTree/zTreeStyle.css" rel="stylesheet" type="text/css" />

<table style="width: 100%" >
    <tr>
        <td valign="top">
            <input type="button" id="zhankai" value="展开" class="button" /><input type="button" id="shousuo" value="收缩" class="button" />
             <ul id="districTree" class="ztree"></ul>
        </td>
<td valign="top">

<div class="form-div" id="search_district">
  <form action="javascript:searchSnatch()" name="searchForm">
      <select name="city"  onchange="selectCity()">
      <option value="">城市</option>
    <?php $_from = $this->_var['city']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city_0_33859500_1521680906');if (count($_from)):
    foreach ($_from AS $this->_var['city_0_33859500_1521680906']):
?>
	<?php if ($this->_var['selectKey']['city'] == $this->_var['city_0_33859500_1521680906']['city']): ?>
	 <option value="<?php echo $this->_var['city_0_33859500_1521680906']['city']; ?>" selected="selected"><?php echo $this->_var['city_0_33859500_1521680906']['region_name']; ?></option>
	<?php else: ?>
	<option value="<?php echo $this->_var['city_0_33859500_1521680906']['city']; ?>"><?php echo $this->_var['city_0_33859500_1521680906']['region_name']; ?></option>
	<?php endif; ?>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>	 
    </select>
	<select name="county">
      <option value="">区县</option>
    </select>
    <?php echo $this->_var['lang']['title']; ?> <input type="text" name="keyword" id="keyword" />
    
    <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />
    
  </form>
</div>
<?php endif; ?>

<form method="POST" action="virtual_goods.php" name="listForm">
<!-- start card list -->
<div class="list-div" id="listDiv">
  <table cellspacing='1' cellpadding='3' id='list-table'>
  <tr>
    <th><input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox" />编号</th>
    <th>商圈名称</th>
    <th>区域</th>
    <th>排序</th>
    <th>是否显示</th>
    <th>操作</th>
  </tr>
  	<?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('i', 'district_list_0_33914000_1521680906');if (count($_from)):
    foreach ($_from AS $this->_var['i'] => $this->_var['district_list_0_33914000_1521680906']):
?>
  <tr>
      <td align="center"><input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['goods']['goods_id']; ?>" /><?php echo $this->_var['i']; ?></td>
        <td align="center"><span onclick="listTable.edit(this, 'edit_district_name', <?php echo $this->_var['district_list_0_33914000_1521680906']['district_id']; ?>)"><?php echo sub_str($this->_var['district_list_0_33914000_1521680906']['district_name'],15); ?></span></td>
        <td align="center"><?php echo $this->_var['district_list_0_33914000_1521680906']['area_name']; ?></span>
        </td>
        
        
        <td align="center"><span onclick="listTable.edit(this, 'edit_sort', <?php echo $this->_var['district_list_0_33914000_1521680906']['district_id']; ?>)"><?php echo $this->_var['district_list_0_33914000_1521680906']['sort']; ?></span></td>
        <td align="center"><img src="images/<?php if ($this->_var['district_list_0_33914000_1521680906']['is_show']): ?>yes<?php else: ?>no<?php endif; ?>.gif" onclick="listTable.toggle(this, 'toggle_is_show', <?php echo $this->_var['district_list_0_33914000_1521680906']['district_id']; ?>)"/></span></td>
        <td align="center">
        <a href="virtual_goods.php?act=edit_district&amp;district_id=<?php echo $this->_var['district_list_0_33914000_1521680906']['district_id']; ?>" title="<?php echo $this->_var['lang']['edit']; ?>"><img src="images/icon_edit.gif" border="0" height="16" width="16" /></a>
        <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['district_list_0_33914000_1521680906']['district_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>', 'remove_district')" title="<?php echo $this->_var['lang']['drop']; ?>"><img src="images/icon_drop.gif" border="0" height="16" width="16" /></a>
        </td>
   </tr>

  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>
 
    <table cellpadding="4" cellspacing="0">  
    <tr>
      <td><input type="submit" name="drop" id="btnSubmit" value="<?php echo $this->_var['lang']['drop']; ?>" class="button" disabled="true" /></td>
      <td align="right"><?php echo $this->fetch('page.htm'); ?></td>
    </tr>
  </table>


</div>
<!-- end card_list list -->
</form>
</td></tr></table>
<script type="text/javascript" language="JavaScript">
<!--

  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;
  listTable.query = "query_district";

  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>


  onload = function()
  {
    document.forms['searchForm'].elements['keyword'].focus();
    startCheckOrder();
  }

/**
 * 搜索团购商品
 */
function searchSnatch()
{
  var keyword = Utils.trim(document.forms['searchForm'].elements['keyword'].value);
  var city = document.forms['searchForm'].elements['city'].value;
  var county = document.forms['searchForm'].elements['county'].value;
    listTable.filter['city'] = city;
    listTable.filter['county']     = county;
    listTable.filter['keyword']     = keyword;
    listTable.loadList();
}

function selectCity(){
    var city = $("select[name='city']").val();
            $.ajax({url:'virtual_goods.php?act=selectCounty',
            dataType: 'json', 
            data:{city:city},
            success: function(data){
            $('select[name="county"]').empty();
            $('select[name="county"]').append('<option value="">区县</option>');  
            $.each(data, function(i, item) {
            $('select[name="county"]').append('<option value="'+item.county+'">'+item.region_name+'</option>');  
        })
      }
    });
}

function selectRegion(key,name){
    var region_id;

    if(key == 1){
        region_id = $('select[name="add_province"]').val();
         $('select[name="add_county"]').empty();
         $('select[name="add_county"]').append('<option value="">区县</option>');  
    }
    if(key==2){
        region_id = $('select[name="add_city"]').val();
    }
    if(key==3){
        region_id = $('select[name="add_county"]').val();
    }
        
    $.ajax({
        url:'virtual_goods.php?act=get_region_list',
        dataType: 'json', 
        data:{region_id:region_id},
        success:function(data){
            $('select[name="'+name+'"]').empty();
            $('select[name="'+name+'"]').append('<option value="">全部</option>');  
            $.each(data, function(i, item) {
                $('select[name="'+name+'"]').append('<option value="'+item.region_id+'">'+item.region_name+'</option>');  
            })
        }
    })
}

 
var setting = {  
    async :{
        enable : true,
        url:"virtual_goods.php?act=get_district_tree",
        autoParam : ["id"]
    },
 check: { /**复选框**/  
  enable: false,  
  chkboxType: {"Y":"", "N":""}  
 },  
 view: {                                    
  dblClickExpand: true,
  expandSpeed: 300, //设置树展开的动画速度，IE6下面没效果，  
 // fontCss : {color:"red"}
 },                            
 data: {                                    
   simpleData: {   //简单的数据源，一般开发中都是从数据库里读取，API有介绍，这里只是本地的                           
   enable: true,  
   idKey: "id",  //id和pid，这里不用多说了吧，树的目录级别  
   pIdKey: "pId",  
   rootPId: 0   //根节点  
  }                            
 },                           
 callback: {     /**回调函数的设置，随便写了两个**/  
    beforeClick: beforeClick,                                    
  onClick : onClick,
 }  
}; 

function beforeClick(e,treeId, treeNode) {  
  
}     
function onClick(event, treeId, treeNode){  
    
    
        if(treeNode.pId == 0){
            listTable.filter['city'] = treeNode.id;
            listTable.filter['county']   = '';
        }else{
            listTable.filter['city'] = treeNode.pId;
            listTable.filter['county']     = treeNode.id;
        }
        listTable.loadList();
        
        
}

$(document).ready(function(){//初始化ztree对象     
//    $.ajax({
//        url:"virtual_goods.php?act=get_district_tree",
//        dataType: 'json', 
//        success : function(data){
//        var zTreeDemo = $.fn.zTree.init($("#districTree"),setting, data);  
//        zTreeDemo.expandAll(true); 
//    }
//});
 var zTreeDemo = $.fn.zTree.init($("#districTree"),setting);  
 
});

$("#zhankai").click(function(){
    var zTreeDemo = $.fn.zTree.getZTreeObj("districTree"); 
    zTreeDemo.expandAll(true); 
});
$("#shousuo").click(function(){
    var zTreeDemo =  $.fn.zTree.getZTreeObj("districTree"); 
    zTreeDemo.expandAll(false); 
});
//-->
</script>

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>
