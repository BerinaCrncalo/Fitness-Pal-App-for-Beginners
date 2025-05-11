<?php
require_once "BaseDao.class.php";
class WorkoutDao extends BaseDao{
    public function __construct(){
        parent::__construct("workouts");
    }

    public function get_all(){
        return parent::get_all();
    }
}

?>