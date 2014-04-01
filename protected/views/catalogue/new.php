<?php

$this->pageTitle=Yii::app()->name."- Nouveautés" ;

$this->breadcrumbs=array(
	    'Catalogues'=>array('Catalogue/index'),
	    'Nouveautés'=>array('Catalogue/new'),
	
);
?>

<section class="mod pt2" id="indexCatalogue">
	<div class="center mw960p">	
		<?php if(count($newCata) > 0) : ?>
		<section id="newCatalogue">
			<h3 class="mb2 mr3">Nouveautés</h3>
			<?php foreach ($newCata as $cata) : ?>
				<?php  $this->renderPartial('_viewNew', array('cata'=>$cata)); ?>
			<?php endforeach; ?>
		<section>
		<?php endif; ?>

	</div>

</section>