<?php
define("BASEDIR", __DIR__);
include BASEDIR . '/Tool/Loader.php';
spl_autoload_register('\\Tool\\Loader::autoload');

/**
 * PHP中报500错误时如何查看错误信息
 */
ini_set("display_errors", "On");
error_reporting(E_ALL);

/*配置与设计模式
		1.PHP中使用ArrayAccess实现配置文件的加载
		2.在工厂方法中读取配置，生成可配置化的对象
		3.使用装饰器模式实现权限验证，模板渲染，JSON串化
		4.使用观察者模式实现数据更新事件的一系列更新操作
		5.使用代理模式实现数据库的主从自动切换*/

//1.PHP中使用ArrayAccess实现配置文件的加载
$config = new \Tool\Config(__DIR__ . '/configs');
var_dump($config['controller']);
echo '<hr />';
//2.在工厂方法中读取配置，生成可配置化的对象
$db = \Tool\Factory::getDatabase();
var_dump($db);