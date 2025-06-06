<?php
require_once "BaseDao.class.php";

class UserDao extends BaseDao{

  /**
  * constructor of dao class
  */
  public function __construct(){
    parent::__construct("admin");
  }

  public function get_user_by_email($email){
    return $this->query("SELECT * FROM admin WHERE email = :email", ['email' => $email]);
  }
}

?>
