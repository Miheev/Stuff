<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
//	public function authenticate()
//	{
//		$users=array(
//			// username => password
//			'demo'=>'demo',
//			'admin'=>'admin',
//		);
//		if(!isset($users[$this->username]))
//			$this->errorCode=self::ERROR_USERNAME_INVALID;
//		elseif($users[$this->username]!==$this->password)
//			$this->errorCode=self::ERROR_PASSWORD_INVALID;
//		else
//			$this->errorCode=self::ERROR_NONE;
//		return !$this->errorCode;
//	}



    private $_id;

    /**
     * Authenticates a user using the User data model.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $user=Users::model()->findByAttributes(array('login'=>$this->username));
        if($user===null)
        {
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }
        else
        {
            if($user->getPass()!==$user->encrypt($this->password))
            {
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            }
            else
            {
                $this->_id = $user->id;
                Yii::app()->session['user']= array(
                    'login' => $user->login,
                    'name' => $user->name,
                    'id' => $user->id,
                    'head_id' => $user->head_id,
                    'tariff_id' => $user->tariff_id,
                );
                $this->errorCode=self::ERROR_NONE;
            }
        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }
}