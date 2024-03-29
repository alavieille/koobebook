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
				'actions'=>array('index','view','viewodps','download','topDownload','extractInfo','responsePayment','ResponsePaymentOpds'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user 
				'actions'=>array('create','opdsPayment'),
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
		$contributors = $model->contributors;
		$author = array();
		$traductor = array();
		$illustrator = array();
		foreach ($contributors as $contributor) {
			if( $contributor["type"] == "author")
				$author[] = $contributor;
			elseif ($contributor["type"] == "traductor") 
				$traductor[] = $contributor;
			elseif ($contributor["type"] == "illustrator")
				$illustrator[] = $contributor;
		}

		$format = array();
		if(isset($model->epub)) {
			$format["epub"] = "Epub";
		}
		if(isset($model->mobi)) {
			$format["mobi"] = "Mobi";
		}
		if(isset($model->pdf)) {
			$format["pdf"] = "PDF";
		}
		$isPayment = Payment::model()->findByAttributes(array('userId'=>yii::app()->user->id,'bookId'=>$id));
		$returnUrl =  $this->createAbsoluteUrl("book/responsePayment");
		$this->render('view',array(
			'model'=>$model,
			'format'=>$format,
			'traductor'=>$traductor,
			'illustrator'=>$illustrator,
			'author'=>$author,
			'isOwner'=>$this->isOwner($id),
			'paymentForm'=>$this->getFormPayment($model,$returnUrl),
			'isPayment'=>$isPayment,
		));
	}

	/** 
	* return form of payment
	* @param $book Instance of book
	* @param $returnUrl string
	* @return string who content form or null
	*/
	private function getFormPayment($book,$returnUrl)
	{
		if($book != null &&  yii::app()->user->isguest == false) {
			$price = $book->price;
			$numfact = $book->id.'-'.yii::app()->user->id.'-'.date("dmy");
			$etransaction = new Etransactions();

			return $etransaction->initPurchase($price,$returnUrl,$numfact);
		}
		return null;
	}

	/** 
	* Check response of payment
	**/
	public function actionResponsePayment()
	{
		if(isset($_POST["DATA"])) {
			$data = $_POST["DATA"];
			$etransaction = new Etransactions();
			$responsePayment = $etransaction->getResponsePayment($data);
			list($idBook,$idUser) = explode("-",$responsePayment->caddie);
			if($responsePayment->code == "" && $responsePayment->code != 0 && $responsePayment->error == "") {
				Yii::app()->user->setFlash('error', "Transaction annulé - Erreur du module de paiement ");
			}
			else {

				if($responsePayment->response_code == "17") {
					Yii::app()->user->setFlash('notice', "Transaction correctement annulé");
				}
				elseif($responsePayment->bank_response_code == "00"){

					if( count(Payment::model()->findByAttributes(array('userId'=>$idUser,'bookId'=>$idBook))) <= 0 ) {
						$payment = new Payment();
						$payment->userId = $idUser;
						$payment->bookId = $idBook;
						$payment->numFact = $responsePayment->caddie;
						$payment->date =  new CDbExpression('NOW()');
						$payment->save();

						Yii::app()->user->setFlash('success', "Transaction réussite");
					}

				}
				else{
					Yii::app()->user->setFlash('error', "Transaction refusé");
				}

			}


		   Yii::app()->getController()->redirect(array('book/view/'.$idBook));
		}
		Yii::app()->user->setFlash('error', "Transaction annulé - Erreur");
		 $this->redirect(array('site/index'));
	}

	/** 
	* show page for payement with opds
	* @param $id is a bookId
	**/
	public function actionOpdsPayment($id)
	{
		$model = Book::model()->findByPk($id);
		$returnUrl =  $this->createAbsoluteUrl("book/responsePaymentOpds");
		$paymentForm = $this->getFormPayment($model,$returnUrl);
		$this->renderPartial('/site/paymentOpds',array(
			'model'=>$model,
			'paymentForm'=>$paymentForm,
		),false,true);
	}

	/** 
	* response of payment with opds
	**/
	public function actionResponsePaymentOpds()
	{
		if(isset($_POST["DATA"])) {
			$data = $_POST["DATA"];
			$etransaction = new Etransactions();
			$responsePayment = $etransaction->getResponsePayment($data);
			list($idBook,$idUser) = explode("-",$responsePayment->caddie);
			if($responsePayment->code == "" && $responsePayment->code != 0 && $responsePayment->error == "") {
				Yii::app()->user->setFlash('error', "Transaction annulé - Erreur du module de paiement ");
			}
			else {

				if($responsePayment->response_code == "17") {
					Yii::app()->user->setFlash('notice', "Transaction correctement annulé");
				}
				elseif($responsePayment->bank_response_code == "00"){
					$payment = new Payment();
					$payment->userId = $idUser;
					$payment->bookId = $idBook;
					$payment->numFact = $responsePayment->caddie;
					$payment->date =  new CDbExpression('NOW()');
					$payment->save();
					Yii::app()->user->setFlash('success', "Transaction réussite");
				

				}
				else{
					Yii::app()->user->setFlash('error', "Transaction refusé");
				}
			}

			$model = Book::model()->findByPk($idBook);
			$catalogueId = $model->catalogue->id;
			$this->renderPartial('/site/responsePaymentOpds',array(
				'catalogueId'=>$catalogueId,
			),false,true);
			exit;
		}
		throw new CHttpException(400,"Transaction annulé - Erreur");
	}

	/**
	 * Displays a particular model in opds format.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewodps($id)
	{
		$model= $this->loadModel($id);
		$contributors = $model->contributors;
		$author = array();
		$traductor = array();
		$illustrator = array();
		foreach ($contributors as $contributor) {
			if( $contributor["type"] == "author")
				$author[] = $contributor;
			elseif ($contributor["type"] == "traductor") 
				$traductor[] = $contributor;
			elseif ($contributor["type"] == "illustrator")
				$illustrator[] = $contributor;
		}
		$isPayment = Payment::model()->findByAttributes(array('userId'=>yii::app()->user->id,'bookId'=>$id));
		$this->renderPartial('viewOdps',array(
			'model'=>$model,
			'traductor'=>$traductor,
			'illustrator'=>$illustrator,
			'author'=>$author,
			'isPayment'=>$isPayment,
		));
	}

	/**
	* Manage upload of all format of ebook
	* @param Object $model 
	*/
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
		$hasAuthor = false;
		$contributors = array();
		//default value
		$model->price = 0;
		$model->date_create = new CDbExpression('NOW()');
		// recherche catalogue lié
		$catalogue = Catalogue::model()->findByAttributes(array('userId'=>yii::app()->user->id));
	

		if(is_null($catalogue)){
			$this->redirect(array('catalogue/create'));
		}


		$model->catalogueId = $catalogue->id;

		if(isset($_POST['Book']) && isset($_POST['contributor']))
		{
			foreach ($_POST['contributor'] as $contributor) {
				if( trim($contributor['name']) != "" && in_array($contributor['type'],array('author','illustrator','traductor')))
			  	{
			  		$newContributor = new Contributor;
				  	$newContributor->name = $contributor['name'];
				  	$newContributor->type = $contributor['type'];
				  	if($contributor['type'] == 'author') {
				  		$hasAuthor = true;
				  	}
				  	$contributors[] = $newContributor;
				}
			}

			$model->attributes=$_POST['Book'];

			//upload couverture & ebook 
			$model->pictureFile  = CUploadedFile::getInstance($model,'pictureFile');
			$model->bookFile1 = CUploadedFile::getInstance($model,'bookFile1');
			$model->bookFile2 = CUploadedFile::getInstance($model,'bookFile2');
			$model->bookFile3 = CUploadedFile::getInstance($model,'bookFile3');

			$this->uploadFileBook($model);
		
			if(! is_null($model->pictureFile )) // si couverture
				$model->picture="cover.".$model->pictureFile->extensionName;

			if(! $hasAuthor) {
				$model->addError('', 'Vous devez ajouter au moins un auteur');
				goto end;
			}

			if($model->save())
			{

				foreach ($contributors as $contributor) {
					$contributor->bookId = $model->id;

					$contributor->save();
				}

				$urlUpload = Yii::app()->basePath.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.yii::app()->params->folder_upload.DIRECTORY_SEPARATOR;

				if(! file_exists($urlUpload."/book/".$model->id)) {
					mkdir($urlUpload."/book/".$model->id,0777,true);
				}
				if(! is_null($model->pictureFile)) {
					$model->pictureFile->saveAs($urlUpload."/book/".$model->id."/".$model->id."-cover.".$model->pictureFile->extensionName);			
					$image = Yii::app()->image->load($urlUpload."/book/".$model->id."/".$model->id."-cover.".$model->pictureFile->extensionName);
					$image->resize(260, 392);
					$image->save();
				}
 				

				for ($i=1; $i <=3 ; $i++) { 
					$param = 'bookFile'.$i;		
					if(! is_null($model->$param)) {
						$extension = $model->$param->extensionName;
						$model->$param->saveAs($urlUpload."/book/".$model->id."/".$model->id."-".$extension.'.'.$extension);
					}
				}
				$this->redirect(array("catalogue/manage"));
			}
		}
		end:
		$this->render('create',array(
			'model'=>$model,
			'contributors'=>$contributors,
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

		$hasAuthor = false;
		$contributors = $model->contributors;
		$oldContributors = $contributors;

		if(isset($_POST['Book']) && $_POST['contributor'])
		{
			$model->attributes=$_POST['Book'];

			$model->pictureFile  = CUploadedFile::getInstance($model,'pictureFile');

			$model->bookFile1 = CUploadedFile::getInstance($model,'bookFile1');
			$model->bookFile2 = CUploadedFile::getInstance($model,'bookFile2');
			$model->bookFile3 = CUploadedFile::getInstance($model,'bookFile3');
			

			foreach ($_POST['contributor'] as $contributor) {
				if( trim($contributor['name']) != "" && in_array($contributor['type'],array('author','illustrator','traductor')))
			  	{
			  		$newContributor = new Contributor;
				  	$newContributor->name = $contributor['name'];
				  	$newContributor->type = $contributor['type'];
				  	if($contributor['type'] == 'author') {
				  		$hasAuthor = true;
				  	}
				  	$contributors[] = $newContributor;
				}
			}

			
			if(! is_null($model->pictureFile )){
				$picturePrecSave = $model->picture; // ancienne couverture 
				$model->picture = "cover.".$model->pictureFile->extensionName;
			}
			if($model->validate()) {

				if(! $hasAuthor) {
					$model->addError('', 'Vous devez ajouter au moins un auteur');
					goto end;
				}

	
				$urlUpload = Yii::app()->basePath.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.yii::app()->params->folder_upload.DIRECTORY_SEPARATOR;
				
				if(isset($_POST['Book']['deleteEpub']) and $_POST['Book']['deleteEpub']== 1) {
					if(file_exists($urlUpload."/book/".$model->id."/".$model->id."-".$model->epub))
							unlink($urlUpload."/book/".$model->id."/".$model->id."-".$model->epub);
					$model->epub = null;
				}

				if(isset($_POST['Book']['deleteMobi']) and $_POST['Book']['deleteMobi']== 1) {
					if(file_exists($urlUpload."/book/".$model->id."/".$model->id."-".$model->mobi))
							unlink($urlUpload."/book/".$model->id."/".$model->id."-".$model->mobi);
					$model->mobi = null;
				}

				if(isset($_POST['Book']['deletePdf']) and $_POST['Book']['deletePdf']== 1) {
					if(file_exists($urlUpload."/book/".$model->id."/".$model->id."-".$model->pdf))
							unlink($urlUpload."/book/".$model->id."/".$model->id."-".$model->pdf);
					$model->pdf = null;
				}

				$this->uploadFileBook($model);
				if($model->save())
				{
					
					foreach ($contributors as $contributor) {
						$contributor->bookId = $model->id;

						$contributor->save();
					}

					foreach ($oldContributors as $oldContributor) {
						$oldContributor->delete();
					}

					if(! is_null($model->pictureFile)){
						$model->pictureFile->saveAs($urlUpload."/book/".$model->id."/".$model->id."-cover.".$model->pictureFile->extensionName);	
						$image = Yii::app()->image->load($urlUpload."/book/".$model->id."/".$model->id."-cover.".$model->pictureFile->extensionName);
						$image->resize(260, 392);
						$image->save();
						if($picturePrecSave != $model->picture) // si changement de format suppression de l'ancience couverture
							if(file_exists($urlUpload."/book/".$model->id."/".$model->id."-".$picturePrecSave))
								unlink($urlUpload."/book/".$model->id."/".$model->id."-".$picturePrecSave);
					}

					
					for ($i=1; $i <=3 ; $i++) { 
						$param = 'bookFile'.$i;		
						if(! is_null($model->$param)) {
							$extension = $model->$param->extensionName;
							$model->$param->saveAs($urlUpload."/book/".$model->id."/".$model->id."-".$extension.'.'.$extension);
						}
					}

					$this->redirect(array("catalogue/manage"));
				}
			}
		}
		end:
		$this->render('update',array(
			'model'=>$model,
			'contributors'=>$contributors,
		));
	}

	/**
	 * Send file to client
	 * @param integer $id the ID of the book
	 */
	public function actionDownload($id)
	{
		
		if( ! isset($_GET["format"])) {
			throw new CHttpException(400,"votre requête est invalide");
		}
		$model=$this->loadModel($id);
		$fileDir = Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.yii::app()->params->folder_upload.DIRECTORY_SEPARATOR;

		$format = $_GET['format'];
		$file = $fileDir."/book/".$model->id.'/'.$model->id."-".$model->$format;
		if(file_exists($file)) {
			if(isset(yii::app()->user->id)) {
				$library= Library::model()->findByAttributes(array('userId'=>yii::app()->user->id,'bookId'=>$id));
				if(! isset($library)) {
					$library = new Library();
					$library->userId = yii::app()->user->id;
					$library->bookId = $id;
					$library->date_download =  new CDbExpression('NOW()');
					$library->save();
				}
			}
			yii::app()->request->sendFile(
				$model->title."-".$model->$format ,
				file_get_contents($file)
			);
		}

		else {
			yii::app()->user->setFlash("error","Le fichier demandé n'existe pas");
			Yii::app()->getController()->redirect(array('book/view/'.$model->id));
		}
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
	* Extract information to file
	* Is ajax request
	*/
	public function actionExtractInfo()
	{
		if(Yii::app()->request->isAjaxRequest ) {
			try {
				$files = array("application/x-mobipocket-ebook"=>"mobi.mobi","application/epub+zip"=>"epub.epub");
				$metaFile = array();
				foreach ($_FILES as $file) {
					if( $file["error"] == 0 )
						$metaFile[] = FactoryMeta::initialize($file["tmp_name"], $file["type"]);
				}
				echo json_encode($this->getMetaFile($metaFile));
			} catch (Exception $e) {
				echo "error";
			}
		
		}
	}

	/**
	* Create an array who contains metadata information
	* @param $metaFiles Array contains metadata of all file
	* @return $meta an Array
	**/
	private function getMetaFile($metaFiles)
	{
		$meta = array(
			"title" => null,
			"author" => null,
			"language" => null,
			"description" => null,
			"date" => null,
			"isbn" => null,
			);
		foreach ($metaFiles as $metaFile) {
			if( $meta["title"] == null )
				$meta["title"] = $metaFile->getTitle();
			if( $meta["author"] == null )
				$meta["author"] = $metaFile->getAuthor();
			if( $meta["language"] == null )
				$meta["language"] = $metaFile->getLanguage();
			if( $meta["description"] == null )
				$meta["description"] = $metaFile->getDescription();
			if( $meta["date"] == null )
				$meta["date"] = date("Y-m-d", strtotime($metaFile->getDate()));
			if( $meta["isbn"] == null )
				$meta["isbn"] = $metaFile->getIsbn();
		}

		return $meta;
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


 	public function actionTopDownload()
 	{
		$topBookid = Library::model()->findTopDownload(30);
		$topBook = array();
		foreach ($topBookid as $id) {
			$topBook[] = Book::model()->findByPk($id);
		}
		$this->render('topDownload',array(
			'topBook'=>$topBook,
		));	

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
