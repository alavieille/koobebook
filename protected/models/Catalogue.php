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
			array('description','length','min'=>200,'allowEmpty'=>true),
			array('date_create', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('name', 'safe', 'on'=>'search'),
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

		$criteria = new CDbCriteria();
		$criteria->with = array('books'=>array('joinType'=>'INNER JOIN'));
		$criteria->addCondition('t.description IS NOT NULL AND t.description != ""');
		$criteria->order = 'rand()';
		$criteria->together = true;
		$res = Catalogue::model()->find($criteria);

		return $res;
	
	}

	/**
	* Select two random Catalogue which was published there was less than one month
	* @param Catalogue $ignoreCatalogue
	* @return an Array of Catalogue
	*/
	public function findRandomNew($ignoreCAtalogue = null)
	{		

		$conditionIgnoreId = "";
		if($ignoreCAtalogue != null) {
			$conditionIgnoreId = " AND t.id != ".$ignoreCAtalogue->id;
		}

		$criteria = new CDbCriteria();
		$criteria->with = array('books'=>array('joinType'=>'INNER JOIN'));
		$criteria->addCondition("DATEDIFF(NOW(),t.date_create) < 30".$conditionIgnoreId);
		$criteria->order = 'rand()';
		$criteria->limit = '2';
		$criteria->together = true;
		$res = Catalogue::model()->findAll($criteria);

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
	* Select all Catalogue which was published there was less than one month
	* @param $ignoreId 
	* @return an Array of Catalogue
	*/
	public function findAllNew()
	{				
		$criteria = new CDbCriteria();
		$criteria->with = array('books'=>array('joinType'=>'INNER JOIN'));
		$criteria->addCondition("DATEDIFF(NOW(),t.date_create) < 30");
		$criteria->order = 't.date_create desc';
		$criteria->together = true;
		$res = Catalogue::model()->findAll($criteria);

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


		$criteria->compare('name',$this->name,true);


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
