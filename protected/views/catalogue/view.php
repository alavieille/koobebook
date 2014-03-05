<?php
/* @var $this CatalogueController */
/* @var $model Catalogue */
$this->pageTitle=Yii::app()->name . ' - Catalogue';
?>
<section class="center mt2 mod mw960p" id="viewCatalogue">
	
<h2 class="pa2 txtcenter">Catalogue de <?php echo $model->name; ?></h2>
<?php if (count($pushBooks) > 0) : ?>
	<section id="viewPushBook" class="pa2 pt1">
		<h3 class="mb2">À à la une</h3>

		<div class="autogrid5">
			<?php foreach ($pushBooks as $book) :?>
				<?php $this->renderPartial('_viewBook', array('book'=>$book)); ?>
			<?php endforeach; ?>
		</div>
	</section>
<?php endif; ?>

<?php if ($model->description != "") : ?>
	<section id="viewDescription" class="pa2 pt1 mb1">
		<h3  class="mb2" ><?php echo CHtml::encode($model->getAttributeLabel('description')); ?> </h3>
		<p>
			<?php echo $model->description ?>
		</p>
	</section>
<?php endif; ?>

<section id="viewLtBook" class="pa2 pt1">
	<h3  class="mb2" >Ces Ebooks</h3>
	<?php if (count($books) > 0) : ?>
		<div class="autogrid5">
		<?php foreach ($books as $book) :?>
				<?php $this->renderPartial('_viewBook', array('book'=>$book)); ?>
		<?php endforeach; ?>
		</div>
	<?php else : ?>
		<p class="txtcenter h5-like pt3"> Aucun ebook </p>
	<?php endif;?>
</section>

</section>
