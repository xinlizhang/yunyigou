<?php if(!defined('ROOT')) die('Access denied.');

class c_index extends Admin{

    function index($path){
		
		//获取统计数据
		$comms = APP::$DB->getOne("SELECT COUNT(cid) AS nums FROM " . TABLE_PREFIX . "comment WHERE readed = 0");

		SubMenu('欢迎进入 '.APP_NAME.' 管理中心', array(
			array('查看留言', 'comments'),
			array('管理客人', 'guests'),
			array('管理记录', 'messages'),
			array('管理客服', 'users')
		));

		$welcome = '<ul><li>欢迎 <font class=orange>'.$this->admin['fullname'].'</font> 进入后台管理面板! 为了确保系统安全, 请在关闭前点击 <a href="#" class="logout">退出</a> 安全离开!</li>
		<li>隐私保护: <span class="note2">'.APP_NAME.'郑重承诺, 您在使用本系统时, YunYiGou开发商不会收集您的任何信息</span>.</li></ul>';

		ShowTips($welcome, '系统信息');

		BR(2);

		TableHeader('客服操作技巧说明');

		TableRow('<font class=grey>1)</font>&nbsp;&nbsp;客服窗口中, 按 Ctrl + Alt, 在客服交流区与当前客人小窗口间切换.');
		TableRow('<font class=grey>2)</font>&nbsp;&nbsp;客服窗口中, 按 Ctrl + 下箭头 或 Esc键, 关闭当前客人小窗口. 如果小窗口都关闭了, 自动切换到客服交流区.');
		TableRow('<font class=grey>3)</font>&nbsp;&nbsp;客服窗口中, 按 Ctrl + 上箭头, 展开关闭的客人小窗口.');
		TableRow('<font class=grey>4)</font>&nbsp;&nbsp;客服窗口中, 按 Ctrl + 左或右箭头, 在已展开的客人小窗口间切换.');
		TableRow('<font class=grey>5)</font>&nbsp;&nbsp;客服窗口中, 客人被踢出或禁言后, 刷新页面仍可重新进入客服, 即此两项操作仅作用于当前对话.');
		TableRow('<font class=grey>6)</font>&nbsp;&nbsp;默认安装后, 前台客服小面板不会自动展开, 即不会进入客服. 如何希望自动展开, 可打开根目录下的welive.js文件, 修改 <span class=note>welive_auto=0</span> 代码中的0为N秒.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp那么, 当用户浏览器打开页面并停留N秒后, 客服小面板将自动展开, 即进入客服. 如果无客服在线, 将自动显示留言板.');
		TableRow('<font class=grey>7)</font>&nbsp;&nbsp;在客服窗口中的客服交流区, 管理员可发送特殊指令: system die --- Socket服务将中止(<span class=note>慎用</span>);&nbsp;&nbsp;all --- 显示所有连接数;&nbsp;&nbsp;admin --- 显示所有客服及其客人数;&nbsp;&nbsp;guest --- 显示客人数');

		TableFooter();

		$info_total = $comms['nums'];

		//更新顶部提示信息
		echo '<script type="text/javascript">
			$(function(){
				var info_total = ' . $info_total . ';

				if(info_total > 0){
					$("#topuser dl#info_all").removeClass("none");
					$("#topuser #info_total").html(info_total);
					$("#topuser #info_comms").html(info_total).attr("class", "orangeb");

				}

				//将统计数据保存为cookie. 注: header已发送, 此页面不能使用php保存cookie
				setCookie("' . COOKIE_KEY . 'backinfos", info_total, 365);
			});
		</script>';
    }

}

?>