<link href="themes/yunyigou/index.css" rel="stylesheet" type="text/css" />
<?php echo $this->smarty_insert_scripts(array('files'=>'transport.js,utils.js')); ?>
<script language='javascript' src='themes/yunyigou/js/jquery.min.js' type='text/javascript' charset='utf-8'></script>

<script language='javascript' src='themes/yunyigou/js/index.js' type='text/javascript' charset='utf-8'></script>
<script type="text/javascript">
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
</script>

<div class="top1">
  <div class="content">
    <div class="left"><?php 
$k = array (
  'name' => 'member_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></div>
    <div class="right"><?php if ($this->_var['navigator_list']['top']): ?>
    <?php $_from = $this->_var['navigator_list']['top']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'nav');$this->_foreach['nav_top_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_top_list']['total'] > 0):
    foreach ($_from AS $this->_var['nav']):
        $this->_foreach['nav_top_list']['iteration']++;
?>
           <a style="color:#666" href="<?php echo $this->_var['nav']['url']; ?>" <?php if ($this->_var['nav']['opennew'] == 1): ?> target="_blank" <?php endif; ?>><?php echo $this->_var['nav']['name']; ?></a>  |
     <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>        
   <?php endif; ?></div>
  </div>  
</div>

<div style="clear:both"></div>


<div class="top2">
  <div class="content">
    <div class="left">
      <a href="index.php" alt="众方医药"><img src="themes/yunyigou/images1/index_4_03.png" style="margin-top:8px;"/></a>
    </div> 
    <div class="left">
      <div class="seach">
        <div class="seach_border">
        <form name="searchForm" method="get" action="search.php" onSubmit="return checkSearchForm()">
            <input name="keywords" id="keyword" type="text" class="input-text" value="" maxlength="60" x-webkit-speech="" lang="zh-CN" onwebkitspeechchange="foo()" placeholder="请输入您要搜索的商品关键字" x-webkit-grammar="builtin:search" _hover-ignore="1">
            <input name="imageField" type="submit" id="button" value="搜索" class="input-submit" style="cursor:pointer;"/>
            <a href="search.php?act=advanced_search" class="submit_a" ><?php echo $this->_var['lang']['advanced_search']; ?></a>
        </form>
        </div>  
        <?php if ($this->_var['searchkeywords']): ?><div class="hot_seach"><?php echo $this->_var['lang']['hot_search']; ?>：<?php $_from = $this->_var['searchkeywords']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');if (count($_from)):
    foreach ($_from AS $this->_var['val']):
?><a href="search.php?keywords=<?php echo urlencode($this->_var['val']); ?>"><?php echo $this->_var['val']; ?></a><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?></div><?php endif; ?>
      </div>
    </div> 
    <div class="right">
    	<div class="top-cart" onClick="location.href='flow.php'">
            <?php 
$k = array (
  'name' => 'cart_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
        </div>
      <img src="themes/yunyigou/images1/index_4_06.png" style="margin-top:12px;">
    </div>
  </div>  
</div>


<div style="clear:both"></div>
<div class="nav-wrap">
  <div class="nav">
    
    <ul class="nav-list cf">
      <li class="nav-all">所有商品分类</li>
      <li> <a href="index.php" class="on">首页</a> </li>
      <?php $_from = $this->_var['navigator_list']['middle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'nav');$this->_foreach['nav_middle_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_middle_list']['total'] > 0):
    foreach ($_from AS $this->_var['nav']):
        $this->_foreach['nav_middle_list']['iteration']++;
?>
      <li><a href="<?php echo $this->_var['nav']['url']; ?>" <?php if ($this->_var['nav']['opennew'] == 1): ?>target="_blank" <?php endif; ?> <?php if ($this->_var['nav']['active'] == 1): ?> class="cur"<?php endif; ?>><?php echo $this->_var['nav']['name']; ?> </a></li>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </ul>
  </div>
</div>

<div style="clear:both"></div>

<script type="text/javascript">
    
    <!--
    function checkSearchForm()
    {
        if(document.getElementById('keyword').value)
        {
            return true;
        }
        else
        {
             alert("<?php echo $this->_var['lang']['no_keywords']; ?>");
            return false;
        }
    }
    -->
    
</script>

