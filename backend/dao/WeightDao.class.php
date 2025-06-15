<?php
require_once "BaseDao.class.php";
class WeightDao extends BaseDao{
    public function __construct(){
        parent::__construct("weight");
    }

    public function get_all(){
        return parent::get_all();
    }
}

?>