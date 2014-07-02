<?php
/**
 * Created by PhpStorm.
 * User: nicktaporuk
 * Date: 01.07.14
 * Time: 18:09
 * mail: nictaporuk@yandex.ru
 */
require_once('Simpla.php');
class Cloth extends Simpla
{
    //название модуля
    private $name = 'cloth';
    //номер версии модуля
    private $version = '1.0.0';
    // Свойства - Классы API
    private $classes = array(
        'test'      => 'TestController',
    );

    // Созданные объекты
    private static $objects = array();

//    public $test;
    public $status ;
    public $host ;
    public $documentRoot ;
    public static $instance;

    /**
     *
     */
    public function __construct()
    {
         $this->getRoot();
    }
    /**
     * Магический метод, создает нужный объект API
     */
    public function __get($name)
    {
//        echo $name;
//        exit;
        // Если такой объект уже существует, возвращаем его
        if(isset(self::$objects[$name]))
        {
            return(self::$objects[$name]);
        }

        // Если запрошенного API не существует - ошибка
        if(!array_key_exists($name, $this->classes))
        {
            return null;
        }

        // Определяем имя нужного класса
        $class = $this->classes[$name];
        // Подключаем его
        include_once($this->documentRoot.'/modules/'.$this->name.'/controller/'.$class.'.php');
        // Сохраняем для будущих обращений к нему
        self::$objects[$name] = new $class();

        // Возвращаем созданный объект
        return self::$objects[$name];
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return (string)$this->host = $_SERVER['HTTP_HOST'];
    }
    /**
     *
     */
    public function getRoot(){
        return (string)$this->documentRoot = $_SERVER['DOCUMENT_ROOT'];
    }
}