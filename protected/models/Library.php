<?php

/**
 * This is the model class for table "library".
 *
 * The followings are the available columns in table 'library':
 * @property integer $userId
 * @property integer $bookId
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Book $book
 */
class Library extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'library';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, bookId', 'required'),
			array('userId, bookId', 'numerical', 'integerOnly'=>true),
			array('date_download', 'safe'),
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
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userId' => 'User',
			'bookId' => 'Book',
		);
	}

	public function findTopDownload($limit=10)
	{
		$connection=Yii::app()->db;
		$sql = "SELECT count(bookId), bookId FROM library ";
		$sql .= "GROUP by bookId ORDER BY count(bookId) DESC LIMIT ".$limit;
		$command=$connection->createCommand($sql);
		$dataReader=$command->query();
		$rows=$dataReader->readAll();

		return $rows;

	}



	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Library the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
