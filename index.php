<?php

define("BASEDIR", __DIR__);
include BASEDIR . '/IMooc/Loader.php';
spl_autoload_register('\\IMooc\\Loader::autoload');

/**
 * PHP中报500错误时如何查看错误信息
 */
ini_set("display_errors","On");
error_reporting(E_ALL);

/**
 * PSR-0
 */
//IMooc\Object::test();
//App\Controller\Home\Index::test();

/**
 * 链式操作
 */
//$db = new \IMooc\Database();
///*$db->where('id=1');
//$db->where('name=2');
//$db->order('id desc');
//$db->limit(10);*/
//$db->where('id=1')->where('name=2')->order('id desc')->limit(10);

/**
 * 魔术方法
 * __get & __set 当调用不存在的属性时调用
 * __call & __callStatic 当调用不存在的方法时调用
 * __toString 当一个对象被当作字符串对待时调用
 * __invoke 把一个对象当函数使用时调用
 */
$MagicMethods = new \IMooc\MagicMethods();
$MagicMethods->title = 'hello word';
echo $MagicMethods->title;
echo '<br />';
echo $MagicMethods->test(123);
echo '<br />';
echo $MagicMethods::test(123);
echo '<br />';
echo $MagicMethods;
echo '<br />';
echo $MagicMethods('test');