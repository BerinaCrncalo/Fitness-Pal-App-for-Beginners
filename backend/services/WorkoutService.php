<?php
require_once 'BaseService.php';
require_once __DIR__."/../dao/WorkoutDao.class.php";
class WorkoutService extends BaseService{
    public function __construct(){
        parent::__construct(new WorkoutDao());
    }

    public function add($entity){
        return parent::add($entity);
    }
    
}
?>