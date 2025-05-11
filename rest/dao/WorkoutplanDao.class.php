<?php
require_once "BaseDao.class.php";
class WorkoutplanDao extends BaseDao{
    public function __construct(){
        parent::__construct("workoutplan");
    }

    public function get_all(){
        return parent::get_all();
    }
}

?>