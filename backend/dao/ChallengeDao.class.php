<?php
require_once "BaseDao.class.php";
class ChallengeDao extends BaseDao{
    public function __construct(){
        parent::__construct("challenges");
    }

    public function get_all(){
        return parent::get_all();
    }
}

?>