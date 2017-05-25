<?php if ($this->_var['pictures']): ?>
 <div class="picture">
		<ul>
             <?php $_from = $this->_var['pictures']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'picture');$this->_foreach['no'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['no']['total'] > 0):
    foreach ($_from AS $this->_var['picture']):
        $this->_foreach['no']['iteration']++;
?>
              <li> 
             <?php if ($this->_foreach['no']['iteration'] < 2): ?>
          
           <a href="javascript:void(0);">
        <img src="<?php echo $this->_var['picture']['img_url']; ?>" alt="<?php echo $this->_var['goods']['goods_name']; ?>" /></a>
           <?php else: ?>
  <a href="javascript:void(0);">
        <img src="<?php echo $this->_var['picture']['img_url']; ?>" alt="<?php echo $this->_var['goods']['goods_name']; ?>" /></a>
          <?php endif; ?>
          </li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>   
</div>
 
<?php endif; ?>
<script type="text/javascript">
$(function(){
	$('.picture').find('a').mouseover(function(){
		
		var _src = $(this).find('img').attr('src');
		$('.imgInfo').find('#big_img').attr('src', _src);
        //$(this).parents('li:first').addClass('selected').siblings().removeClass('selected');
        
    });
});
</script>