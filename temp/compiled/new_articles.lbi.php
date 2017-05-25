
	<div class="left">
      <ul>
        <li class="title">优质服务</li>
        <li style="background:#fff;"><img src="themes/yunyigou/images1/lct_pz.jpg"/></li>
      </ul>
      <div class="news">
        <div class="title_2">
          <div>雲易购新闻</div>
          <a class="fr" href="#">更多>></a>
        </div>
        <div style="clear:both;"></div>        
        <?php $_from = $this->_var['new_articles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');$this->_foreach['new_articles'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['new_articles']['total'] > 0):
    foreach ($_from AS $this->_var['article']):
        $this->_foreach['new_articles']['iteration']++;
?>
        <?php if (($this->_foreach['new_articles']['iteration'] - 1) < 5): ?>
        <ul class="news_content">
          <li><a class="fl" href="<?php echo $this->_var['article']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['article']['title']); ?>"><?php echo sub_str($this->_var['article']['short_title'],10); ?></a></li>
          <li class="fr"><?php echo $this->_var['article']['add_time']; ?></li>
        </ul>
        <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>          
      </div>
      <div class="service">
        <div style="line-height:33px;margin-left:12px;">生活服务</div>
        <table class="fk">
          <tr>
            <td><a href="https://life.baifubao.com/sj" target="_blank"><img src="themes/yunyigou/images1/huafei.png" class="img"/></a></td>
            <td><img src="themes/yunyigou/images1/nongchanpin.png" class="img"/></td>
            <td><a href="http://www.kuaidi100.com" target="_blank"><img src="themes/yunyigou/images1/wuliu.png" class="img"/></a></td>
          </tr>
          <tr>
            <td><a href="http://www.weather.com.cn/" target="_blank"><img src="themes/yunyigou/images1/weather_seach.png" class="img"/></a></td>
            <td></td>
            <td></td>
          </tr>
        </table>
      </div>
</div>
</div>
<div style="clear:both;"></div>




	