<script language='javascript' src='themes/yunyigou/js/home_index.js' type='text/javascript' charset='utf-8'></script>
  
<?php $_from = $this->_var['index_category_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat_0_98306700_1495759867');$this->_foreach['index_category_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['index_category_goods']['total'] > 0):
    foreach ($_from AS $this->_var['cat_0_98306700_1495759867']):
        $this->_foreach['index_category_goods']['iteration']++;
?> 
<div class="tuijian"><img src="<?php echo $this->_var['cat_0_98306700_1495759867']['category_icon']; ?>"/><?php echo $this->_var['cat_0_98306700_1495759867']['name']; ?><div class="fr"><a href="<?php echo $this->_var['cat_0_98306700_1495759867']['url']; ?>">更多>></a></div></div>
<div style="clear:both;"></div>
<div class="w1200">  
  <div class="product_1a background_<?php echo ($this->_foreach['index_category_goods']['iteration'] - 1); ?>">
    <img src="<?php echo $this->_var['cat_0_98306700_1495759867']['category_img']; ?>"/>
    <ul>
      <?php $_from = $this->_var['cat_0_98306700_1495759867']['cat_child_tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat_child');$this->_foreach['new_goods_electrical_menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['new_goods_electrical_menu']['total'] > 0):
    foreach ($_from AS $this->_var['cat_child']):
        $this->_foreach['new_goods_electrical_menu']['iteration']++;
?>
      <?php if (($this->_foreach['new_goods_electrical_menu']['iteration'] - 1) < 14): ?>
      <li><a href="<?php echo $this->_var['cat_child']['url']; ?>"><?php echo htmlspecialchars($this->_var['cat_child']['name']); ?></a></li>
      <?php endif; ?>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </ul>    
  </div>
  <div class="product_1a_center">
  <?php $_from = $this->_var['cat_0_98306700_1495759867']['cat_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_98332600_1495759867');if (count($_from)):
    foreach ($_from AS $this->_var['goods_0_98332600_1495759867']):
?>
  <div class="tuijian_content">
      <div class="img"><a href="<?php echo $this->_var['goods_0_98332600_1495759867']['url']; ?>"><img src="<?php echo $this->_var['goods_0_98332600_1495759867']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods_0_98332600_1495759867']['name']); ?>" class="goodsimg" /></a></div>
      <a href="<?php echo $this->_var['goods_0_98332600_1495759867']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods_0_98332600_1495759867']['name']); ?>"><?php echo $this->_var['goods_0_98332600_1495759867']['short_style_name']; ?></a>
      <div><a><?php echo $this->_var['goods_0_98332600_1495759867']['shop_price']; ?></a>
      	 <?php if ($this->_var['goods_0_98332600_1495759867']['promote_price'] != ""): ?>
         <span class="original"><?php echo $this->_var['goods_0_98332600_1495759867']['promote_price']; ?></span>
         <?php else: ?>
         <span class="original"><?php echo $this->_var['goods_0_98332600_1495759867']['market_price']; ?></span>
         <?php endif; ?>
      </div>
    </div>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </div>
	<div class="product_1a_right">
      <div class="title"><img src="themes/yunyigou/images1/hot_paihang_star.png" style="padding-right:11px;"/>热销排行</div>
      <ul class="sort">
      <?php $_from = $this->_var['cat_0_98306700_1495759867']['get_sales']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'sales');$this->_foreach['top_goods_electrical'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['top_goods_electrical']['total'] > 0):
    foreach ($_from AS $this->_var['sales']):
        $this->_foreach['top_goods_electrical']['iteration']++;
?>
      <?php if ($this->_foreach['top_goods_electrical']['iteration'] < 4): ?>  
        <li>
          <span><?php echo $this->_foreach['top_goods_electrical']['iteration']; ?></span>
          <img src="<?php echo $this->_var['sales']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['sales']['name']); ?>" class="img" />                 
          <a href="#" class="name"><?php echo $this->_var['sales']['short_name']; ?><b><?php echo $this->_var['sales']['price']; ?></b></a>
        </li>
       <?php else: ?>
       	<li <?php if ($this->_foreach['top_goods_electrical']['iteration'] < 4): ?>class="iteration1"<?php endif; ?> style="clear:both;">
        	<strong><?php echo $this->_foreach['top_goods_electrical']['iteration']; ?></strong><a href="<?php echo $this->_var['sales']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['sales']['name']); ?>"><?php echo $this->_var['sales']['short_name']; ?></a>
        </li>
      <?php endif; ?>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </ul>
      
      <div class="right-side-focus">
        <ul>
        <?php $_from = $this->_var['cat_0_98306700_1495759867']['cat_child_tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat_child');$this->_foreach['new_goods_electrical_menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['new_goods_electrical_menu']['total'] > 0):
    foreach ($_from AS $this->_var['cat_child']):
        $this->_foreach['new_goods_electrical_menu']['iteration']++;
?>
        <?php if (($this->_foreach['new_goods_electrical_menu']['iteration'] - 1) < 5): ?>
           <li>
            <a href="<?php echo $this->_var['cat_child']['url']; ?>"><img src="<?php echo $this->_var['cat_child']['category_thumb']; ?>" alt="<?php echo $this->_var['cat_child']['name']; ?>" /></a>
           </li>
        <?php endif; ?>
    	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
	</div>
  </div>
</div>
<div style="clear:both;"></div>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>