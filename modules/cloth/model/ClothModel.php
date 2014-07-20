<?php
/**
 * Created by PhpStorm.
 * User: nicktaporuk
 * Date: 02.07.14
 * Time: 19:50
 */

//namespace modules\cloth\model;
/*
 * Класс для работы с базой данных(название базы)
 * */

class ClothModel extends Simpla
{
    /**
     *тип материала
     */
    public function getAllTypeMaterial($id=false,$price=false)
    {
        $sql = "SELECT * FROM __type_material";
        if($id){
            if(is_array($id)){
                $id = implode(',',$id);
                $sql.=" WHERE id IN($id)";
            }
            else {
                $sql.=" WHERE id = $id";
            }
        }
        $this->db->query($sql);
        return $this->db->results();
    }
    /**
     *ценовая группа
     */
    public function getAllPriceBind($id = false)
    {
        $sql = "SELECT * FROM __price_band";
        if($id){
            if(is_array($id)){
                $id = implode(',',$id);
                $sql.=" WHERE id IN($id)";
            }
            else {
                $sql.=" WHERE id = $id";
            }
        }
        $this->db->query($sql);
        return $this->db->results();
    }
    /**
     *ткань
     */
    public function getAllCloth($id=false)
    {
        $sql = "SELECT * FROM __cloth";
        if($id){
            if(is_array($id)){
                $id = implode(',',$id);
                $sql.=" WHERE id IN($id)";
            }
            else {
                $sql.=" WHERE id = $id";
            }
        }
        $this->db->query($sql);
        return $this->db->results();
    }
    /**
     *компания
     */
    public function getAllCompany($id=false)
    {
        $sql = "SELECT * FROM __name_company";
        if($id){
            if(is_array($id)){
               $id = implode(',',$id);
                $sql.=" WHERE id IN($id)";
            }
        else {
            $sql.=" WHERE id = $id";
            }
        }
        $this->db->query($sql);
        return $this->db->results();
    }
    /**
     *ткань,компания,тип материала
     */
    public function getAllTKM()
    {
        $this->db->query("SELECT c.id,c.name,c.img_name,c.hit,nc.name AS company_name,tm.name AS material_name FROM __cloth c LEFT JOIN __name_company nc ON c.name_company = nc.id LEFT JOIN __type_material tm ON c.type_material = tm.id");
        return $this->db->results();
    }
    /**
     * M - материал
     * P - цена
     * C - компания
     */
    public function getMP($c=1,$m = 1,$p=1)
    {
        //
        $corectMaterial='';

        if(is_array($c)){
            $c = implode(',',$c);
        }
        if($m>0){
            $corectMaterial = "c.type_material = $m AND";
        }
        $sql = "SELECT c.id,c.name,c.img_name,c.hit,nc.name AS company_name,tm.name AS material_name FROM __cloth c LEFT JOIN __name_company nc ON c.name_company = nc.id LEFT JOIN __type_material tm ON c.type_material = tm.id
                WHERE $corectMaterial  c.price_band = $p AND c.name_company IN($c)  ORDER BY company_name";
        $this->db->query($sql);
        return $this->db->results();

    }
    /**
     *
     */
    public function insertOrdersCloth($order,$jsonString,$product_id){
//        var_dump($order.",".$jsonString.",".$product_id);
        $sql = "INSERT INTO s_order_cloth(order_id,cloth_order,product_id) VALUES($order,'" .$jsonString."',".$product_id.")";
        $this->db->query($sql);
//        return $this->db->results();
    }
    /**
     * для работы ассинхронным запросом тест
     */
    public function ajaxRequest()
    {
        echo 'its work';
    }
} 