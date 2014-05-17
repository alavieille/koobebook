<?php 
/** 
* A class for manage payment with eTransaction an API of Crédit Agricole
* @author Amaury Lavieille
*/
class Etransactions
{
	private $pathFile;
	private $pathResquest;
	private $pathResponse;
	private $merchant_id;

	public function __construct()
	{
		$this->pathFile = Yii::app()->basePath."/../".Yii::app()->params["etransactions"]["pathFile"];
		$this->pathResquest = Yii::app()->basePath."/../".Yii::app()->params["etransactions"]["request"];
		$this->pathResponse = Yii::app()->basePath."/../".Yii::app()->params["etransactions"]["response"];
		$this->merchant_id = Yii::app()->params["etransactions"]["merchant_id"];; 
	}
	
	/**
	* Init request for payment 
	* @param $price price of payment
	* @param $returnUrl url who manage response of payment
	* @param $numFac identifiant of payment
	*@return form or string
	*/
	public function initPurchase($price,$returnUrl,$numfact)
	{

		$centime = $price * 100;
		$paiement= array(
				"merchant_id" => "013044876511111",
				"merchant_country" => "fr",
				"amount" => $centime,
				"currency_code"=> "978",
				"pathfile" => $this->pathFile,
				"caddie" => $numfact,
				"transaction_id"=> "",
				"normal_return_url" => $returnUrl,
				"cancel_return_url" => $returnUrl,
				"automatic_response_url" => $returnUrl,
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

	     $result = exec("$this->pathResquest$data");
		if($result != '' ){
		     list($code,$buffer,$form)= array_slice(explode("!", $result),1);
			
			 if($code == 0 ) {
		     	return $form;
		     }
		 }
	     return null;
	}

	/**
	* Return reponse sent by API
	* @param $strin who content crypted response
	* @return $responsePayement an Instance of ResponsePayment
	*/
	public function getResponsePayment($data)
	{
		$pathfile = "pathfile=".$this->pathFile;
		$message = "message=". escapeshellcmd($data);
		$result = exec("$this->pathResponse $pathfile $message");
		$tableau = explode ("!", $result);
		$responsePayment = new ResponsePayment($tableau);
		return $responsePayment;

	}

}


 ?>