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

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,user.js,transport.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>

<div class="block block1">

<?php if ($this->_var['action'] == 'login'): ?>

<form name="formLogin" action="user.php" method="post" onSubmit="return userLogin()">
<div class="user_login">
  <div class="w1200">
    <img src="themes/yunyigou/images/login_left.png" class="left_img"/>
    <div class="right_border">
      <ul>
        <li style="font-size:22px;margin-bottom:22px;">用户登录</li>
        <li><input name="username" type="text" size="20" class="login_user_name img_user_name" placeholder="输入用户名"/></li>
        <li><input name="password" type="password" size="20" class="login_user_name img_user_password" placeholder="输入密码"/></li>
        <?php if ($this->_var['enabled_captcha']): ?>
        <li><input type="text" size="8" name="captcha" class="login_user_yzm img_user_yzm" placeholder="验证码"/><img src="captcha.php?is_login=1&<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: middle;cursor: pointer;" class="yzm" onClick="this.src='captcha.php?is_login=1&'+Math.random()" /></li>
        <?php endif; ?>
        <li style="float:right; margin-top:20px;"><input type="checkbox" value="1" name="remember" id="remember" /><label for="remember"><?php echo $this->_var['lang']['remember']; ?></label></li>
        <li><input type="hidden" name="act" value="act_login" />
            <input type="hidden" name="back_act" value="<?php echo $this->_var['back_act']; ?>" />
            <input type="submit" name="submit" value="" class="btn_login" />
        </li>
        <li><a href="user.php?act=register" class="resegin_new_numeber">注册新账号</a> | <a href="user.php?act=get_password" class="forget_password">忘记密码 ?</a></li>
      </ul>
    </div>
  </div>
</div>
</form>

<?php endif; ?>



    <?php if ($this->_var['action'] == 'register'): ?>
    <?php if ($this->_var['shop_reg_closed'] == 1): ?>
    <div class="usBox">
      <div class="usBox_2 clearfix">
        <div class="f1 f5" align="center"><?php echo $this->_var['lang']['shop_register_closed']; ?></div>
      </div>
    </div>
    <?php else: ?>
    <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
<form action="user.php" method="post" name="formUser" onsubmit="return register();">
    
<div class="user_registe">
  <div class="w1200">
    <ul class="registe_left_list">
      <li class="title">注册后您可以享受</li>
      <li class="bg1">购买商品支付订单</li>
      <li class="bg2">推送分享给好友</li>
      <li class="bg3">正品保证</li>
      <li class="bg4">收藏商品</li>
      <li class="bg5">商品评论反馈</li>
      <li class="bg6">安全交易诚信无忧</li>
      <li class="title">您还可以</li>
      <li style="padding-left:22px;margin-top:22px;">使用已有账号,立即<a href="user.php?act=login" class="resegin_dl">登录</a>或者<a href="user.php?act=get_password" class="forget_password">找回密码?</a></li>
    </ul>

    <div class="right_border">
      <ul>
        <li style="font-size:22px;margin-bottom:22px;">用户注册</li>
        <li><input name="username" type="text" size="25" id="username" onblur="is_registered(this.value);" class="registe_user_name img_user_name" placeholder="输入一个用户名"/><span id="username_notice" style="color:#FF0000">&nbsp;</span></li>
        <li><input name="password" type="password" id="password1" onblur="check_password(this.value);" onkeyup="checkIntensity(this.value)" class="registe_user_name img_user_password" placeholder="输入一个密码"/><span style="color:#FF0000" id="password_notice">&nbsp;</span></li>
        <li><table width="333" border="0" cellspacing="0" cellpadding="1">
              <tr align="center" style="width:100%; height:20px; background:#e2e2e2;">
                <td width="33%" id="pwd_lower"><?php echo $this->_var['lang']['pwd_lower']; ?></td>
                <td width="33%" id="pwd_middle"><?php echo $this->_var['lang']['pwd_middle']; ?></td>
                <td width="33%" id="pwd_high"><?php echo $this->_var['lang']['pwd_high']; ?></td>
              </tr>
            </table>&nbsp;</li>
        <li><input name="confirm_password" type="password" id="conform_password" onblur="check_conform_password(this.value);" class="registe_user_name img_user_password" placeholder="确认密码"/><span style="color:#FF0000" id="conform_password_notice">&nbsp;</span></li>
        <li><input name="email" type="text" size="25" id="email" onblur="checkEmail(this.value);" class="registe_user_name img_user_name" placeholder="输入一个E-mail"/><span id="email_notice" style="color:#FF0000">&nbsp;</span></li>
        <?php if ($this->_var['enabled_captcha']): ?>
        <li><input type="text" size="8" name="captcha" class="registe_user_yzm img_user_yzm" placeholder="验证码"/><img src="captcha.php?<?php echo $this->_var['rand']; ?>" alt="captcha" class="yzm" onClick="this.src='captcha.php?'+Math.random()" /></li>
        <?php endif; ?>
        <li><input name="Submit" type="submit" value="" class="btn_registe"/></li>
        <li><input name="agreement" type="checkbox" value="1" checked="checked" /><?php echo $this->_var['lang']['agreement']; ?></li>
      </ul>
    </div>
  </div>
