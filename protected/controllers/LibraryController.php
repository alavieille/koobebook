<?php

class LibraryController extends Controller
{
	
  	public $defaultAction = 'view';
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('view'),
				'users'=>array('@'),
			),
			/*array('allow',
				'actions'=>array('view','confirmDelete'),
				'users'=>array('@'),
				'expression'=> 'Yii::app()->controller->isOwnerRules()',
			),*/
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	* Show book who in the library of user
	*/
	public function actionView()
	{
		$this->layout = "//layouts/private";
		$model= Library::model()->findAllByAttributes(array('userId'=>yii::app()->user->id));
	    
	    $this->render('view',array(
			'model'=>$model,
		));	
	}

	/**
	* Delete book in library
	* @param Integer $id
	*/
	public function actionDelete($id)
	{
		$this->layout = "//layouts/private";
		$this->render('delete',array('id'=>$id));
	}


	/**
	* Confirm delete book in library
	* @param integer $id the ID of the catalogue
	**/
	public function actionConfirmDelete($id)
	{
	
		if(Yii::app()->request->getUrlReferrer() == Yii::app()->createAbsoluteUrl('library/delete', array(
            'id'=>$id))){
			$library= Library::model()->findByAttributes(array('userId'=>yii::app()->user->id,'bookId'=>$id));
			$library->delete();
			Yii::app()->getController()->redirect(array('library/view'));
		}
		else{
			throw new CHttpException(403,"Vous n'êtes pas autorisé à effectuer cette action.");
		}
	}
};