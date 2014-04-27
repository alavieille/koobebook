<?php

$this->pageTitle=Yii::app()->name."- Recherche" ;
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/personalSelect.js',CClientScript::POS_END);
$this->breadcrumbs=array(
	    'Recherche'=>array('search'),
	
);
?>

<section class=" pt2" id="indexCatalogue">
	<div class="center mw960p ">	
	
		
		<?php $this->renderPartial('_form', array('select'=>$type,'query'=>$query)); ?>
		<?php if($query != '')  :?>
		<div class="line" id="resSearch">
			<h4 class="pa1 mb3">Résultats pour " <?php echo $query; ?> " : </h4>
			<?php if(count($catalogues) <= 0 && count($books) <= 0 && count($contributors) <= 0 ) : ?>
				<p class="txtcenter">Aucun résultat</p>
			<?php endif; ?>

			<?php if(isset($catalogues)  && count($catalogues) > 0  ) :  ?>
			<?php $this->renderPartial('_searchEditor', array('catalogues'=>$catalogues,'type'=>'editor','query'=>$query)); ?>
			<?php endif; ?>

			<?php if(isset($books) && count($books) > 0 ) :  ?>
				<?php $this->renderPartial('_searchBook', array('books'=>$books,'type'=>'book','query'=>$query)); ?>
			<?php endif; ?>
			<?php if(isset($contributors) && count($contributors) > 0 ) :  ?>
				<?php $type = ($type != 'editor' && $type != 'illustrator' && $type != 'traductor' ) ?  'Contributeurs' : $type ; ?>
				<?php $this->renderPartial('_searchContributor', array('contributors'=>$contributors,'type'=>$type,'query'=>$query)); ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>

</section>