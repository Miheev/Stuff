<?php
/**
 * Created by PhpStorm.
 * User: storm /Nataliya Gudziy /B'z
 * Date: 6/19/14
 * Time: 7:12 PM
 */

//require_once('../../config.php');

class crmRole
{
    public $role_perm;
    protected $rol_id;
    public $rol_name;


    public function __construct($rol_id, $rol_name) {
        $this->role_perm = array();
        $this->rol_id = $rol_id;
        $this->rol_name = $rol_name;

        $this->setRole();
    }

    // return a role object with associated rol_name
    public function setRole() {

        $res= $_POST['link']->query("SELECT t2.perm_name FROM role_perm as t1
                JOIN permissions as t2 ON t1.perm_id = t2.perm_id
                WHERE t1.role_id = $this->rol_id");


        foreach($res as $item)
            $this->role_perm[]= $item['perm_name'];
    }
    protected function getRolePerms() {
        return $this->role_perm;
    }

    // check if a permission is set
    public function hasPerm($permission) {
        return array_search($permission, $this->role_perm);
    }

    // insert a new role
    public static function insertRole($role_name) {
        $sql = "INSERT INTO roles (role_name) VALUES ('$role_name')";
        $res = $_POST['link']->query($sql);
        return $res;
    }

// insert array of roles for specified user id
    public static function insertUserRoles($user_id, $roles) {
        $sql = "INSERT INTO user_role (user_id, role_id) VALUES ('$user_id', '$roles')";
        $res = $_POST['link']->query($sql);
        return $res;
    }

// delete ALL roles for specified user id
    public static function deleteUserRoles($user_id) {
        $sql = "DELETE FROM user_role WHERE user_id = $user_id";
        $res = $_POST['link']->query($sql);
        return $res;
    }
}

class crmUser
{
    private $roles;
    public $id;
    public $name;
    public $login;
    protected  $pass;
    public $email;
    public $phone;

    public function __construct($login) {

        $this->id= 0;
        $this->name= '';
        $this->login= '';
        $this->pass= '';
        $this->email= '';
        $this->phone= '';
        $this->roles = '';

        $this->getByLogin($login);
    }

    public function getPass() {return hash('sha256', $this->pass . AUTH_KEY);}

    // override User method
    public function getByLogin($login) {
        $res= $_POST['link']->query("SELECT * FROM users WHERE user_login = '$login'");

        if (isset($res) && !empty($res)) {
            $this->id = $res[0]["user_id"];
            $this->login = $login;
            $this->name = $res[0]["user_name"];
            $this->phone = $res[0]["user_phone"];
            $this->pass = $res[0]["user_pass"];
            $this->email = $res[0]["user_email"];

            $this->initRoles($this->id);
        } else {
            return false;
        }
    }
    // populate roles with their associated rol_name
    protected function initRoles($user_id) {
        $res= $_POST['link']->query("SELECT t1.role_id, t2.role_name FROM user_role as t1
                JOIN roles as t2 ON t1.role_id = t2.role_id
                WHERE t1.user_id = $user_id");

        $this->roles= new crmRole($res[0]['role_id'], $res[0]['role_name']);

//        while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
//            $this->roles[$row["role_name"]] = Role::getRolePerms($row["role_id"]);
//        }
    }

    // check if user has a specific privilege
    public function hasPerm($perm) {
            return $this->roles->hasPerm($perm);
    }

// insert a new role permission association
    public static function insertPerm($role_id, $perm_id) {
        $sql = "INSERT INTO role_perm (role_id, perm_id) VALUES ($role_id, $perm_id)";
        $res = $_POST['link']->query($sql);
        return $res;
    }

// delete ALL role rol_name
    public static function deletePerms() {
        $sql = "TRUNCATE role_perm";
        $res = $_POST['link']->query($sql);
        return $res;
    }
}