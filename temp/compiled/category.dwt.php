<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />
<?php if ($this->_var['cat_style']): ?>
<link href="<?php echo $this->_var['cat_style']; ?>" rel="stylesheet" type="text/css" />
<?php endif; ?>

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,global.js,compare.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>
<?php echo $this->fetch('library/left_menu.lbi'); ?>
<?php echo $this->fetch('library/ur_here.lbi'); ?>

<div class="block clearfix">
  
  <div class="left-box">
    
    	<div class="box-public">
              <ul class="box-pub-title">
                  <li>推荐商品</li>
              </ul>
              <?php echo $this->fetch('library/recommend_goods.lbi'); ?>
          </div>
		<div class="box-public" style="margin-top:10px;">
            <ul class="box-pub-title">
                <li><?php echo $this->_var['lang']['view_history']; ?><a onclick="clear_history()"><?php echo $this->_var['lang']['clear_history']; ?>&nbsp;</a></li>
            </ul>
                <?php echo $this->fetch('library/history.lbi'); ?>
        </div>



    
  </div>
  
  
  <div class="box">

	 
	  <?php if ($this->_var['brands']['1'] || $this->_var['price_grade']['1'] || $this->_var['filter_attr_list']): ?>
		 <div class="box_1">
			<h3><span><?php echo $this->_var['lang']['goods_filter']; ?><i>共<?php echo $this->_var['pager']['record_count']; ?>件商品</i></span></h3>
			<?php if ($this->_var['brands']['1']): ?>
			<div class="screeBox">
			  <ul class="scree-tit"><?php echo $this->_var['lang']['brand']; ?>：</ul>
              <ul class="scree-txt">
				<?php $_from = $this->_var['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');if (count($_from)):
    foreach ($_from AS $this->_var['brand']):
?>
					<?php if ($this->_var['brand']['selected']): ?>
					<li class="scree-txt-check"><?php echo $this->_var['brand']['brand_name']; ?></li>
					<?php else: ?>
					<li><a href="<?php echo $this->_var['brand']['url']; ?>"><?php echo $this->_var['brand']['brand_name']; ?></a></li>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
               </ul>
			</div>
            <div class="blank"></div>
			<?php endif; ?>
			<?php if ($this->_var['price_grade']['1']): ?>
			<div class="screeBox">
			<ul class="scree-tit"><?php echo $this->_var['lang']['price']; ?>：</ul>
			<?php $_from = $this->_var['price_grade']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'grade');if (count($_from)):
    foreach ($_from AS $this->_var['grade']):
?>
				<?php if ($this->_var['grade']['selected']): ?>
				<li class="scree-txt-check"><?php echo $this->_var['grade']['price_range']; ?></li>
				<?php else: ?>
				<li><a href="<?php echo $this->_var['grade']['url']; ?>"><?php echo $this->_var['grade']['price_range']; ?></a></li>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</div>
            <div class="blank"></div>
			<?php endif; ?>
			<?php $_from = $this->_var['filter_attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'filter_attr_0_81658700_1495000165');if (count($_from)):
    foreach ($_from AS $this->_var['filter_attr_0_81658700_1495000165']):
?>
     		<div class="screeBox">
			<ul class="scree-tit"><?php echo htmlspecialchars($this->_var['filter_attr_0_81658700_1495000165']['filter_attr_name']); ?> :</ul>
			<?php $_from = $this->_var['filter_attr_0_81658700_1495000165']['attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'attr');if (count($_from)):
    foreach ($_from AS $this->_var['attr']):
?>
				<?php if ($this->_var['attr']['selected']): ?>
				<li class="scree-txt-check"><?php echo $this->_var['attr']['attr_value']; ?></li>
				<?php else: ?>
				<li><a href="<?php echo $this->_var['attr']['url']; ?>"><?php echo $this->_var['attr']['attr_value']; ?></a></li>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</div>
            <div class="blank"></div>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		 </div>
		<div class="blank"></div>
	  <?php endif; ?>
	 
   
<?php echo $this->fetch('library/goods_list.lbi'); ?>
<?php echo $this->fetch('library/pages.lbi'); ?>



  </div>  
  
</div>

<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
</html>