</div> 

<input name="act" type="hidden" value="act_register" />
<input type="hidden" name="back_act" value="<?php echo $this->_var['back_act']; ?>" />
</form>
<?php endif; ?>
<?php endif; ?>



    <?php if ($this->_var['action'] == 'get_password'): ?>
    <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
    <script type="text/javascript">
    <?php $_from = $this->_var['lang']['password_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
      var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </script>
    
<form action="user.php" method="post" name="getPassword" onsubmit="return submitPwdInfo();">
<div class="user_login" style="background:none;">
  <div>
    <div class="right_border" style="height:350px; margin-top:100px; float:none; margin-right:inherit;">
      <ul>
        <li style="font-size:22px;margin-bottom:22px;">密码找回</li>
        <li><input name="user_name" type="text" size="30" class="login_user_name img_user_name" placeholder="输入用户名"/></li>
        <li><input name="email" type="text" size="30" class="registe_user_name img_user_name" placeholder="输入注册的E-mail"/></li>
        <li><input type="hidden" name="act" value="send_pwd_email" />
              <input type="submit" name="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="bnt_blue" style="border:none;" />
              <input name="button" type="button" onclick="history.back()" value="<?php echo $this->_var['lang']['back_page_up']; ?>" style="border:none;" class="bnt_blue_1" />
        </li>
        <li><a href="user.php?act=login" class="resegin_dl">登录</a> | <a href="user.php?act=register" class="forget_password">注册新账号</a></li>
      </ul>
    </div>
  </div>
</div>
</form>
<?php endif; ?>


    <?php if ($this->_var['action'] == 'qpassword_name'): ?>
<div class="usBox">
  <div class="usBox_2 clearfix">
    <form action="user.php" method="post">
        <br />
        <table width="70%" border="0" align="center">
          <tr>
            <td colspan="2" align="center"><strong><?php echo $this->_var['lang']['get_question_username']; ?></strong></td>
          </tr>
          <tr>
            <td width="29%" align="right"><?php echo $this->_var['lang']['username']; ?></td>
            <td width="61%"><input name="user_name" type="text" size="30" class="inputBg" /></td>
          </tr>
          <tr>
            <td></td>
            <td><input type="hidden" name="act" value="get_passwd_question" />
              <input type="submit" name="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="bnt_blue" style="border:none;" />
              <input name="button" type="button" onclick="history.back()" value="<?php echo $this->_var['lang']['back_page_up']; ?>" style="border:none;" class="bnt_blue_1" />
	    </td>
          </tr>
        </table>
        <br />
      </form>
  </div>
</div>
<?php endif; ?>


    <?php if ($this->_var['action'] == 'get_passwd_question'): ?>
<div class="usBox">
  <div class="usBox_2 clearfix">
    <form action="user.php" method="post">
        <br />
        <table width="70%" border="0" align="center">
          <tr>
            <td colspan="2" align="center"><strong><?php echo $this->_var['lang']['input_answer']; ?></strong></td>
          </tr>
          <tr>
            <td width="29%" align="right"><?php echo $this->_var['lang']['passwd_question']; ?>：</td>
            <td width="61%"><?php echo $this->_var['passwd_question']; ?></td>
          </tr>
          <tr>
            <td align="right"><?php echo $this->_var['lang']['passwd_answer']; ?>：</td>
            <td><input name="passwd_answer" type="text" size="20" class="inputBg" /></td>
          </tr>          <?php if ($this->_var['enabled_captcha']): ?>
          <tr>
            <td align="right"><?php echo $this->_var['lang']['comment_captcha']; ?></td>
            <td><input type="text" size="8" name="captcha" class="inputBg" />
            <img src="captcha.php?is_login=1&<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: middle;cursor: pointer;" onClick="this.src='captcha.php?is_login=1&'+Math.random()" /> </td>
          </tr>
          <?php endif; ?>
          
          <tr>
            <td> </td>
<td><input type="hidden" name="act" value="check_answer" />
              <input type="submit" name="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="bnt_blue" style="border:none;" />
              <input name="button" type="button" onclick="history.back()" value="<?php echo $this->_var['lang']['back_page_up']; ?>" style="border:none;" class="bnt_blue_1" />
	    </td>
          </tr>
        </table>
        <br />
      </form>
  </div>
</div>
<?php endif; ?>

<?php if ($this->_var['action'] == 'reset_password'): ?>
    <script type="text/javascript">
    <?php $_from = $this->_var['lang']['password_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
      var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </script>    
<form action="user.php" method="post" name="getPassword2" onSubmit="return submitPwd()">
<div class="user_login" style="background:none;">
  <div>
    <div class="right_border" style="height:370px; margin-top:100px; float:none; margin-right:inherit;">
      <ul>
        <li style="font-size:22px;margin-bottom:22px;">重置密码</li>
        <li><input name="new_password" type="password" id="password1" onblur="check_password(this.value);" onkeyup="checkIntensity(this.value)" class="registe_user_name img_user_password" placeholder="输入一个新密码"/></li>
        <li><table width="333" border="0" cellspacing="0" cellpadding="1">
              <tr align="center" style="width:100%; height:20px; background:#e2e2e2;">
                <td width="33%" id="pwd_lower"><?php echo $this->_var['lang']['pwd_lower']; ?></td>
                <td width="33%" id="pwd_middle"><?php echo $this->_var['lang']['pwd_middle']; ?></td>
                <td width="33%" id="pwd_high"><?php echo $this->_var['lang']['pwd_high']; ?></td>
              </tr>
            </table>&nbsp;</li>
        <li><input name="confirm_password" type="password" id="conform_password" onblur="check_conform_password(this.value);" class="registe_user_name img_user_password" placeholder="确认密码"/></li>
        <li><input type="hidden" name="act" value="act_edit_password" />
            <input type="hidden" name="uid" value="<?php echo $this->_var['uid']; ?>" />
            <input type="hidden" name="code" value="<?php echo $this->_var['code']; ?>" />
            <input type="submit" name="submit" value="<?php echo $this->_var['lang']['confirm_submit']; ?>" />
        </li>
        <li><a href="user.php?act=login" class="resegin_dl">登录</a> | <a href="user.php?act=register" class="forget_password">注册新账号</a></li>
      </ul>
    </div>
  </div>
</div>
</form> 
<?php endif; ?>

<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
<script type="text/javascript">
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
<?php $_from = $this->_var['lang']['passport_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
var username_exist = "<?php echo $this->_var['lang']['username_exist']; ?>";
</script>
</html>
