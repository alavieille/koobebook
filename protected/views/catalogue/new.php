<?php

$this->pageTitle=Yii::app()->name."- Nouveaux éditeurs" ;

$this->breadcrumbs=array(
	    'Éditeurs'=>array('Catalogue/index'),
	    'Nouveaux éditeurs'=>array('Catalogue/new'),
	
);
?>

<section class="mod pt2" id="indexCatalogue">
	<div class="center mw960p">	
		<?php if(count($newCata) > 0) : ?>
		<section id="newCatalogue">
			<h3 class="mb2 mr3 pl1">Nouveaux éditeurs</h3>
			<?php foreach ($newCata as $cata) : ?>
				<?php  $this->renderPartial('_viewNew', array('cata'=>$cata)); ?>
			<?php endforeach; ?>
		<section>
		<?php endif; ?>

	</div>

</section>