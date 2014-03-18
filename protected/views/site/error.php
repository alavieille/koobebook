<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Erreur';
$this->breadcrumbs=array(
	'Error',
);
?>

<section class=" pageCenter  pa1">
	<h2>Error <?php echo $code; ?></h2>

	<div class="error">
	<?php echo CHtml::encode($message); ?>
	</div>
</section>

