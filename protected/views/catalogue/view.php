<?php
/* @var $this CatalogueController */
/* @var $model Catalogue */
$this->pageTitle=Yii::app()->name . ' - Catalogue';
?>
<section class="mod catalogue" id="viewCatalogue">
	
<h2 class="pa2 txtcenter">Catalogue de <?php echo $model->name; ?></h2>
<div class="center mw960p">		
	<?php if($isOwner) : ?>
		<nav>
			<?php 
				$this->widget('zii.widgets.CMenu',array(
					'items'=>array(
						array('label'=>'Modifier', 'url'=>array('/catalogue/update/'.$model->id),'linkOptions'=>array("class"=>"linkButton")),
						array('label'=>'Supprimer', 'url'=>array('/catalogue/delete/'.$model->id),'linkOptions'=>array("class"=>"linkButton")),
						
					),
					'itemCssClass' => "pb1 inbl",
					'htmlOptions' => array("class" => 'pl1')
				));

			?>
		</nav>
	<?php endif; ?>

</div>

<div id="viewPushBook">		
	<?php if (count($pushBooks) > 0) : ?>
		<section  class="pa2 pt1 center mw960p">
			<h3 class="mb2">À la une</h3>

			<div class="autogrid5">
				<?php foreach ($pushBooks as $book) :?>
					<?php $this->renderPartial('//book/_viewBookCatalogue', array('book'=>$book)); ?>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>
</div>

<div id="viewDescription">
	<?php if ($model->description != "") : ?>
		<section class="pa2 pt1 mb1 center mw960p">
			<h3  class="mb2" ><?php echo CHtml::encode($model->getAttributeLabel('description')); ?> </h3>
			<p>
				<?php echo $model->description ?>
			</p>
		</section>
	<?php endif; ?>
</div>

<div id="viewLtBook">
	<section class="pa2 pt1 center mw960p">
		<h3  class="mb2" >Ces Ebooks</h3>
		<?php if (count($books) > 0) : ?>
			<div class="autogrid5">
			<?php foreach ($books as $book) :?>
					<?php $this->renderPartial('//book/_viewBook', array('book'=>$book)); ?>
			<?php endforeach; ?>
			</div>
		<?php else : ?>
			<p class="txtcenter h5-like pt3"> Aucun ebook </p>
		<?php endif;?>
	</section>
</div>
</section>
