<?php if ($this->_var['user_info']): ?>
<font style="position:relative;">
<?php echo $this->_var['lang']['hello']; ?>，<font class="f4_b"><?php echo $this->_var['user_info']['username']; ?></font>, <?php echo $this->_var['lang']['welcome_return']; ?>！
<a href="user.php"><?php echo $this->_var['lang']['user_center']; ?></a>|
 <a href="user.php?act=logout"><?php echo $this->_var['lang']['user_logout']; ?></a>
</font>
<?php else: ?>
您好，欢迎光临本店！ 
 <a href="user.php">[请登录]</a>，新用户？
 <a href="user.php?act=register">[免费注册]</a>
<?php endif; ?>