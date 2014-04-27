<?php

class SearchController extends Controller
{
	
 	public $defaultAction = 'search';


 	/** 
 	* search editor , author or contributor 
 	* @param $query String
 	* @param $type String
 	*/
	public function actionSearch($query=null,$type=null)
	{
		$catalogues = array();
		$books = array();
		$contributors = array();
		switch ($type) {
			case 'book':
				$books = $this->actionSearchBook($query);
			break;

			case 'editor':
				$catalogues = $this->actionSearchCatalogue($query);
			break;

			case 'author':
			case 'illustrator':
			case 'traductor':

				$contributors = $this->actionSearchContributor($query,$type);
			break;

			case 'contributors':
				$contributors = $this->actionSearchContributor($query);
			break;

			case 'all':
				$books = $this->actionSearchBook($query);
				$catalogues = $this->actionSearchCatalogue($query);
				$contributors = $this->actionSearchContributor($query);

			break;
		
			default:
				break;
		}

		$this->render('allSearch',array(
			"catalogues"=>$catalogues,
			"books"=>$books,
			'contributors'=>$contributors,
			'query'=>$query,
			'type'=>$type,

		));
	}


	/** 
	* Search a book
	* @param $query String
	* @return Array
	*/
	public function actionSearchBook($query=null)
	{
		$res = array();
		if($query != null && trim($query) != '' ) {
			$searchModel = new Book('search');
			$searchModel->title = $query;
			$res = $searchModel->search()->getData();
		}

		return $res;
	}

	/**
	* Search a catalogue
	* @param $query
	* @return Array
	*/
	public function actionSearchCatalogue($query=null)
	{
		$res = array();
		if($query != null && trim($query) != '' ) {
			$searchModel = new Catalogue('search');
			$searchModel->name = $query;
			$res = $searchModel->search()->getData();
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
			$res = $newCata;
		}
		return $res;
	}

	/** 
	* Search a contributor
	* @param $query String
	* @param $type String type of contributor (author, illustrator, traductor)
	* @param Array
	*/
	public function actionSearchContributor($query=null,$type=null)
	{
		$res = array();
		if($query != null && trim($query) != '' ) {
			$searchModel = new Contributor('search');
			$searchModel->name = $query;
			$searchModel->type = $type;
			$res = $searchModel->search();

		}
		return $res;
	}

	
}