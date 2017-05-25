<?php if ($this->_var['bought_goods']): ?>
     <div class="box" style="width:980px; margin-left:10px;">
     <h3 style="border-bottom:2px solid #ff7126; text-align:left; margin-top:20px; font-size:14px; font-weight:bold; padding-left:20px;"><?php echo $this->_var['lang']['shopping_and_other']; ?></h3>
      <div class="boxCenterList clearfix ie6" style="padding-top:20px;">
       <?php $_from = $this->_var['bought_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'bought_goods_data');if (count($_from)):
    foreach ($_from AS $this->_var['bought_goods_data']):
?>
        <div class="goodsItem">
         <a href="<?php echo $this->_var['bought_goods_data']['url']; ?>"><img src="<?php echo $this->_var['bought_goods_data']['goods_thumb']; ?>" alt="<?php echo $this->_var['bought_goods_data']['goods_name']; ?>"  class="goodsimg" /></a><br />
         <p><a href="<?php echo $this->_var['bought_goods_data']['url']; ?>" title="<?php echo $this->_var['bought_goods_data']['goods_name']; ?>"><?php echo $this->_var['bought_goods_data']['short_name']; ?></a></p> 
         <?php if ($this->_var['bought_goods_data']['promote_price'] != 0): ?>
        <font class="shop_s"><?php echo $this->_var['bought_goods_data']['formated_promote_price']; ?></font>
        <?php else: ?>
        <font class="shop_s"><?php echo $this->_var['bought_goods_data']['shop_price']; ?></font>
        <?php endif; ?>
        </div>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </div>
    </div>
    <div class="blank5"></div>
    <?php endif; ?>