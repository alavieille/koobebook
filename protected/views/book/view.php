<?php
/* @var $this BookController */
/* @var $model Book */

?>


<div id="viewBook" class="view center mw960p pt3 pb3 mt2">


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

	<div class="info mod tiny-w100">
		<h2 class="pl1 mb0 title"><?php echo CHtml::encode($model->title); ?></h2>
		<h4 class="pl1 mt1 mb0 author">De <?php echo CHtml::encode($model->author); ?></h4>
		<?php if(! is_null($model->catalogue)) :?>
			<p class="pl1 mt0 editor pt1">Edité par <a href="<?php echo Yii::app()->createUrl('catalogue/view/',array( 'id'=>$model->catalogueId));  ?>"><?php echo CHtml::encode($model->catalogue->name); ?> </a>
	 		(<?php echo Yii::app()->dateFormatter->formatDateTime($model->publication, 'medium', null) ?>)
			</p>
		<?php else : ?>
			<p class="pl1 small">(L'editeur a supprimer ce ebook de son catalogue)</p>
		<?php endif; ?>

		<?php if(! is_null($model->isbn)) :?>
			<p class="pl1"><?php echo CHtml::encode($model->getAttributeLabel('isbn')); ?> : <?php echo CHtml::encode($model->isbn); ?></p>
		<?php endif;?>

		
		<p class="pl1">Prix : <?php echo (CHtml::encode($model->price) == 0) ? "gratuit" :  CHtml::encode($model->price)." €";  ?></p>
		
		<?php echo CHtml::link(CHtml::encode($model->price) == 0 ? "Télécharger" : "Acheter",array('book/download',
                                         'id'=>$model->id),array("class"=>"linkDown")); ?>

	</div>
	<?php if($isOwner) : ?>
		<nav>
			<?php 
				$this->widget('zii.widgets.CMenu',array(
					'items'=>array(
						array('label'=>'Modifier', 'url'=>array('/book/update/'.$model->id),'linkOptions'=>array("class"=>"linkButton")),
						array('label'=>'Supprimer', 'url'=>array('/book/delete/'.$model->id),'linkOptions'=>array("class"=>"linkButton")),
					
					),
					'itemCssClass' => "pb1 inbl",
				));

			?>
		</nav>
	<?php endif; ?>
	<div class="line mt3 description mb3 pa2">
	<h4><?php echo CHtml::encode($model->getAttributeLabel('description')); ?> : </h4>
	<p><?php echo CHtml::encode($model->description); ?></p>
	</div>
</div>