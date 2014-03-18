<?php

/**
 * ForgetPassForm class.
 */
class ForgetPassForm extends CFormModel
{
	public $email;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('email', 'required'),
			array('email', 'email'),
			array('email', 'exist', 'attributeName' => 'email', 'className' => 'User' ,'message' => 'Email {value} n\'existe pas'),
			array('email','length','min'=>3,"max"=>32),

		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'email'=>'Email',
		);
	}


	
}
