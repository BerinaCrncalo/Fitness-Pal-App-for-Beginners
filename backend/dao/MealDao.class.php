<?php
require_once "BaseDao.class.php";
class MealDao extends BaseDao{
    public function __construct(){
        parent::__construct("meals");
    }

    public function get_all(){
        return parent::get_all();
    }
}

?>