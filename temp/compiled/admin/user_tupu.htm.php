<?php echo $this->fetch('pageheader.htm'); ?> <?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js,placeholder.js')); ?>
<style type="text/css">
	.content{
		margin:0 auto;
		width: 60%;
		height: 600px;
	}
	.lspan{
		width: 100%;
		height: 100px;
		float: left;
	}
	.llspan{
		width: 50%;
		height: 100px;
		float: left;
	}
	.first{
		width: 100%;
		float: left;
		text-align: center;
	}
	.second{
		width:50%;
		float: left;
		text-align: center;
	}
	.third{
		width:25%;
		float: left;
		text-align: center;
	}
	button{
		color: #fff;
		width: 100px;
		height: 30px;
		background-color: #CCCCCC;
	}
</style>
<div style="width: 100%;float: left;height: auto;">
	<div class="content">
		<div class="first">
			<button <?php if ($this->_var['user'] [ 0 ] [ 'user_status' ]): ?>style="border:1;border-color:#6495ED;background-color:#6495ED"<?php else: ?>style="border:0;"<?php endif; ?>><?php echo $this->_var['user']['0']['user_name']; ?></button>
		</div>

		<span class="lspan"><img src="images/tupu_line.png" style="width: 100%;height: 100px;"></span>

		<div class="second">
			<button <?php if ($this->_var['user'] [ 1 ] == null): ?> style="border:0;background-color: #fff"<?php endif; ?><?php if ($this->_var['user'] [ 1 ] [ 'user_status' ]): ?>style="border:1;border-color:#6495ED;background-color:#6495ED"<?php else: ?>style="border:0;"<?php endif; ?><?php if ($this->_var['user'] [ 1 ] != null): ?> onclick="window.location='users.php?act=tupu&user_id=<?php echo $this->_var['user']['1']['user_id']; ?>'"<?php endif; ?>><?php echo $this->_var['user']['1']['user_name']; ?></button>
		</div>

		<div class="second">
			<button <?php if ($this->_var['user'] [ 2 ] == null): ?> style="border:0;background-color: #fff"<?php endif; ?><?php if ($this->_var['user'] [ 2 ] [ 'user_status' ]): ?>style="border:1;border-color:#6495ED;background-color:#6495ED"<?php else: ?>style="border:0;"<?php endif; ?><?php if ($this->_var['user'] [ 2 ] != null): ?> onclick="window.location='users.php?act=tupu&user_id=<?php echo $this->_var['user']['2']['user_id']; ?>'"<?php endif; ?>><?php echo $this->_var['user']['2']['user_name']; ?></button>
		</div>

		<span class="lspan">
			<span class="llspan">
				<img src="images/tupu_line.png" style="width: 100%;height: 100px;">
			</span>
			<span class="llspan">
				<img src="images/tupu_line.png" style="width: 100%;height: 100px;">
			</span>
		</span>

		<div class="third">
			<button <?php if ($this->_var['user'] [ 3 ] == null): ?> style="border:0;background-color: #fff" <?php endif; ?><?php if ($this->_var['user'] [ 3 ] [ 'user_status' ]): ?>style="border:1;border-color:#6495ED;background-color:#6495ED"<?php else: ?>style="border:0;"<?php endif; ?><?php if ($this->_var['user'] [ 3 ] == null): ?> onclick="window.location='users.php?act=tupu&user_id=<?php echo $this->_var['user']['3']['user_id']; ?>'"<?php endif; ?>><?php echo $this->_var['user']['3']['user_name']; ?></button>
		</div>

		<div class="third">
			<button <?php if ($this->_var['user'] [ 4 ] == null): ?> style="border:0;background-color: #fff"<?php endif; ?><?php if ($this->_var['user'] [ 4 ] [ 'user_status' ]): ?>style="border:1;border-color:#6495ED;background-color:#6495ED"<?php else: ?>style="border:0;"<?php endif; ?><?php if ($this->_var['user'] [ 4 ] == null): ?> onclick="window.location='users.php?act=tupu&user_id=<?php echo $this->_var['user']['4']['user_id']; ?>'"<?php endif; ?>><?php echo $this->_var['user']['4']['user_name']; ?></button>
		</div>

		<div class="third">
			<button <?php if ($this->_var['user'] [ 5 ] == null): ?> style="border:0;background-color: #fff"<?php endif; ?><?php if ($this->_var['user'] [ 5 ] [ 'user_status' ]): ?>style="border:1;border-color:#6495ED;background-color:#6495ED"<?php else: ?>style="border:0;"<?php endif; ?><?php if ($this->_var['user'] [ 5 ] != null): ?> onclick="window.location='users.php?act=tupu&user_id=<?php echo $this->_var['user']['5']['user_id']; ?>'"<?php endif; ?>><?php echo $this->_var['user']['5']['user_name']; ?></button>
		</div>

		<div class="third">
			<button <?php if ($this->_var['user'] [ 6 ] == null): ?> style="border:0;background-color: #fff"<?php endif; ?><?php if ($this->_var['user'] [ 6 ] [ 'user_status' ]): ?>style="border:1;border-color:#6495ED;background-color:#6495ED"<?php else: ?>style="border:0;"<?php endif; ?><?php if ($this->_var['user'] [ 6 ] != null): ?> onclick="window.location='users.php?act=tupu&user_id=<?php echo $this->_var['user']['6']['user_id']; ?>'"<?php endif; ?>><?php echo $this->_var['user']['6']['user_name']; ?></button>
		</div>
	</div>
</div>


<?php echo $this->fetch('pagefooter.htm'); ?>