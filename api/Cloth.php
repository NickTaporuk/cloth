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
        'c'     => 'ClothController',
        'm'     => 'ClothModel',
        'v'     => 'ClothView',
    );
    // Созданные объекты
    private static $objects = array();
    //
    public $status ;
    //
    public $host ;
    //
    public $documentRoot ;
    //
    private  $folderModule      = '/modules/';
    //
    private $folderController   = '/controller/' ;
    //
    private $folderModel        = '/model/' ;
    //
    private $folderView         = '/view/' ;
    //
    private $suffix             = '.php';

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
        include_once($this->documentRoot.$this->folderModule.$this->name.$this->folderController.$class.$this->suffix);
        // Сохраняем для будущих обращений к нему
        self::$objects[$name] = new $class();

        // Возвращаем созданный объект
        return self::$objects[$name];
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return (string)$this->host = $_SERVER['HTTP_HOST'];
    }

    /**
     * @return string
     */
    public function getRoot(){
        return (string)$this->documentRoot = $_SERVER['DOCUMENT_ROOT'];
    }
}