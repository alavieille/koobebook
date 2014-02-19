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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'download','delete','confirmDelete'),
				'users'=>array('@'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
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
		// recherche catalogue lié
		$catalogue = Catalogue::model()->findByAttributes(array('userId'=>yii::app()->user->id));
	

		if(is_null($catalogue)){
			$this->redirect(array('catalogue/create'));
		}

		$model->editor = $catalogue->name;
		$model->catalogueId = $catalogue->id;

		if(isset($_POST['Book']))
		{
			$model->attributes=$_POST['Book'];

			$model->pictureFile  = CUploadedFile::getInstance($model,'pictureFile');

			$model->epubFile = CUploadedFile::getInstance($model,'epubFile');

			
			if(! is_null($model->pictureFile ))
				$model->picture="cover.".$model->pictureFile->extensionName;
			
			if(! is_null($model->epubFile))
				$model->epub="epub.".$model->epubFile->extensionName;


			if($model->save())
			{
				$urlUpload = Yii::app()->basePath.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.yii::app()->params->folder_upload.DIRECTORY_SEPARATOR;

				if(! is_null($model->pictureFile))
					$model->pictureFile->saveAs($urlUpload.$model->id."-cover.".$model->pictureFile->extensionName);			

				$model->epubFile->saveAs($urlUpload.$model->id."-epub.".$model->epubFile->extensionName);

				$this->redirect(array('view','id'=>$model->id));
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Book']))
		{
			$model->attributes=$_POST['Book'];


			$model->pictureFile  = CUploadedFile::getInstance($model,'pictureFile');
			$model->epubFile = CUploadedFile::getInstance($model,'epubFile');

			
			if(! is_null($model->pictureFile ))
				$picturePrecSave = $model->picture;
				$model->picture = "cover.".$model->pictureFile->extensionName;
			
			if(! is_null($model->epubFile))
				$model->epub="epub.".$model->epubFile->extensionName;

			if($model->save()){
				$urlUpload = Yii::app()->basePath.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.yii::app()->params->folder_upload.DIRECTORY_SEPARATOR;

				if(! is_null($model->pictureFile)){
					$model->pictureFile->saveAs($urlUpload.$model->id."-cover.".$model->pictureFile->extensionName);			
					if($picturePrecSave != $model->picture)
						unlink($urlUpload.$model->id."-".$picturePrecSave);
				}
				if(! is_null($model->epubFile))
					$model->epubFile->saveAs($urlUpload.$model->id."-epub.".$model->epubFile->extensionName);

				$this->redirect(array('view','id'=>$model->id));
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

	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$this->layout = "//layouts/private";
		$this->render('delete',array('model'=>$model));
	}	

	/**
	* Confirm delete account
	**/
	public function actionConfirmDelete($id)
	{
		if(Yii::app()->request->getUrlReferrer() == Yii::app()->createAbsoluteUrl('book/delete', array(
            'id'=>$id))){
			$model = $this->loadModel($id);
			$model->delete();
			$urlUpload = Yii::app()->basePath.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.yii::app()->params->folder_upload.DIRECTORY_SEPARATOR;
			unlink($urlUpload.$model->id."-".$model->epub);
			if($model->picture);
				unlink($urlUpload.$model->id."-".$model->picture);
			Yii::app()->getController()->redirect(array('catalogue/manage'));
		}
		else{
			throw new CHttpException(403,"Vous n'êtes pas autorisé à effectuer cette action.");
		}
	}
	/** 
	* Confirm delete book 
	**/
	/*public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}*/

 	public function actionAdmin()
    {
        $dataProvider=new CActiveDataProvider('Book');
        $model = Book::model()->findAll();

        $this->render('admin',array(
            'dataProvider'=>$dataProvider,
            'model'=>$model,
        ));
    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		 $dataProvider=new CActiveDataProvider('Book');
        $model = Book::model()->findAll();

        $this->render('admin',array(
            'dataProvider'=>$dataProvider,
            'model'=>$model,
        ));
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
