<?php
/**
 * Created by PhpStorm.
 * User: nicktaporuk
 * Date: 01.07.14
 * Time: 20:36
 */

/*namespace modules\controller;*/


class TestController extends Simpla
{
/**
 *
 */
    public  function test()
    {
       $this->db->query('SELECT count(*) as count FROM __blog');
        var_dump($this->db->results());
//        return 'its work';
    }
} 