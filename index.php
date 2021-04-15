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
 * 面向对象编程的基本原则
    1.单一职责：一个类，只需要做好一件事情。
    2.开放封闭：一个类，应该是可扩展的，而不可修改的。
    3.依赖倒置：一个类，不应该强依赖另外一个类。每个类对于另外一个类都是可替换的
    4.配置化：尽可能地使用配置，而不是硬编码。
    5.面向接口编程：只需要关心接口，不需要关心实现。
 */
/*1.工厂模式：
    当一个类发生改变，只需要修改工厂模式中的类即可。如果直接 new 则需要修改大量的代码*/
$db = \Tool\Factory::createDatabase();
var_dump($db);
echo '<hr />';

/*2.单例模式：
    只 new 出一个对象，省出大量 new 产生的内存*/
$db = \Tool\Singleton::getInstance();
$db->test();
echo '<hr />';
//$db2 = new \Tool\Singleton(); //Fatal error: Uncaught Error: Call to private Singleton::__construct() from invalid context in
//$db3 = clone $db; //Fatal error: Uncaught Error: Call to private Singleton::__clone() from context

/*3.注册树模式：相当于laravel中的 Facades（https://learnku.com/docs/laravel/7.x/facades/7456）
    类不需要再直接 new，全局共享和交换对象。就像是一棵树一样，先把对象放在树上，用的时候取下来即可。*/
$db = \Tool\Register::get('db');
var_dump($db);
echo '<hr />';

/*4.适配器模式：相当于laravel中的数据库操作（https://learnku.com/docs/laravel/7.x/database/7493）
    可以将截然不同的函数接口封装成统一的API
    实际应用举例：PHP的数据库操作有mysql、mysqli、pdo3种，可以用适配器模式统一成一致。类似的场景还有cache适配器，将memcache、redis、file、apc等不同的缓存函数统一成一致。*/
$db = new \Tool\Database\PDO();
$db->connect('mysql', 'root', 'root', 'default');
$res = $db->query('show databases');
var_dump($res->fetchAll(\PDO::FETCH_ASSOC));
$db->close();
echo '<hr />';

/*5.策略模式：相当于laravel中的用户认证（https://learnku.com/docs/laravel/7.x/authentication/7474）
    将一组特定的行为和算法封装成类，以适应某些特定的上下文环境
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

/*6.数据对象映射模式：相当于laravel中的 模型（https://learnku.com/docs/laravel/7.x/eloquent/7499）
    将对象和数据存储映射起来，对一个对象的操作会映射为对数据存储的操作*/
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
        echo '<br />';
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

/*7.观察者模式（Observer）：相当于laravel中的 事件系统（https://learnku.com/docs/laravel/7.x/events/7484）
    当一个对象状态发生改变时，依赖他的对象全部会收到通知，并自动更新
    场景：一个事件发生后，要执行一连串更新操作。传统的编程方式，就是在事件的代码之后直接加入处理逻辑。当更新的逻辑增多之后，代码会变得难以维护。这种方式是耦合的，侵入式的，增加新的逻辑需要修改事件主体的代码
    观察者模式实现了低耦合，非侵入式的通知与更新机制*/

class Event extends \Tool\EventGenerator
{
    function trigger()
    {
        echo 'Event<br />';

        $this->notify();
    }
}

class Observer1 implements \Tool\Observer
{
    function update($event_info = null)
    {
        echo '逻辑1<br />';
    }
}

class Observer2 implements \Tool\Observer
{
    function update($event_info = null)
    {
        echo '逻辑2<br />';
    }
}

$event = new Event();
$event->addObserver(new Observer1());
$event->addObserver(new Observer2());
$event->trigger();
echo '<hr />';

/*8.原型模式：
		与工厂模式作用类似，都是用来创建对象
		与工厂模式的实现不同，原型模式是先创建好一个原型对象，然后通过clone原型对象来创建新的对象。这样就免去了类创建时重复的初始操作
		原型模式适用于大对象的创建。创建一个大对象需要很大的开销，如果每次new就会消耗很大，原型模式仅需要内存拷贝即可*/
$canvas1 = new \Tool\Canvas();
$canvas1->init();
$canvas1->rect(3, 6, 4, 12);
$canvas1->draw();
echo '<br />';
$canvas2 = new \Tool\Canvas();
$canvas2->init();
$canvas2->rect(1, 3, 2, 6);
$canvas2->draw();
echo '<br />';
//因为init产生了20x10=200次的循环，上述方法多次new对象，消耗很大内存
$prototype = new \Tool\Canvas();
$prototype->init();
//-----------------
$canvas1 = clone $prototype;
$canvas1->rect(3, 6, 4, 12);
$canvas1->draw();
echo '<br />';
$canvas2 = clone $prototype;
$canvas2->rect(1, 3, 2, 6);
$canvas2->draw();
echo '<hr />';

/*装饰器模式（Decorator）：相当于laravel中的 中间件（https://learnku.com/docs/laravel/7.x/middleware/7459）、模型中的事件（https://learnku.com/docs/laravel/7.x/eloquent/7499#events）
		可以动态的添加修改类的功能
		一个类提供了一项功能，如果要在修改并添加额外的功能，传统的编程模式，需要写一个子类继承它，并重新实现类的方法
		使用装饰器模式，仅需在运行时添加一个装饰器对象即可实现，可以实现最大的灵活性*/
$canvas1 = new \Tool\Canvas();
$canvas1->init();
$canvas1->addDecorator(new \Tool\Decorator\ColorDrawDecorator('blue'));
$canvas1->addDecorator(new \Tool\Decorator\SizeDrawDecorator(30));
$canvas1->rect(3, 6, 4, 12);
$canvas1->draw();
echo '<hr />';

/*迭代器模式
		在不需要了解内部实现的前提下，遍历一个聚合对象的内部元素
		相比于传统的编程模式，迭代器模式可以隐藏遍历元素的所需的操作*/
$users = new \Tool\AllUser();
foreach ($users as $item) {
    var_dump($item->name);
}
echo '<hr />';

/*代理模式
		在客户端与实体之间建立一个代理对象（proxy），客户端对实体进行操作全部委派给代理对象，隐藏实体的具体实现细节
		Proxy还可以与业务代码分离，部署到另外的服务器。业务代码中通
        例如、mysql的主从结构，读写分离。读请求从库，写请求主库*/
$proxy = new \Tool\Proxy();
$id = 1;
$name = '张三';
var_dump($proxy->getUserName($id));
echo '<br />';
var_dump($proxy->setUserName($id, $name));
echo '<hr />';

