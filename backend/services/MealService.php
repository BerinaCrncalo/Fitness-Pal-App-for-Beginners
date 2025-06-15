<?php
require_once 'BaseService.php';
require_once __DIR__."/../dao/MealDao.class.php";
class MealService extends BaseService{
    public function __construct(){
        parent::__construct(new MealDao());
    }

    public function add($entity){
        return parent::add($entity);
    }
    
}
?>