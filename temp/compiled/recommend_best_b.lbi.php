<div class="tuijian"><img src="themes/yunyigou/images1/index_4_87.png"/>特别推荐</div>
<div class="w1200 home-sale-layout">
<div class="left-layout">
    <ul class="tabs-nav">    
        <li class="tabs-selected"><h3>热销商品</h3></li>
        <li class=""><h3>精品推荐</h3></li>
        <li class=""><h3>新品展示</h3></li>
    </ul>
    <div class="tabs-panel sale-goods-list">
        <ul>
        	<?php $_from = $this->_var['hot_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['hot_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['hot_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['hot_goods']['iteration']++;
?>
            <?php if (($this->_foreach['hot_goods']['iteration'] - 1) < 5): ?>
            <li>
                <dl>
                    <dt class="goods-name"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><?php echo $this->_var['goods']['short_style_name']; ?></a></dt>
                    <dd class="goods-thumb">
                        <a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><img src="<?php echo $this->_var['goods']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" /></a>
                    </dd>
                    <dd class="goods-price">商城价：<em><?php if ($this->_var['goods']['promote_price'] != ""): ?><?php echo $this->_var['goods']['promote_price']; ?><?php else: ?><?php echo $this->_var['goods']['shop_price']; ?><?php endif; ?></em></dd>
                </dl>
            </li>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
    </div>
    <div class="tabs-panel sale-goods-list tabs-hide">
    	<ul>
        	<?php $_from = $this->_var['best_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['best_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['best_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['best_goods']['iteration']++;
?>
            <?php if (($this->_foreach['best_goods']['iteration'] - 1) < 5): ?>
            <li>
                <dl>
                    <dt class="goods-name"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><?php echo $this->_var['goods']['short_style_name']; ?></a></dt>
                    <dd class="goods-thumb">
                        <a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><img src="<?php echo $this->_var['goods']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" /></a>
                    </dd>
                    <dd class="goods-price">商城价：<em><?php if ($this->_var['goods']['promote_price'] != ""): ?><?php echo $this->_var['goods']['promote_price']; ?><?php else: ?><?php echo $this->_var['goods']['shop_price']; ?><?php endif; ?></em></dd>
                </dl>
            </li>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
    </div>
    <div class="tabs-panel sale-goods-list tabs-hide">
    	<ul>
        	<?php $_from = $this->_var['new_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['new_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['new_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['new_goods']['iteration']++;
?>
            <?php if (($this->_foreach['new_goods']['iteration'] - 1) < 5): ?>
            <li>
                <dl>
                    <dt class="goods-name"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><?php echo $this->_var['goods']['short_style_name']; ?></a></dt>
                    <dd class="goods-thumb">
                        <a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><img src="<?php echo $this->_var['goods']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" /></a>
                    </dd>
                    <dd class="goods-price">商城价：<em><?php if ($this->_var['goods']['promote_price'] != ""): ?><?php echo $this->_var['goods']['promote_price']; ?><?php else: ?><?php echo $this->_var['goods']['shop_price']; ?><?php endif; ?></em></dd>
                </dl>
            </li>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
    </div>
</div>

