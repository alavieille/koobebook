<?php
/* @var $this BookController */
/* @var $model Book */

?>


<div class="view pageCenter">




	<h2><?php echo CHtml::encode($model->title); ?></h2>


	
	<?php echo CHtml::encode($model->price); ?>


	
	<?php echo CHtml::encode($model->author); ?>

 	<?php
 		// select picture of cover
 		$urlUpload = yii::app()->baseUrl.DIRECTORY_SEPARATOR.yii::app()->params->folder_upload;
 		$picture = yii::app()->baseUrl.DIRECTORY_SEPARATOR.'images/default_cover.png';
 		if(! is_null($model->picture)){
 			$urlUpload = yii::app()->baseUrl.DIRECTORY_SEPARATOR.yii::app()->params->folder_upload;
 			$picture = $urlUpload.DIRECTORY_SEPARATOR.$model->id."-".$model->picture;
 		}
 	?>

	<img src="<?php echo $picture; ?>" alt="Couverture du livre">
	
	
	<?php echo CHtml::encode($model->description); ?>

	
	<?php echo CHtml::encode($model->editor); ?>



	<?php echo CHtml::encode($model->publication); ?>


	
	<?php echo CHtml::encode($model->isbn); ?>

	
</div>