<?php
/**
 * Created by PhpStorm.
 * User: storm
 * Date: 8/19/14
 * Time: 3:35 AM
 */

class WebUser extends CWebUser {
    private $_model = null;

    public function getRole() {
        if($user = $this->getModel()){
            // в таблице User есть поле role
            return $user->role;
        }
    }
    public function getFname() {
        if($user = $this->getModel()){
            // в таблице User есть поле role
            return $user->name;
        }
    }

    public function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = Users::model()->findByPk($this->id);
        }
        return $this->_model;
    }
}