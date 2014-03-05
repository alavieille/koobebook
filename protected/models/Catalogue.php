<?php

/**
 * This is the model class for table "catalogue".
 *
 * The followings are the available columns in table 'catalogue':
 * @property integer $id
 * @property integer $userId
 * @property string $name
 * @property string $firstName
 * @property string $description
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Catalogue extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'catalogue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'unique'),
			array('userId', 'unique',   'message'=>'Vous avez déjà crée un catalogue'),
			array('userId', 'numerical', 'integerOnly'=>true),

			array('name', 'length', 'max'=>50),
			array('description  date_create', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, userId, name, description', 'safe', 'on'=>'search'),
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
			'books' => array(self::HAS_MANY, 'Book', 'catalogueId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'userId' => 'User',
			'name' => 'Nom du catalogue (Editeur)',
			'description' => 'Description',

		);
	}

	/**
	* Select a random Catalogue where have pusblih book
	* @return Return an Array of Catalogue
	*/
	public function findRandom()
	{
		/*$res = $this->with(array('books'=>array('joinType'=>'INNER JOIN',)))->find(array(
			'select' => "*",
			'join' => 'JOIN (SELECT CEIL(RAND() * (SELECT MAX(id) FROM catalogue)) AS id ) AS r2',
			'condition' => 't.description IS NOT NULL and t.id >=r2.id',
			'order' => 't.id ASC',
		));	*/

		$res = $this->with(array('books'=>array('joinType'=>'INNER JOIN',)))->find(array(
			'select' => "*",
			'condition' => 't.description IS NOT NULL',
			'order' => 'rand()',
			'limit' => '1'
		));
		return $res;
	
	}

	/**
	* Select two random Catalogue which was published there was less than one month
	* @param $ignoreId 
	* @return an Array of Catalogue
	*/
	public function findRandomNew($ignoreId = null){
			
		/*$res = Catalogue::model()->findAll(array(
			'select' => "*",
			'alias' => 'r1',
			'join' => 'JOIN (SELECT CEIL(RAND() * (SELECT MAX(id) FROM catalogue)) AS id ) AS r2',
			'condition' => ' DATEDIFF(NOW(),r1.date_create) < 30 and r1.id >=r2.id',
			'order' => 'rand()',
			'limit' => '2'
		));*/

		$conditionIgnoreId = "";
		if($ignoreId != null) {
			//$conditionIgnoreId = " AND t.id != ".$ignoreId;
		}

		$res = Catalogue::model()->with(array('books'=>array('joinType'=>'INNER JOIN')))->findAll(array(
			'select' => "*",
			//'alias' => 'r1',
			//'join' => 'JOIN (SELECT CEIL(RAND() * (SELECT MAX(id) FROM catalogue)) AS id ) AS r2',
			'condition' => ' DATEDIFF(NOW(),t.date_create) < 30'.$conditionIgnoreId,
			'order' => 'rand()',
			'together' => true,
			'limit' => '2',
		));

		$newCata  = array();
		foreach ($res as $catalogue) {
			$arrayCata = array();
			$arrayCata["catalogue"] = $catalogue;
			if(count($catalogue->books(array('condition'=>'push=1'))) > 0) {
				$arrayCata["books"] = $catalogue->books(array('condition'=>'push=1'));
			}
			else {
				$arrayCata["books"] = $catalogue->books(array('condition'=>'push=0','limit'=>5));
			}
			$newCata[] = $arrayCata;
		}

		return $newCata;

	}

	/**
	* Return an Excerpt of catalogue Description
	* @param Integer $len length of excerpt
	* @return String
	*/
	public function getExcerptDescription($len)
	{
  		$text = $this->description;
        if (strlen($text) > $len) { 
          $text = substr($text, 0, $len); 
          $text = substr($text,0,strrpos($text," ")); 
          $etc = " ...";  
          $text = $text.$etc; 
          }
        return $text; 
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('userId',$this->userId);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Catalogue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
