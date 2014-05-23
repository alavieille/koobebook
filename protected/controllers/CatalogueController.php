<?php

class CatalogueController extends Controller
{


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','viewodps','view','manage','new','topDownload'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','manage','monitoring'),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array('delete','confirmDelete'),
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
		
		
		$model= $this->loadModel($id);
		$pushBooks = $model->books(array('condition'=>'push=1'));
		$books = $model->books(array('condition'=>'push=0'));
		$this->render('view',array(
			'model'=>$model,
			'pushBooks'=>$pushBooks,
			'books'=>$books,
			'isOwner'=>$this->isOwner($id)
		));
	}

	/**
	 * Displays a particular model in opds format.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewodps($id,$all=1)
	{
		$model= $this->loadModel($id);
		if( $all != 0) {
		$books = $model->books();
		}
		else {
		$books = $model->books(array('condition'=>'push=1'));
		}
		$this->renderPartial('viewOdps',array(
			'model'=>$model,
			'books'=>$books,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->layout = "//layouts/private";
		if(! is_null(Catalogue::model()->findByAttributes(array('userId'=>yii::app()->user->id)))){
			$this->redirect("manage");
		}
		$model=new Catalogue;
		$model->date_create = new CDbExpression('NOW()');

		if(isset($_POST['Catalogue']))
		{
			$model->attributes=$_POST['Catalogue'];
			$model->userId = yii::app()->user->id ;
			
			if($model->save())
				$this->redirect("manage");
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$this->layout = "//layouts/private";
		$model= Catalogue::model()->findByAttributes(array('userId'=>yii::app()->user->id));
		if(is_null($model))
			throw new CHttpException(400,"votre requête est invalide");

		if(isset($_POST['Catalogue']))
		{
			$model->attributes=$_POST['Catalogue'];
			if($model->save())
				$this->redirect(array('manage'));
		}

		$this->render('update',array(
			'model'=>$model,

		));
	}
	
	/**
	* Manage book in catalogue 
	* if user hasn't catalogue, he is redirect to action create
	*/
	public function actionManage($display="list"){
		
		// active upload for ckeditor with kcfinder
		$_SESSION['KCFINDER']['disabled'] = false; // enables the file browser in the admin
		$_SESSION['KCFINDER']['uploadURL'] = Yii::app()->baseUrl."/upload/"; // URL for the uploads folder
		$_SESSION['KCFINDER']['uploadDir'] = Yii::app()->basePath."/../upload";

		$this->layout = "//layouts/private";
		$model= Catalogue::model()->findByAttributes(array('userId'=>yii::app()->user->id));
		
		if(is_null($model))
			$this->redirect("create");
		
		$pushBooks = $model->books(array('condition'=>'push=1'));
		$books = $model->books(array('condition'=>'push=0'));


		$this->render('manage'.ucfirst($display),array(
			'catalogue' => $model,
			'books' => $books,
			'pushBooks' => $pushBooks,
			'display'=>$display,
			));
	}

	/**
	* Monitoring of ebook download
	*/
	public function actionMonitoring($type="buy",$month='')
	{


		$month = date('Y-m');
		if(isset($_GET['month']))
		{
			$month = $_GET['month'];
		}
		$cata= Catalogue::model()->findByAttributes(array('userId'=>yii::app()->user->id));
		
		$this->layout = "//layouts/private";
		$criteria = new CDbCriteria();
		if($type == "buy") {
			$criteria->with = array(
				'payment'=>array('joinType'=>'INNER JOIN'),
			);
			$criteria->addCondition('YEAR(payment.date) >= YEAR(STR_TO_DATE("'.$month.'","%Y-%m"))');
			$criteria->addCondition('MONTH(payment.date) = MONTH(STR_TO_DATE("'.$month.'","%Y-%m"))');
				
		}
		else {
			$criteria->with = array(
				'library'=>array('joinType'=>'INNER JOIN'),
			);	
		}
		
		$criteria->addCondition('t.catalogueId = '.$cata->id);
		$monitoring = Book::model()->findAll($criteria);


		$totalDownload = 0;
		$totalPrice= 0;
		$totalEditor =0;
	
		foreach ($monitoring as $book) {
			if( $type =="buy" ) {
				$totalDownload += $book->paymentCount($month);
				$totalPrice += $book->price * $book->paymentCount($month);
				$totalEditor = round(($totalPrice * 0.947)*(70/100),2);
		
			}
			else {
				$totalDownload += $book->libraryCount($month);
				$totalPrice += $book->price * $book->libraryCount($month);
			}
		}
		$this->render('monitoring',array(
			'month' => $month,
			'monitoring' => $monitoring,
			'totalPrice' => $totalPrice,
			'totalEditor'=>$totalEditor,
			'totalDownload' => $totalDownload,
			'type' => $type
			));

	}


	/**
	* Delete a catalogue
	* @param integer $id the ID of the catalogue
	*/
	public function actionDelete($id)
	{
		$this->layout = "//layouts/private";
		$this->render('delete',array('id'=>$id));

	}	

	/**
	* Confirm delete catalogue
	* @param integer $id the ID of the catalogue
	**/
	public function actionConfirmDelete($id)
	{
	
		if(Yii::app()->request->getUrlReferrer() == Yii::app()->createAbsoluteUrl('catalogue/delete', array(
            'id'=>$id))){
			foreach ($this->loadModel($id)->books as $book) {
				$book->catalogueId = null;
				$book->save();
			}
			$this->loadModel($id)->delete();
			Yii::app()->getController()->redirect(array('catalogue/create'));
		}
		else{
			throw new CHttpException(403,"Vous n'êtes pas autorisé à effectuer cette action.");
		}
	}

	
	/**
	 * Show different catalogue
	 */
	public function actionIndex()
	{
		$randCata = Catalogue::model()->findRandom();
		

		$newCata = Catalogue::model()->findRandomNew($randCata);

		$topBookid =Library::model()->findTopDownload();
		$topBook = array();
		foreach ($topBookid as $id) {
			$topBook[] = Book::model()->findByPk($id);
		}


		$this->render('index',array(
			'randCata'=> $randCata,
			'newCata'=>$newCata,
			'topBook'=>$topBook,
		));	

	}

	/**
	* Show all new catalogue
	**/
	public function actionNew()
	{
		
    	$allNewCata = Catalogue::model()->findAllNew();
    	$this->render('new',array(
			'newCata'=>$allNewCata,
		));	

	}

	/**
	* Show all top download catalogue
	**/
	public function actionTopDownload()
	{
		
    	$allTopCata = Catalogue::findTopDownload();
    	$this->render('topDownload',array(
			'allTopCata'=>$allTopCata,
		));	

	}

	/**
	* Check is user is owner of catalogue
	* @return boolean
	* @throws CHttpException
	*/
	public function isOwner($id)
	{
	    $model = $this->loadModel($id);
	    return yii::app()->user->id === $model->userId;
	}

	/**
	* Check is user is owner of catalogue, use in acces rules
	* @return boolean
	* @throws CHttpException
	*/
	public function isOwnerRules()
	{
     	if(isset($_GET["id"])){
	        $model = $this->loadModel($_GET['id']);
	        return yii::app()->user->id === $model->userId;
	    }
	    else{
	    	throw new CHttpException(400,"votre requête est invalide");
	    }
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Catalogue the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Catalogue::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Catalogue $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='catalogue-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}



}
