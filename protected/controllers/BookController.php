<?php

class BookController extends Controller
{


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user 
				'actions'=>array('create', 'download'),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array('update','delete','confirmDelete','togglePush'),
				'users'=>array('@'),
				'expression'=> 'Yii::app()->controller->isOwnerRules()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);

		$this->render('view',array(
			'model'=>$model,
			'isOwner'=>$this->isOwner($id)
		));
	}
	
	private function uploadFileBook($model)
	{
		
		for ($i=1; $i <=3 ; $i++) { 
			$param = 'bookFile'.$i;		
			if(! is_null($model->$param)) {
				$extension = $model->$param->extensionName;
				$model->$extension=$extension.'.'.$extension;
			}
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		$this->layout = "//layouts/private";
		$model=new Book;
		//default value
		$model->price = 0;
		$model->date_create = new CDbExpression('NOW()');
		// recherche catalogue lié
		$catalogue = Catalogue::model()->findByAttributes(array('userId'=>yii::app()->user->id));
	

		if(is_null($catalogue)){
			$this->redirect(array('catalogue/create'));
		}

		$model->catalogueId = $catalogue->id;

		if(isset($_POST['Book']))
		{
			$model->attributes=$_POST['Book'];

			//upload couverture & ebook 
			$model->pictureFile  = CUploadedFile::getInstance($model,'pictureFile');
			$model->bookFile1 = CUploadedFile::getInstance($model,'bookFile1');
			$model->bookFile2 = CUploadedFile::getInstance($model,'bookFile2');
			$model->bookFile3 = CUploadedFile::getInstance($model,'bookFile3');

			$this->uploadFileBook($model);
		
			if(! is_null($model->pictureFile )) // si couverture
				$model->picture="cover.".$model->pictureFile->extensionName;


			if($model->save())
			{
				$urlUpload = Yii::app()->basePath.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.yii::app()->params->folder_upload.DIRECTORY_SEPARATOR;

				if(! is_null($model->pictureFile))
					$model->pictureFile->saveAs($urlUpload.$model->id."-cover.".$model->pictureFile->extensionName);			
 				

				for ($i=1; $i <=3 ; $i++) { 
					$param = 'bookFile'.$i;		
					if(! is_null($model->$param)) {
						$extension = $model->$param->extensionName;
						$model->$param->saveAs($urlUpload.$model->id."-".$extension.'.'.$extension);
					}
				}
				$this->redirect(array("catalogue/manage"));
			}
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->layout = "//layouts/private";
		$model=$this->loadModel($id);


		if(isset($_POST['Book']))
		{
			
			$model->attributes=$_POST['Book'];
			//var_dump($model);

			$model->pictureFile  = CUploadedFile::getInstance($model,'pictureFile');

			$model->bookFile1 = CUploadedFile::getInstance($model,'bookFile1');
			$model->bookFile2 = CUploadedFile::getInstance($model,'bookFile2');
			$model->bookFile3 = CUploadedFile::getInstance($model,'bookFile3');
			//$model->epubFile = CUploadedFile::getInstance($model,'epubFile');

			
			if(! is_null($model->pictureFile )){
				$picturePrecSave = $model->picture; // ancienne couverture 
				$model->picture = "cover.".$model->pictureFile->extensionName;
			}
			if($model->validate()) {

				$urlUpload = Yii::app()->basePath.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.yii::app()->params->folder_upload.DIRECTORY_SEPARATOR;
				
				if(isset($_POST['Book']['deleteEpub']) and $_POST['Book']['deleteEpub']== 1) {
					if(file_exists($urlUpload.$model->id."-".$model->epub))
							unlink($urlUpload.$model->id."-".$model->epub);
					$model->epub = null;
				}

				if(isset($_POST['Book']['deleteMobi']) and $_POST['Book']['deleteMobi']== 1) {
					if(file_exists($urlUpload.$model->id."-".$model->mobi))
							unlink($urlUpload.$model->id."-".$model->mobi);
					$model->mobi = null;
				}

				if(isset($_POST['Book']['deletePdf']) and $_POST['Book']['deletePdf']== 1) {
					if(file_exists($urlUpload.$model->id."-".$model->pdf))
							unlink($urlUpload.$model->id."-".$model->pdf);
					$model->pdf = null;
				}

				$this->uploadFileBook($model);
		
				if($model->save())
				{
					

					if(! is_null($model->pictureFile)){
						$model->pictureFile->saveAs($urlUpload.$model->id."-cover.".$model->pictureFile->extensionName);	
						if($picturePrecSave != $model->picture) // si changement de format suppression de l'ancience couverture
							if(file_exists($urlUpload.$model->id."-".$picturePrecSave))
								unlink($urlUpload.$model->id."-".$picturePrecSave);
					}

					
					for ($i=1; $i <=3 ; $i++) { 
						$param = 'bookFile'.$i;		
						if(! is_null($model->$param)) {
							$extension = $model->$param->extensionName;
							$model->$param->saveAs($urlUpload.$model->id."-".$extension.'.'.$extension);
						}
					}

					$this->redirect(array('view','id'=>$model->id));
				}
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Send file to client
	 * @param integer $id the ID of the book
	 */
	public function actionDownload($id)
	{
		
		$model=$this->loadModel($id);
		$fileDir = Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.yii::app()->params->folder_upload.DIRECTORY_SEPARATOR;
		
		yii::app()->request->sendFile(
			$model->title."-".$model->epub,
			file_get_contents($fileDir.$model->id."-".$model->epub)
			);
	}

	/**
	* Toggle param push of a book
	* @param $id the ID of the book
	*/
	public function actionTogglePush($id)
	{

		$model=$this->loadModel($id);
		
		if($model->push) {
			$model->push = false;
		}
		else {
			$nbrBookPush = count($model->catalogue->books(array('condition'=>'push=1')));
			if($nbrBookPush >= 5) {
				yii::app()->user->setFlash("error","Vous pouvez mettre au maximun 5 ebooks en avant");
				Yii::app()->getController()->redirect(array('catalogue/manage'));
			}
			$model->push = true;
		}
		$model->save();

		if(! Yii::app()->request->isAjaxRequest) {
			Yii::app()->getController()->redirect(array('catalogue/manage'));
		}

	}

	/**
	* Delete a book
	* @param integer $id the ID of the book
	*/
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$this->layout = "//layouts/private";
		$this->render('delete',array('model'=>$model));
	}	

	/**
	* Confirm delete Book
	* @param integer $id the ID of the book
	* @throws CHttpException
	*/
	public function actionConfirmDelete($id)
	{
		if(Yii::app()->request->getUrlReferrer() == Yii::app()->createAbsoluteUrl('book/delete', array(
            'id'=>$id))){
			$model = $this->loadModel($id);
			$model->catalogueId = null;
			$model->save();
			Yii::app()->getController()->redirect(array('catalogue/manage'));
		}
		else{
			throw new CHttpException(403,"Vous n'êtes pas autorisé à effectuer cette action.");
		}
	}


 
	/**
	 * default action
	 * Redirect user to home
	 */
	public function actionIndex()
	{
		
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	* Check is user is owner of book
	* @return boolean
	*/
	private function isOwner($id){

		 $model = $this->loadModel($id);
		 if(isset($model->catalogue))
		 	return yii::app()->user->id === $model->catalogue->userId;
		 return false;
	}


	/**
	* Check is user is owner of book, use in acces rules
	* @return boolean
	* @throws CHttpException
	*/
	public function isOwnerRules()
	{
     	if(isset($_GET["id"])) {
	        $model = $this->loadModel($_GET['id']);
	        if(isset($model->catalogue))
	        	return yii::app()->user->id === $model->catalogue->userId;
	    }
	    throw new CHttpException(400,"votre requête est invalide");
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Book the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Book::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Book $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='book-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
