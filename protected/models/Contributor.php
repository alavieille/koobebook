<?php

/**
 * This is the model class for table "contributor".
 *
 * The followings are the available columns in table 'contributor':
 * @property integer $id
 * @property integer $bookId
 * @property string $type
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Book $book
 */
class Contributor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contributor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, name', 'required'),
			array('type', 'length', 'max'=>50),
			array('name', 'length', 'max'=>250),
			array('bookId', 'safe'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
		
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
			'book' => array(self::BELONGS_TO, 'Book', 'bookId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'bookId' => 'Book',
			'type' => 'Type',
			'name' => 'Name',
		);
	}


	public function translateType()
	{
		switch ($this->type) {
			case 'illustrator':
				return 'Illustrateur';
				break;
			case 'traductor':
				return 'Traducteur';
				break;
			case 'author':
				return 'Auteur';
				break;
			
			default:
				return 'Inconnue';
				break;
		}
	}
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


		$criteria = new CDbCriteria();
		$criteria->select = 'bookId';
 		$criteria->distinct=true;
 		$criteria->compare('type',$this->type,true);
		$criteria->compare('name',$this->name,true);
 		$res = $this->findAll($criteria);
 		foreach ($res as $key => $contributor) {
 			$contributor->type = $this->type;
			if (! isset($contributor->book->catalogue)) {
					unset($res[$key]);
				}
		}
		return $res;
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contributor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
