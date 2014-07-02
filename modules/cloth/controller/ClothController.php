<?php
/**
 * Created by PhpStorm.
 * User: nicktaporuk
 * Date: 02.07.14
 * Time: 19:54
 */

class ClothController extends Simpla
{
    /**
     *
     */
    public  function test()
    {
        $this->db->query("SELECT * FROM __cloth");

        return $this->db->results();
    }
} 