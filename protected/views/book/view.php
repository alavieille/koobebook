<?php
/* @var $this BookController */
/* @var $model Book */

?>


<div id="viewBook" class="pt3 pb3">

		<?php if($isOwner) : ?>
			<nav class="center mw960p mb2">
				<?php 
					$this->widget('zii.widgets.CMenu',array(
						'items'=>array(
							array('label'=>'Modifier', 'url'=>array('/book/update/'.$model->id),'linkOptions'=>array("class"=>"linkButton")),
							array('label'=>'Supprimer', 'url'=>array('/book/delete/'.$model->id),'linkOptions'=>array("class"=>"linkButton")),
						
						),
						'itemCssClass' => "pb1 inbl",
						'htmlOptions' => array("class" => 'pl1')
					));

				?>
			</nav>
		<?php endif; ?>

 	<?php
 		// select picture of cover
 		$urlUpload = yii::app()->baseUrl.DIRECTORY_SEPARATOR.yii::app()->params->folder_upload;
 		$picture = yii::app()->baseUrl.DIRECTORY_SEPARATOR.'images/default_cover.png';
 		if(! is_null($model->picture)){
 			$urlUpload = yii::app()->baseUrl.DIRECTORY_SEPARATOR.yii::app()->params->folder_upload;
 			$picture = $urlUpload.DIRECTORY_SEPARATOR."book/".$model->id."/".$model->id."-".$model->picture;
 		}
 	?>
 	<div class="center mw960p mod">
		<div class="left w200p mod tiny-w100" >
			<img  src="<?php echo $picture; ?>" alt="Couverture du livre">
		</div>

		<div class="info mod tiny-w100">
			<h2 class="pl1 mb0 title "><?php echo CHtml::encode($model->title); ?></h2>
			<h3 class="pl1 mt0 subtitle "><?php echo CHtml::encode($model->subtitle); ?></h2>
			
			<h4 class="pl1 mt1 mb0 author">De <?php echo CHtml::encode($model->author); ?></h4>
			<?php if(! is_null($model->catalogue)) :?>
				<p class="pl1 mt0 editor pt1">Edité par <a href="<?php echo Yii::app()->createUrl('catalogue/view/',array( 'id'=>$model->catalogueId));  ?>"><?php echo CHtml::encode($model->catalogue->name); ?> </a>
		 		(<?php echo Yii::app()->dateFormatter->formatDateTime($model->publication, 'medium', null) ?>)
				</p>
			<?php else : ?>
				<p class="pl1 small">(L'editeur a supprimer ce ebook de son catalogue)</p>
			<?php endif; ?>

		
			<p class="pl1">Prix : <?php echo (CHtml::encode($model->price) == 0) ? "gratuit" :  CHtml::encode($model->price)." €";  ?></p>
			
			<?php echo CHtml::link(CHtml::encode($model->price) == 0 ? "Télécharger" : "Acheter",array('book/download',
	                                         'id'=>$model->id),array("class"=>"linkButton linkDown ")); ?>

		</div>
	</div>

	<div class="line mt3 description pa2">
		<section class="mw960p center">
			<h4><?php echo CHtml::encode($model->getAttributeLabel('description')); ?> : </h4>
			<p><?php echo CHtml::encode($model->description); ?></p>
		</section>
	</div>
	<div class="line mt1 mb3 pa2 more">
		<section class="mw960p center">
			<h4>Informations</h4>
			<p>ISBN : <?php echo empty($model->isbn) ? "Inconnue" :  CHtml::encode($model->isbn); ?></p>
			<p>Langue : <?php echo empty($model->language) ? "Inconnue" :  CHtml::encode(ucfirst($model->language)); ?></p>
		</section>
		
	</div>


</div>