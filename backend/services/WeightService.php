<?php
require_once 'BaseService.php';
require_once __DIR__."/../dao/WeightDao.class.php";
class WeightService extends BaseService{
    public function __construct(){
        parent::__construct(new WeightDao());
    }

    public function add($entity){
        return parent::add($entity);
    }
    
}
?>