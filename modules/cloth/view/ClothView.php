<?php
/**
 * Created by PhpStorm.
 * User: nicktaporuk
 * Date: 02.07.14
 * Time: 19:52
 */

/*namespace modules\cloth\view;*/
/*
 * Класс для работы с обработкой контента
 * */

class ClothView extends Simpla
{
    //
    public  $template = '';
    //
    public $pathHit = '/modules/cloth/img/textile-hit.png';
    //
    public $pathImg = '/modules/cloth/img/';
    public $pathCloth = '/modules/cloth/img/cloth/';

    /**
     * @param array $model
     * @return string
     */

    public function decoratorPopup($model=array())
    {
        foreach($model['getAllCompany'] as $company){
            if($company->id)
            {
                $model['getMP'][] = $this->cloth->m->getMP($company->id);
            }
            else continue;
        }
        //        var_dump($model['getAllTypeMaterial']);
        if(isset($model['getAllTypeMaterial']) and !empty($model['getAllTypeMaterial']))
        {
            $typeMaterial = '';
            foreach($model['getAllTypeMaterial'] as $material){
                $typeMaterial.='<span class="textile-type-wrapper" idm="'.$material->id.'"><a href="#"  class="textile-type" >'.$material->name.'</a><span class="help-tips" title="'.$material->description.'"></span></span>';
            }
        }
//        var_dump($model['getAllPriceBind']);
        if(isset($model['getAllPriceBind']) and !empty($model['getAllPriceBind']))
        {
            $AllPriceBind = '';
            foreach($model['getAllPriceBind'] as $price){
                $active ='';
                if($price->id==1){
                    $active = ' active';
                }
                $AllPriceBind.='<a id="textile-group-inner-1" idp="'.$price->id.'" class="textile-group '.$active.'" href="#"><div class="group-name">'.$price->id.'</div><div class="group-price">'.$price->price_from.'</div></a>';
            }
        }
//        var_dump($model['getMP']);
        if(isset($model['getMP']) and !empty($model['getMP']))
        {
            $getMP = '';
            foreach($model['getMP'] as $tkm){
                if(!empty($tkm))
                {
                $getLoopMP = '';
                $getMP.='<div class="textile-category">
                <div class="textile-category-title">'.$tkm[0]->company_name.' ('.$tkm[0]->material_name.'<span title="" class="help-tips" bt-xtitle=""></span>)</div>';

                    for($i=0,$count = count($tkm);$i<$count;$i++){

                        $getLoopMP .= '<a href="#" class="textile-preview" tkm="'.$tkm[$i]->id.'" >
                                    <div class="textile">
                                        <div class="textile-pic">
                                            <img src="'.$this->pathCloth.$tkm[$i]->img_name.'" alt="'.$tkm[$i]->name.'" title="'.$tkm[$i]->name.'" class="" width="50" height="50">
                                    </div>
                                        <div class="popular_textile"></div>
                                    </div>
                                </a> ';
                    }
                    $getLoopMP .='</div>
                           <div style="clear:left;"></div>';
                    $getMP .=$getLoopMP;
                }
                else continue ;

            }
        }

        $this->template = '
        <div class="popup" >

            <div class="close-block" href="#">ЗАКРЫТЬ</div>
            <div class="textile-list-title">Выбор основной ткани</div>
            <div class="disclamor">Внимание! Отображение тонов изображения может отличаться в зависимости от цветопередачи вашего монитора!</div>
            <!-- Button that triggers the popup -->
            <div id= "textile-list ">
                <div id="textile-pic-preview">';

        $this->template.='</div>
            </div>
                <!--контур видов ткани -->
                <div id= "textile-type-switcher"  >
                <span class="textile-type-wrapper" idm="0"><a href="#"  class="textile-type active" >Все типы</a><span class="help-tips" title="Все типы"></span></span>';
        $this->template .= $typeMaterial.
                '</div>
                <!--контур цен на ткани -->
                <div id="textile-group-inner-switcher">
                    <div id="textile-group-inner-switcher-help">Цена изделия расчитывается по большей группе тканей.</div>';

        $this->template .= $AllPriceBind.
                     '<div style= " clear:both;"></div>
                </div>
                <!--контур ткани по видам -->
                <div id="textile-list-content" >';

        $this->template.=$getMP.
                '<div style="clear:both;"></div>
            </div>
            <div class="select-textile-button">
                <div class="help-text">чтобы заказать модель в данной ткане нажмите</div>
                <a id="select-textile-block" >выбрать основную ткань</a>
            </div>
        </div>';

        return $this->template ;
    }

    /**
     * @param $template
     * @param $data
     * @param $html
     * @return mixed
     */
    public function strReplaceTemplate($template,$data,$html)
    {
        return str_replace($template,$data,$html);
    }
    /**
     *
     */
    public function ajaxHtmlData($data)
    {
        //выбрать все компании
        $model['getAllCompany']         = $this->cloth->m->getAllCompany();
//        var_dump($data);exit;
        foreach($model['getAllCompany'] as $company){
            if($company->id)
            {
                $model['getMP'][] = $this->cloth->m->getMP($company->id,$data->idm,$data->idp);
            }
            else continue;
        }
        //забрать данные по компаниям

        //        var_dump($model['getMP']);
        if(isset($model['getMP']) and !empty($model['getMP']))
        {
            $getMP = '';
            foreach($model['getMP'] as $tkm){
                if(!empty($tkm))
                {
                    $getLoopMP = '';
                    $getMP.='<div class="textile-category">
                <div class="textile-category-title">'.$tkm[0]->company_name.' ('.$tkm[0]->material_name.'<span title="" class="help-tips" bt-xtitle=""></span>)</div>';

                    for($i=0,$count = count($tkm);$i<$count;$i++){

                        $getLoopMP .= '<a href="#" class="textile-preview" tkm="'.$tkm[$i]->id.'" >
                                    <div class="textile">
                                        <div class="textile-pic">
                                            <img src="'.$this->pathCloth.$tkm[$i]->img_name.'" alt="'.$tkm[$i]->name.'" title="'.$tkm[$i]->name.'" class="" width="50" height="50">
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
        //выбрать все компании
            $model['getAllCompany']         = $this->cloth->m->getAllCompany();
//        var_dump($data);exit;
        foreach($model['getAllCompany'] as $company){
            if($company->id)
            {
                $model['getMP'][] = $this->cloth->m->getMP($company->id,$data->idm,$data->idp);
            }
            else continue;
        }

        //забрать данные по компаниям

        //        var_dump($model['getMP']);
        if(isset($model['getMP']) and !empty($model['getMP']))
        {
            $getMP = '';
            foreach($model['getMP'] as $tkm){
                if(!empty($tkm))
                {
                    $getLoopMP = '';
                    $getMP.='<div class="textile-category">
                <div class="textile-category-title">'.$tkm[0]->company_name.' ('.$tkm[0]->material_name.'<span title="" class="help-tips" bt-xtitle=""></span>)</div>';

                    for($i=0,$count = count($tkm);$i<$count;$i++){

                        $getLoopMP .= '<a href="#" class="textile-preview" tkm="'.$tkm[$i]->id.'" >
                                    <div class="textile">
                                        <div class="textile-pic">
                                            <img src="'.$this->pathCloth.$tkm[$i]->img_name.'" alt="'.$tkm[$i]->name.'" title="'.$tkm[$i]->name.'" class="" width="50" height="50">
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

        return $getMP;
    }
}