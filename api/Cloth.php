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
    //ответ сервера при загрузке страницы
    public $status ;
    //наименование сайта
    public $host ;
    //путь корня папки в которой лежит наш сайт
    public $documentRoot ;
    //создание модульности cms simpla
    public $modulesDir = '/modules/';
    //папка где находяться классы для разработки
    public $controllerDir = '/controller/';
    //окончание в названии класса
    private $end = '.php';
    /**
     *
     */
    public function __construct()
    {
         $this->getRoot();
    }
    /**
     * Магический метод, создает нужный объект API
     * возмём чтоб не писать своё :)
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
        // Подключаем класс из модуля
        include_once($this->documentRoot.$this->modulesDir.$this->name.$this->controllerDir.$class.$this->end);
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
    //TODO : доделать чтоб подымало везде
        return (string)$this->host = $_SERVER['HTTP_HOST'];
    }

    /**
     * @return string
     */
    public function getRoot(){
        //TODO : доделать чтоб подымало везде
        return (string)$this->documentRoot = $_SERVER['DOCUMENT_ROOT'];
    }
}