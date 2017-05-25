<div class="focus_banner">
<div class="left-menu">
  <div class="menu">
  
  <?php $_from = $this->_var['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['categories'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['categories']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['categories']['iteration']++;
?>
    <div class="item">
      <div class="product">
        <h3><a style="background:url(<?php echo $this->_var['cat']['category_icon']; ?>) no-repeat;" href="<?php echo $this->_var['cat']['url']; ?>"><?php echo htmlspecialchars($this->_var['cat']['name']); ?></a></h3>
        <s style="display:block;"></s> </div>
      <div class="product-wrap">
        <div>               
            <ul>
              <li>
              <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');if (count($_from)):
    foreach ($_from AS $this->_var['child']):
?>
              <a href="<?php echo $this->_var['child']['url']; ?>" target="_blank"><?php echo htmlspecialchars($this->_var['child']['name']); ?></a>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              </li>
            </ul>
        </div>
      </div>
    </div>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
  
  </div>
</div>