<?php
/* @var $this BookController */
/* @var $model Book */

?>


<div id="viewBook" class="view pageCenter w800p pt3">


 	<?php
 		// select picture of cover
 		$urlUpload = yii::app()->baseUrl.DIRECTORY_SEPARATOR.yii::app()->params->folder_upload;
 		$picture = yii::app()->baseUrl.DIRECTORY_SEPARATOR.'images/default_cover.png';
 		if(! is_null($model->picture)){
 			$urlUpload = yii::app()->baseUrl.DIRECTORY_SEPARATOR.yii::app()->params->folder_upload;
 			$picture = $urlUpload.DIRECTORY_SEPARATOR.$model->id."-".$model->picture;
 		}
 	?>

	<div class="left w200p mod tiny-w100" ><img  src="<?php echo $picture; ?>" alt="Couverture du livre"></div>

	<div class="info mod pl2 tiny-w100">
		<h2 class="mb0 title"><?php echo CHtml::encode($model->title); ?></h2>
		<h4 class="mt1 mb0 author">De <?php echo CHtml::encode($model->author); ?></h4>
		<?php if(! is_null($model->catalogue)) :?>
			<p class="mt0 editor pt1">Edité par <a href="#"><?php //echo CHtml::encode($model->editor); ?> </a>
	 		(<?php echo Yii::app()->dateFormatter->formatDateTime($model->publication, 'medium', null) ?>)
			</p>
		<?php else : ?>
			<p class="small">(L'editeur a supprimer ce ebook de son catalogue)</p>
		<?php endif; ?>

		<?php if(! is_null($model->isbn)) :?>
			<p><?php echo CHtml::encode($model->getAttributeLabel('isbn')); ?> : <?php echo CHtml::encode($model->isbn); ?></p>
		<?php endif;?>

		
		<p>Prix : <?php echo (CHtml::encode($model->price) == 0) ? "gratuit" :  CHtml::encode($model->price)." €";  ?></p>
		
		<?php echo CHtml::link(CHtml::encode($model->price) == 0 ? "Télécharger" : "Acheter",array('book/download',
                                         'id'=>$model->id),array("class"=>"linkDown")); ?>

	</div>


	<div class="line mt3 description mb3">
	<h4><?php echo CHtml::encode($model->getAttributeLabel('description')); ?> : </h4>
	<p><?php echo CHtml::encode($model->description); ?></p>
	</div>
</div>