<?php
require_once 'BaseService.php';
require_once __DIR__."/../dao/WorkoutplanDao.class.php";
class WorkoutplanService extends BaseService{
    public function __construct(){
        parent::__construct(new WorkoutplanDao());
    }

    public function add($entity){
        return parent::add($entity);
    }
    
}
?>