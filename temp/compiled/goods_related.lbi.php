<?php if ($this->_var['related_goods']): ?>
<div class="box">
      <div class="boxCenterList clearfix">
      <?php $_from = $this->_var['related_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'releated_goods_data');if (count($_from)):
    foreach ($_from AS $this->_var['releated_goods_data']):
?>
        <ul class="clearfix">
          <li class="goodsimg"><a href="<?php echo $this->_var['releated_goods_data']['url']; ?>"><img src="<?php echo $this->_var['releated_goods_data']['goods_thumb']; ?>" alt="<?php echo $this->_var['releated_goods_data']['goods_name']; ?>" class="B_blue" /></a></li>
          <li>
        <a href="<?php echo $this->_var['releated_goods_data']['url']; ?>" title="<?php echo $this->_var['releated_goods_data']['goods_name']; ?>"><?php echo $this->_var['releated_goods_data']['short_name']; ?></a><br />
        <?php if ($this->_var['releated_goods_data']['promote_price'] != 0): ?>
        <font class="f1"><?php echo $this->_var['releated_goods_data']['formated_promote_price']; ?></font>
        <?php else: ?>
        <font class="f1"><?php echo $this->_var['releated_goods_data']['shop_price']; ?></font>
        <?php endif; ?>
          </li>
        </ul>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </div>
    </div>
<div class="blank5"></div>
<?php endif; ?>
