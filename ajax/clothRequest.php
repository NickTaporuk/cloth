<?php
///*/**
// * Created by PhpStorm.
// * User: nicktaporuk
// * Date: 05.07.14
// * Time: 21:01
// */
//header("Cache-Control: must-revalidate");
//header("Pragma: no-cache");
//header("Expires: -1");
//require_once('../api/Simpla.php');
//require_once('../api/Cloth.php');
//$simpla = new Simpla();
//
//print('<pre>');
//var_dump($simpla->config);
//print('</pre>');
//$cloth = new Cloth();
////$cloth->m->ajaxRequest();
//$model = json_decode($_GET['d']);
////print_r($model);exit;
////var_dump($cloth->v->decoratorPopup());
//echo  $cloth->v->ajaxHtmlData($model);*/
/**
 * Created by PhpStorm.
 * User: nicktaporuk
 * Date: 05.07.14
 * Time: 21:01
 */
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: must-revalidate");
header("Pragma: no-cache");
header("Expires: -1");

// Файл для хранения настроек
$config_file = 'config/config.php';
// Читаем настройки из дефолтного файла
$ini = parse_ini_file(dirname(dirname(__FILE__)).'/'.$config_file);
//
$model = json_decode($_GET['d']);
//var_dump($model);
//
$dns = "mysql:host=".$ini["db_server"].';dbname='.$ini["db_name"];
//echo $dns ;
try {
    $pdo = new PDO($dns, $ini["db_user"], $ini["db_password"]);
}
catch(PDOException $e) {
    echo "Нет соединения с базой данных";
}

$utf8 = 'SET NAMES utf8';
$sql = 'SELECT id FROM s_name_company;';

$pdo->query($utf8);
$query = $pdo->query($sql);
$sq = $query->fetchAll(PDO::FETCH_ASSOC);

$pathCloth = '/modules/cloth/img/cloth/';
//$m = array();
foreach($sq as $company){
//var_dump($company['id']);
    if($company['id'])
    {
        //var_dump(getMP($company['id'],$model->idm,$model->idp,$pdo));
        //echo '<br/>';
        //$m[] = getMP($company['id'],$model['idm'],$model['idp'],$pdo);
        $corectMaterial='';

        if(is_array($company['id'])){
            $c = implode(',',$company['id']);
        }
        if(($model->idm)>0){
            $corectMaterial = "c.type_material = $model->idm AND";
        }
        $sql = "SELECT c.id,c.name,c.img_name,c.hit,nc.name AS company_name,tm.name AS material_name FROM s_cloth c LEFT JOIN s_name_company nc ON c.name_company = nc.id LEFT JOIN 		s_type_material tm ON c.type_material = tm.id  WHERE ".$corectMaterial."  c.price_band = ".$model->idp." AND c.name_company IN(".$company['id'].")  ORDER BY company_name";

        //echo $sql.'<br/>';
        $query = $pdo->query($sql);

        //var_dump($query->fetchAll(PDO::FETCH_CLASS));
        $m[] = $query->fetchAll(PDO::FETCH_CLASS);
    }
    else continue;
}

       if(isset($m) and !empty($m))
       {
           $getMP = '';
           foreach($m as $tkm){
               if(!empty($tkm))
               {
                   $getLoopMP = '';
                   $getMP.='<div class="textile-category">
                <div class="textile-category-title">'.$tkm[0]->company_name.' ('.$tkm[0]->material_name.'<span title="" class="help-tips" bt-xtitle=""></span>)</div>';

                   for($i=0,$count = count($tkm);$i<$count;$i++){

                       $getLoopMP .= '<a href="#" class="textile-preview" tkm="'.$tkm[$i]->id.'" >
                                    <div class="textile">
                                        <div class="textile-pic">
                                            <img src="'.$pathCloth.$tkm[$i]->img_name.'" alt="'.$tkm[$i]->name.'" title="'.$tkm[$i]->name.'" class="" width="50" height="50">
                                    </div>
                                        <div class="popular_textile"></div>
                                    </div>
                                </a>

                                ';
                   }
                   $getLoopMP .='</div>
                           <div style="clear:left;"></div>';
                   $getMP .=$getLoopMP;
               }
               else continue ;

           }
       }
echo $getMP;
