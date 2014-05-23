<?php 


class SepaCronCommand extends CConsoleCommand {


    public function run($args) {

    	$groupHeader = new GroupHeader(strtoupper(yii::app()->name.uniqid()),yii::app()->name);
		// $groupHeader = new GroupHeader('SEPA File Identifier', 'Your Company Name');
    	$sepaFile = new CustomerCreditTransferFile($groupHeader);
    	$payment = new PaymentInformation(
   			'Payment Info ID',
    		Yii::app()->params["sepa"]["iban"], 
    		Yii::app()->params["sepa"]["bic"], 
    		yii::app()->name
		);

    	$paymentEditor = $this->getEditorPayment();
    	if(count($paymentEditor) > 0 ){
			foreach ($paymentEditor as $pay) {
				$priceEditor = round(($pay->totalPriceEditor * 0.947)*(70/100),2);
				$iban = $pay->user->catalogue->iban;
				$bic = $pay->user->catalogue->bic;
				$namePayment = $pay->user->catalogue->namePayment;
				if(!empty($bic) && !empty($iban) && !empty($namePayment)) {
					$transfer = new CustomerCreditTransferInformation(
					    $priceEditor, 
					    $iban, 
					    $namePayment 
					);

					$transfer->setBic($bic); 
					$transfer->setRemittanceInformation('Paiement kookebook');

					$payment->addTransfer($transfer);

					$this->saveStatusTransfer($pay->user->catalogue->id);

					$this->sendValidEmail($pay,$priceEditor);
				}
				else {

					$this->sendErrorEmail($pay,$priceEditor);
				}
			}
	  		$sepaFile->addPaymentInformation($payment);
	  		$domBuilder = DomBuilderFactory::createDomBuilder($sepaFile, 'pain.001.001.03');
	  		$file = yii::app()->basePath."/../sepa/".strftime("%d-%B-%Y").".xml";
	  		$content = $domBuilder->asXml();
	  	 	file_put_contents($file, $content);

	  	 }

    }


    private function getEditorPayment()
    {
    	$criteria = new CDbCriteria();
		$criteria->select = "sum(book.price) as totalPriceEditor, t.*, catalogue.*, book.*";
		$criteria->join = "INNER JOIN book on t.bookId = book.id";
		$criteria->join .= " INNER JOIN catalogue on book.catalogueId = catalogue.id";
		$criteria->condition = " t.statusTransfer = 0";
		$criteria->group = "catalogue.id";
		$paymentEditor = Payment::model()->findAll($criteria);
		return $paymentEditor;
    }

    private function saveStatusTransfer($catalogueId)
    {

		Yii::app()->db
	    ->createCommand("UPDATE payment INNER JOIN book  on bookId = book.id SET payment.statusTransfer=1  WHERE book.catalogueId = :catalogueId ")
	    ->bindValues(array(':catalogueId' => $catalogueId ))
	    ->execute();
    }

    private function sendValidEmail($pay,$priceEditor)
    {
		setlocale(LC_TIME, "fr_FR"); 
		$subject='=?UTF-8?B?Koobebook: Paiement mois de '.strftime("%B").'?=';
		$headers="From: ".Yii::app()->params['adminEmail']."\r\n".
				"Reply-To: ".Yii::app()->params['adminEmail']."\r\n".
				"MIME-Version: 1.0\r\n".
				"Content-Type: text/plain; charset=UTF-8";

		$content = "Bonjour, \n Votre compte bancaire va être prochainement crédité de $priceEditor euro \n";
		$content .= "Merci de votre confiance";
				
		mail($pay->user->email, $subject, $content);
    }

    private function sendErrorEmail($pay,$priceEditor)
    {
		$subject='=?UTF-8?B?Koobebook: Paiement impossible?=';
		$headers="From: ".Yii::app()->params['adminEmail']."\r\n".
				"Reply-To: ".Yii::app()->params['adminEmail']."\r\n".
				"MIME-Version: 1.0\r\n".
				"Content-Type: text/plain; charset=UTF-8";
		$content = "Bonjour, \n Impossible de créditer votre compte bancaire de $priceEditor euro\n";
		$content .= "Vueillez verifier que votre nom, votre IBAN et votre BIC sont bien renseigné dans les paramètres de votre catalogue. \n";
		$content .= "Votre virement sera fait automatiquement le mois prochain \n";
		$content .= "Merci de votre confiance";
				
		mail($pay->user->email, $subject, $content);
    }
}