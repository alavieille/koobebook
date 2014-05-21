<?php
/* @var $this CatalogueController */
/* @var $model Catalogue */
$this->pageTitle=Yii::app()->name . ' - Éditeurs';
$this->breadcrumbs=array(
	    'Éditeurs'=>array('Catalogue/index'),
	    'Éditions '.$model->name =>array('catalogue/view/'.$model->id),
	
);

?>
<section class="mod catalogue" id="viewCatalogue">
	
<h2 class="pa2 txtcenter">Éditions <?php echo $model->name; ?></h2>
<div class="center mw960p">		

		<nav class="mb2 mod ">
		<a class="linkButton  ml1 w200p left mr2" href="<?php echo  str_replace(array("http","https"), "opds", $this->createAbsoluteUrl('catalogue/viewodps',array('id'=>$model->id)));?>">
		Exporter au format opds
		</a>
		<a targer="_blank" href="<?php echo $this->createUrl("/site/help") ?>#opds" class="inbl ml1 pt1">Qu'est ce que le format opds ?</a>
			<?php if($isOwner) : ?>
			<?php 
				$this->widget('zii.widgets.CMenu',array(
					'items'=>array(
						array('label'=>'Modifier', 'url'=>array('/catalogue/update/'.$model->id),'linkOptions'=>array("class"=>" mr1 linkButton")),
						array('label'=>'Supprimer', 'url'=>array('/catalogue/delete/'.$model->id),'linkOptions'=>array("class"=>"linkButton")),
						
					),
					'itemCssClass' => "inbl",
					'htmlOptions' => array("class" => 'line  mt2 pl1 pr0 mr0')
				));
			?>
		<?php endif; ?>
		</nav>

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
		<section class="pa2 pt1 mb1 center line mw960p">
			<h3  class="mb2" >Présentation</h3>
			<p>
				<?php echo $model->description ?>
			</p>
		</section>
	<?php endif; ?>
</div>

<div id="viewLtBook">
	<section class="pa2 pt1 center mw960p">
		<h3  class="mb2" >Ses livres disponibles</h3>
		<?php if (count($books) > 0) : ?>
			<div class="autogrid5">
			<?php foreach ($books as $book) :?>
					<?php $this->renderPartial('//book/_viewBookCatalogue', array('book'=>$book)); ?>
			<?php endforeach; ?>
			</div>
		<?php else : ?>
			<p class="txtcenter h5-like pt3"> Aucun ebook </p>
		<?php endif;?>
	</section>
</div>
</section>
