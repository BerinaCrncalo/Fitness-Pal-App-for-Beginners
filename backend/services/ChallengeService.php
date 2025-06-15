<?php
require_once 'BaseService.php';
require_once __DIR__."/../dao/ChallengeDao.class.php";
class ChallengeService extends BaseService{
    public function __construct(){
        parent::__construct(new ChallengeDao());
    }

    public function add($entity){
        return parent::add($entity);
    }
    
}
?>