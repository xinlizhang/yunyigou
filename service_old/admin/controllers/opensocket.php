<?php if(!defined('ROOT')) die('Access denied.');

class c_opensocket extends Admin{

	public function __construct($path){
		parent::__construct($path);

		header_nocache(); //不缓存
	}

	public function ajax(){
		//判断Socket模块是否加载
		if(!extension_loaded('sockets')) die('php sockets extension not loaded!');

		//判断websocket服务器是否已运行, 没有运行则执行下面的代码创建, 防止重复创建websocket
		if(!add_lock('welive')) die('WEBSOCKET server is running ...');

		// socket接受或发送的最大数据限制(字节) 128K
		define('WEBSOCKET_MAX', 1024 * 128);

		// 最大连接数(设置大些, 可能有仅连接不传送信息的非法连接, 无法关闭)
		define('WEBSOCKET_ONLINE', 2048);

		// 屏蔽错误代码
		error_reporting(0);

		// 设置超时时间
		@set_time_limit(0);
		@ignore_user_abort(true); //忽略用户断开连接, 服务器脚本仍运行

		// 设置当前脚本可使用的最大内存, 默认为1024M, 同时连接人数太多时，可能不够
		@ini_set('memory_limit', '1024M');

		$websocket = new Websocket(WS_HOST, WS_PORT);
		$websocket->domain = ''; //允许的域名

		$websocket->run();
		echo socket_strerror($websocket->error());
	}
} 


//锁定文件
function add_lock($keys) {
	global $_lock;

	if(!isset($_lock)) $_lock = array();
	if(isset($_lock[$keys])) return false;
	
	$_lock[$keys]['file'] = ROOT. 'config/'. md5($keys) . '.txt';
	$_lock[$keys]['data'] = fopen($_lock[$keys]['file'], 'w+');

	$locked = flock($_lock[$keys]['data'], LOCK_EX|LOCK_NB);
	
	if(!$locked) {
		fclose($_lock[$keys]['data']);
		unset($_lock[$keys]);
		return false;
	}
	
	return true;
}

//查找IP归属地
function convertip($ip) {
	$return = '';
	if(preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/", $ip)) {
		$iparray = explode('.', $ip);

		if($iparray[0] == 10 || $iparray[0] == 127 || ($iparray[0] == 192 && $iparray[1] == 168) || ($iparray[0] == 172 && ($iparray[1] >= 16 && $iparray[1] <= 31))) {
			$return = 'LAN';
		} elseif($iparray[0] > 255 || $iparray[1] > 255 || $iparray[2] > 255 || $iparray[3] > 255) {
			$return = '未知'; //无效的IP地址!
		} else {
			$return = convertip_tiny($ip);
		}
	}

	return $return;
}

// ##
function convertip_tiny($ip) {
	static $fp = NULL, $offset = array(), $index = NULL;

	$ipdot = explode('.', $ip);
	$ip    = pack('N', ip2long($ip));

	$ipdot[0] = (int)$ipdot[0];
	$ipdot[1] = (int)$ipdot[1];

	if($fp === NULL && $fp = @fopen(ROOT . 'includes/tinyipdata.dat', 'rb')) {
		$offset = @unpack('Nlen', @fread($fp, 4));
		$index  = @fread($fp, $offset['len'] - 4);
	}elseif($fp == FALSE) {
		return  '未知'; //IP数据库文件不可用
	}

	$length = $offset['len'] - 1028;
	$start  = @unpack('Vlen', $index[$ipdot[0] * 4] . $index[$ipdot[0] * 4 + 1] . $index[$ipdot[0] * 4 + 2] . $index[$ipdot[0] * 4 + 3]);

	for ($start = $start['len'] * 8 + 1024; $start < $length; $start += 8) {
		if ($index{$start} . $index{$start + 1} . $index{$start + 2} . $index{$start + 3} >= $ip) {
			$index_offset = @unpack('Vlen', $index{$start + 4} . $index{$start + 5} . $index{$start + 6} . "\x0");
			$index_length = @unpack('Clen', $index{$start + 7});
			break;
		}
	}

	@fseek($fp, $offset['len'] + $index_offset['len'] - 1024);
	if($index_length['len']) {
		return @fread($fp, $index_length['len']);
	} else {
		return '未知';
	}
}


?>