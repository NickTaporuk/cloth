;<? exit(); ?>

license = "cdgfedddlh lfgnkgpjom utpusxvqz6 a5deaef9ge ffgkjmhgjl mnristmk wsx8q43774 7f9bf9ehgd emmngkonik nnptqtoxts u54dbaa8bd df8dcgadkl gpnigjjspk nwvwr2sbp4 a93adfcfaf chjkemcjgi isoqpnmmtt r4q5tcu935 6h8jdfddag kplngpgllp lrnwsyt6v5 ucwc6a7cbg 6cfkaicigi gnipoqpnnq n5o5o7raq4 ah4b6dcddc anfhcpfqjs mvju "

[database]

;Сервер базы данных
db_server = "localhost"

;Пользователь базы данных
db_user = "root"

;Пароль к базе
db_password = "root"

;Имя базы
db_name = "simpla"

;Префикс для таблиц
db_prefix = s_;

;Кодировка базы данных
db_charset = UTF8;

;Режим SQL
db_sql_mode =;

;Смещение часового пояса
;db_timezone = +04:00;


[php]
error_reporting = E_ALL;
php_charset = UTF8;
php_locale_collate = ru_RU;
php_locale_ctype = ru_RU;
php_locale_monetary = ru_RU;
php_locale_numeric = ru_RU;
php_locale_time = ru_RU;
;php_timezone = Europe/Moscow;

logfile = admin/log/log.txt;

[smarty]

smarty_compile_check = true;
smarty_caching = false;
smarty_cache_lifetime = 0;
smarty_debugging = false;
smarty_html_minify = false;
 
[images]
;Использовать imagemagick для обработки изображений (вместо gd)
use_imagick = true;

;Директория оригиналов изображений
original_images_dir = files/originals/;

;Директория миниатюр
resized_images_dir = files/products/;

;Изображения категорий
categories_images_dir = files/categories/;

;Изображения брендов
brands_images_dir = files/brands/;

;Файл изображения с водяным знаком
watermark_file = simpla/files/watermark/watermark.png;

[files]

;Директория хранения цифровых товаров
downloads_dir = files/downloads/;