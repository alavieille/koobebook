<?php 
/**
* Classs who represente a response sent by API Etransactions
* @author Amaury Lavieille
*/
class ResponsePayment
{

	public $code;
	public $error;
	public $merchant_id;
	public $merchant_country;
	public $amount;
	public $transaction_id;
	public $payment_means;
	public $transmission_date;
	public $payment_time;
	public $payment_date;
	public $response_code;
	public $payment_certificate;
	public $authorisation_id;
	public $currency_code;
	public $card_number;
	public $cvv_flag;
	public $cvv_response_code;
	public $bank_response_code;
	public $complementary_code;
	public $complementary_info;
	public $caddie;
	public $receipt_complement;
	public $merchant_language;
	public $language;
	public $customer_id;
	public $order_id;
	public $customer_email;
	public $customer_ip_address;
	public $capture_day;
	public $capture_mode;
	public $data;

	public function __construct($tableau)
	{

		$this->code                = $tableau[1];
		$this->error               = $tableau[2];
		$this->merchant_id         = $tableau[3];
		$this->merchant_country    = $tableau[4];
		$this->amount              = $tableau[5];
		$this->transaction_id      = $tableau[6];
		$this->payment_means       = $tableau[7];
		$this->transmission_date   = $tableau[8];
		$this->payment_time        = $tableau[9];
		$this->payment_date        = $tableau[10];
		$this->response_code       = $tableau[11];
		$this->payment_certificate = $tableau[12];
		$this->authorisation_id    = $tableau[13];
		$this->currency_code       = $tableau[14];
		$this->card_number         = $tableau[15];
		$this->cvv_flag            = $tableau[16];
		$this->cvv_response_code   = $tableau[17];
		$this->bank_response_code  = $tableau[18];
		$this->complementary_code  = $tableau[19];
		$this->complementary_info  = $tableau[20];
		$this->return_context      = $tableau[21];
		$this->caddie              = $tableau[22];
		$this->receipt_complement  = $tableau[23];
		$this->merchant_language   = $tableau[24];
		$this->language            = $tableau[25];
		$this->customer_id         = $tableau[26];
		$this->order_id            = $tableau[27];
		$this->customer_email      = $tableau[28];
		$this->customer_ip_address = $tableau[29];
		$this->capture_day         = $tableau[30];
		$this->capture_mode        = $tableau[31];
		$this->data                = $tableau[32];
	}

}

 ?>