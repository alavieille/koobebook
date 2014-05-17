<?php

/**
 * This is the model class for table "payment".
 *
 * The followings are the available columns in table 'payment':
 * @property integer $userId
 * @property integer $bookId
 * @property string $date
 * @property string $numFact
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Book $book
 */
class Payment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('userId, bookId, date, numFact', 'required'),
			array('userId, bookId', 'numerical', 'integerOnly'=>true),
			array('numFact', 'length', 'max'=>25),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'userId'),
			'book' => array(self::BELONGS_TO, 'Book', 'bookId'),
		);
	}

	
	public function primaryKey()
	{
	   return array('userId', 'bookId');
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Payment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
