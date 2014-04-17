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
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('userId, bookId', 'safe', 'on'=>'search'),
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
	    // Pour les clés primaires composites, retourne un tableau, par exemple:
	    // return array('pk1', 'pk2');
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
	*SELECT count(bookId), bookId FROM `library` GROUP by bookId ORDER BY count(bookId) DESC LIMIT 20 
	**/


	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('userId',$this->userId);
		$criteria->compare('bookId',$this->bookId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
