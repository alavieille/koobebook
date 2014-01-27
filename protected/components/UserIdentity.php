<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

	 // Need to store the user's ID:
	 private $_id;


	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = User::model()->findByAttributes(array('email'=>$this->username));
		
		if ($user===null) { // No user found!
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		} else if (($user->password !== crypt($this->password,$this->username) && ! $this->checkTempPassword($user) ) ) { // Invalid password!
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		} else { // Okay!
		    $this->errorCode=self::ERROR_NONE;
		    // Store the role in a session:
		   // $this->setState('role', $user->role);
			$this->_id = $user->id;
		}
		return !$this->errorCode;
	}
	
	/**
	* Chech tempory password if user forget her password, tempory password is valid during 30 minutes
	* @return boolean
	*/
	private function checkTempPassword($user){
		$timePass = new DateTime($user->date_tmp_password);
		$diff=$timePass->diff(new DateTime(date('Y-m-d G:i:s')));
		return ($diff->y==0 && $diff->m==0 && $diff->d==0 && $diff->h==0 && $diff->i<30 && $user->temp_password==$this->password);
	}

	public function getId()
	{
	 return $this->_id;
	}

	
}