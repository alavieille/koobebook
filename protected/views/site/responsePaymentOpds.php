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
	<h1 class=" ml1 mt0 mb0 mb2txtcenter small-w100" id="logo" ><span class="logo ">koob<span>ebook</span></span></h1>
	<?php if(Yii::app()->user->hasFlash('success')):?>
		<div class="txtcenter flashsuccess  pa1 mb2 small-w100 w80 center mw960p">
		    <?php echo Yii::app()->user->getFlash('success'); ?>
		</div>		    
	<?php elseif(Yii::app()->user->hasFlash('error')):?>
		<div class="txtcenter flasherror  pa1 mb2 small-w100 w80 center mw960p">
		    <?php echo Yii::app()->user->getFlash('error'); ?>
		</div>		
	<?php elseif(Yii::app()->user->hasFlash('notice')):?>
		<div class="txtcenter flashnotice  pa1 mb2 small-w100 w80 center mw960p">
		    <?php echo Yii::app()->user->getFlash('notice'); ?>
		</div>
	<?php endif; ?>

	<a class="center ml1 w200p  mt2 mr2" href="<?php echo  str_replace(array("http","https"), "opds", $this->createAbsoluteUrl('catalogue/viewodps',array('id'=>$catalogueId)));?>">
	Retourner au catalogue opds
	</a>


</div>
</body>