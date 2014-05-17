<!doctype html>
<html lang="fr">
<head>
<meta charset="UTF-8">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="shortcut icon" href="<?php echo yii::app()->baseUrl; ?>/images/favicon.ico" type="image/x-icon" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php  				
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/knacss.css');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/style.css');

 ?>
</head>
<body>
<div id="main" class="txtcenter">
	<h1 class=" ml1 mt0 mb0 txtcenter small-w100" id="logo" ><span class="logo ">koob<span>ebook</span></span></h1>
	<?php if($paymentForm != null ) : ?>
		<h4>Achat du livre <?php echo $model->title; ?></h4>
		<p>Prix : <?php echo $model->price ?>&euro;</p>
		<p class="mb1">Choissisez votre mode de paiement : </p>
	<?php echo $paymentForm; ?>
	<?php elseif (yii::app()->user == true) : ?>
		<p>Vous devez être connecté pour effectuer un achat.</p>
	<?php else : ?>
		<p>Impossible d'afficher le module de paiement, veuillez contacter l'administrateur.</p>
	<?php endif; ?>
</div>
</body>