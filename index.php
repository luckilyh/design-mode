<?php
define("BASEDIR", __DIR__);
include BASEDIR . '/Tool/Loader.php';
spl_autoload_register('\\Tool\\Loader::autoload');

/**
 * PHP中报500错误时如何查看错误信息
 */
ini_set("display_errors", "On");
error_reporting(E_ALL);

/**
 * PSR-0
 */
//Tool\Object::test();
//App\Controller\Home\Index::test();

/**
 * 链式操作
 */
//$db = new \Tool\Database();
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
//$MagicMethods = new \Tool\MagicMethods();
//$MagicMethods->title = 'hello word';
//echo $MagicMethods->title;
//echo '<br />';
//echo $MagicMethods->test(123);
//echo '<br />';
//echo $MagicMethods::test(123);
//echo '<br />';
//echo $MagicMethods;
//echo '<br />';
//echo $MagicMethods('test');

/**
 * 设计模式
 */
/*1.工厂模式：当一个类发生改变，只需要修改工厂模式中的类即可。如果直接 new 则需要修改大量的代码*/
$db = \Tool\Factory::createDatabase();
var_dump($db);
echo '<hr />';

/*2.单例模式：只 new 出一个对象，省出大量 new 产生的内存*/
$db = \Tool\Singleton::getInstance();
$db->test();
echo '<hr />';
//$db2 = new \Tool\Singleton(); //Fatal error: Uncaught Error: Call to private Singleton::__construct() from invalid context in
//$db3 = clone $db; //Fatal error: Uncaught Error: Call to private Singleton::__clone() from context

/*3.注册树模式：类不需要再直接 new，全局共享和交换对象。就像是一棵树一样，先把对象放在树上，用的时候取下来即可。*/
$db = \Tool\Register::get('db');
var_dump($db);
echo '<hr />';

/*4.适配器模式：可以将截然不同的函数接口封装成统一的API
    实际应用举例：PHP的数据库操作有mysql、mysqli、pdo3种，可以用适配器模式统一成一致。类似的场景还有cache适配器，将memcache、redis、file、apc等不同的缓存函数统一成一致。*/
$db = new \Tool\Database\PDO();
$db->connect('mysql', 'root', 'root', 'default');
$res = $db->query('show databases');
var_dump($res->fetchAll(\PDO::FETCH_ASSOC));
$db->close();
echo '<hr />';

/*5.策略模式：将一组特定的行为和算法封装成类，以适应某些特定的上下文环境
    实际应用举例：假如一个电商网站系统，针对男性女性用户要求各自跳转到不同的商品类目，并且所有广告位展示不同的广告。*/

class Page
{
    protected $strategy;

    function index()
    {
        echo 'AD:';
        $this->strategy->showAd();
        echo '<br />';
        echo 'Category:';
        $this->strategy->showCategory();
    }

    function setStrategy(\Tool\UserStrategy $strategy)
    {
        $this->strategy = $strategy;
    }
}

$page = new Page();
if (isset($_GET['female'])) {
    $strategy = new \Tool\Strategy\FemaleUserStrategy();
}
{
    $strategy = new \Tool\Strategy\MaleUserStrategy();
}
$page->setStrategy($strategy);
$page->index();
echo '<hr />';

/*6.数据对象映射模式：将对象和数据存储映射起来，对一个对象的操作会映射为对数据存储的操作*/
$user = new \Tool\User(1);
var_dump($user);
$user->mobile = '16666666666';
$user->name = '张三';
$user->regtime = date('Y-m-d H:i:s');
echo '<br />';

//结合工厂模式、注册器模式使用
class Page1
{
    function index()
    {
        $user = \Tool\Factory::getUser(1);
        $user->regtime = date('Y-m-d H:i:s');
        var_dump($user);
        $this->test();
    }

    function test()
    {
        $user = \Tool\Factory::getUser(1);
        var_dump($user);
        $user->mobile = '16666666666';
    }
}

$page = new Page1();
$page->index();
echo '<hr />';
/*7.观察者模式（Observer）：当一个对象状态发生改变时，依赖他的对象全部会收到通知，并自动更新
    场景：一个事件发生后，要执行一连串更新操作。传统的编程方式，就是在事件的代码之后直接加入处理逻辑。当更新的逻辑增多之后，代码会变得难以维护。这种方式是耦合的，侵入式的，增加新的逻辑需要修改事件主体的代码
    观察者模式实现了低耦合，非侵入式的通知与更新机制*/