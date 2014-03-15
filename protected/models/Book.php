<?php

/**
 * This is the model class for table "book".
 *
 * The followings are the available columns in table 'book':
 * @property integer $id
 * @property integer $catalogueId
 * @property string $title
 * @property string $price
 * @property string $author
 * @property string $picture
 * @property string $description
 * @property string $editor
 * @property string $publication
 * @property integer $isbn
 * @property string $epub
 * @property string $mobi
 * @property string $pdf
 *
 * The followings are the available model relations:
 * @property Catalogue $catalogue
 */

class Book extends CActiveRecord
{

	public $pictureFile;
	public $bookFile1;
	public $bookFile2;
	public $bookFile3;

	/*
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'book';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, price, author, publication, description', 'required'),
			array('isbn', 'numerical', 'integerOnly'=>true),
			array('title, author, subtitle', 'length', 'max'=>250),

			array('price', 'length', 'max'=>10),
			array('pictureFile', 'file', 'types'=>'jpg, gif, png',"allowEmpty"=>true),

			//array('epubFile', 'file', 'types'=>'epub','on'=>'insert'),
			array('bookFile1', 'file', 'types'=>'epub, mobi, pdf',"allowEmpty"=>true) ,
			array('bookFile2', 'file', 'types'=>'epub, mobi, pdf',"allowEmpty"=>true) ,
			array('bookFile3', 'file', 'types'=>'epub,mobi,pdf',"allowEmpty"=>true) ,

			array('description date_create, language', 'safe'),
			array('publication', 'date', 'format'=>'yyyy-MM-dd','message'=>"Format de date invalide (aaaa-MM-jj)"),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, catalogueId, title, price, author, picture, description, publication, isbn', 'safe', 'on'=>'search'),
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
			'catalogue' => array(self::BELONGS_TO, 'Catalogue', 'catalogueId'),
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'catalogueId' => 'Catalogue',
			'subtitle' => 'Sous-titre',
			'title' => 'Titre',
			'price' => 'Prix (en €)',
			'author' => 'Auteur',
			'pictureFile' => 'Couverture',
			'description' => 'Description',
			'editor' => 'Editeur',
			'language' => 'Langue',
			'publication' => 'Date de publication',
			'isbn' => 'ISBN',
			'bookFile1' => 'Fichier (epub, mobi, pdf)',
		);
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
		$criteria->compare('catalogueId',$this->catalogueId);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('editor',$this->editor,true);
		$criteria->compare('publication',$this->publication,true);
		$criteria->compare('isbn',$this->isbn);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	* Check if is different format 
	* @return boolean
	*/
	protected function afterValidate()
	{
		

		if($this->epub == null && $this->mobi == null && $this->pdf == null ) {
				$this->addError("bookFile1","Vous devez ajouter au moins un format de ebook");
			return false;
		}

		for ($i=1; $i <=3 ; $i++) { 
			$param = 'bookFile'.$i;
			$file = $this->$param;
			if($file != null) {
				$type = $file->getType();
				for ($y=1; $y <=3 ; $y++) {
						$param = 'bookFile'.$y;
						$file = $this->$param;
					if($file != null) {
						if( $i != $y  && $file->getType() == $type){
							$this->addError("bookFile1","Vous ne pouvez envoyer seulement un seul fichier par format");
							return false;
						}
					}
				}
			}
		}
		return true;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Book the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}



}
