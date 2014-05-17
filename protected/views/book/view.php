<?php
/* @var $this BookController */
/* @var $model Book */

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/personalSelect.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.colorbox-min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/colorbox.css');
$this->pageTitle=Yii::app()->name . ' - Éditeurs';
$editor = null;
if(isset($model->catalogue)) {
	$this->breadcrumbs=array(
		    'Éditeurs'=>array('Catalogue/index'),
		    'Éditions '.$model->catalogue->name =>array('catalogue/view/'.$model->catalogue->id),
			 $model->title => array(),
	);
}


?>
<script>
	$(function(){
		$(".payment").colorbox({inline:true, width:"100%",maxWidth:'500px'});
	});

</script>

<div id="viewBook" class="pt3 pb3">
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
 	<div class="center mw960p">
		<div class="left w200p mod mb1 tiny-w100" >
			<img  src="<?php echo $picture; ?>" alt="Couverture du livre">
		</div>

		<div class="info tiny-w100">
			<h2 class="pl1 mb0 title "><?php echo CHtml::encode($model->title); ?></h2>
			<h3 class="pl1 mt0 subtitle "><?php echo CHtml::encode($model->subtitle); ?></h2>
			
			<h4 class="pl1 mt1 mb0 author"> De
			<?php $number = 0; ?>
			<?php foreach ($author as $value) : ?>
					<?php if($number > 0 ) echo " & "; ?>
					<a href="<?php echo Yii::app()->createUrl('search/search/',array('type'=>'author','query'=>$value["name"]));  ?>"><?php echo $value["name"]; $number ++;?></a> 
			<?php endforeach; ?>
			</h4>
			<?php if(! is_null($model->catalogue)) :?>
				<p class="pl1 mt0 editor pt1">Edité par <a href="<?php echo Yii::app()->createUrl('catalogue/view/',array( 'id'=>$model->catalogueId));  ?>"><?php echo CHtml::encode($model->catalogue->name); ?> </a>
		 		(<?php echo Yii::app()->dateFormatter->formatDateTime($model->publication, 'medium', null) ?>)
				</p>
			<?php else : ?>
				<p class="pl1 small">(L'editeur a supprimer ce ebook de son catalogue)</p>
			<?php endif; ?>
		
			<p class="pl1">Prix : <?php echo (CHtml::encode($model->price) == 0) ? "gratuit" :  CHtml::encode($model->price)." €";  ?></p>
			
			<div class="form mt2 pl1">
				<?php if((CHtml::encode($model->price) == 0) || $isPayment != null) :  ?>
					<?php echo CHtml::beginForm(array("download",'id'=>$model->id),"get"); ?>
					<?php echo CHtml::submitButton("Télécharger",array("class"=>"inbl linkButton linkDown ")); ?> 
					<?php echo CHtml::dropDownList('format',reset($format),$format,array("class"=>"persoDropDown w200p inbl")); ?>
					<?php echo CHtml::endForm(); ?>
				<?php else :  ?>
					<?php echo CHtml::link('Acheter','#inline_content',array("class"=>"payment w150p inbl linkButton linkDown ")); ?>
				<div style='display:none'>
					<div id='inline_content' style='padding:10px; background:#fff;'>
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
				</div>
				<?php endif; ?>

			</div>

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
			<p>Format : <?php echo isset($model->epub) ? "Epub" : "" ?> <?php echo isset($model->mobi) ? "mobi" : "" ?> <?php echo isset($model->pdf) ? "PDF" : "" ?></p>
			<?php if(count($traductor) > 0 ) :?>
				<p>Traducteur : 
					<?php foreach ($traductor as $value) : ?>
							<a href="<?php echo Yii::app()->createUrl('search/search/',array('type'=>'traductor','query'=>$value["name"]));  ?>"><?php echo $value["name"];?></a> ,  
					
					<?php endforeach; ?>
				</p>
			<?php endif; ?>
			<?php if(count($illustrator) > 0 ) :?>
				<p>Illustrateur : 
					<?php foreach ($illustrator as $value) : ?>
							<a href="<?php echo Yii::app()->createUrl('search/search/',array('type'=>'illustrator','query'=>$value["name"]));  ?>"><?php echo $value["name"];?></a> ,  
					
					<?php endforeach; ?>
				</p>
			<?php endif; ?>
		</section>
		
	</div>


</div>