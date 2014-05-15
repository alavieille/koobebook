<?php

class PaymentController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('returnStore','cancelStore'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('initPurchase'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function actionInitPurchase($idBook)
	{
		$book = Book::model()->findByPk($idBook);
		if($book != null ) {
			$price = $book->price;
			$centime = $price * 60;
			$numfact = $book->id."-".yii::app()->user->id."-".date("dmy");

		    $pathfile = Yii::app()->basePath."/../lib/eTransactions/param/pathfile";
		    var_dump($pathfile);
		    $path_bin = Yii::app()->basePath."/../lib/eTransactions/bin/request";

			$paiement= array(
				"merchant_id" => "013044876511111",
				"merchant_country" => "fr",
				"amount" => $centime,
				"currency_code"=> "978",
				"pathfile" => $pathfile,
				"caddie" => $numfact,
				"transaction_id"=> "",
				"normal_return_url" => $this->createAbsoluteUrl("returnStore"),
				"cancel_return_url" => $this->createAbsoluteUrl("payment/cancelStore"),
				"automatic_response_url" => $this->createAbsoluteUrl("autoResponse"),
				"language" => "fr",
				"payment_means"=> "CB,2,VISA,2,MASTERCARD,2",
				"header_flag" => "no",
				"capture_day"=> "",
				"capture_mode"=> "",
				"bgcolor"=> "black",
				"block_align" => "",
				"block_order" =>"",
				"textcolor" => "white",
				"receipt_complement" => "",
				"customer_id" => "",
				"customer_email" => "",
				"customer_ip_address" => "",
				"data"=> "",
				"return_context" =>"",
				"target" => "",
				"order_id" => "",
			);
		
	     $data = "";
	     foreach ($paiement as $key => $value) {
	     	$data .= " ".$key."=".$value;
	     }

	    // var_dump($path_bin);
	     var_dump("$path_bin$data");
	     $result = exec("$path_bin $data");

	     list($code,$buffer,$form)= array_slice(explode("!", $result),1);
	     var_dump($code);
	     if($code == 0 ) {
	     	echo $form;
	     }


		}
	}

	public function actionCancelStore()
	{

	}
}