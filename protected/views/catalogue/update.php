<?php
/* @var $this CatalogueController */
/* @var $model Catalogue */
$this->pageTitle=Yii::app()->name . ' - Mise a jour';

?>
<h2 class="pt2 mb3">Mise à jour</h2>
<nav class="center mw960p mb2">
		<?php 
			$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Voir mon catalogue', 'url'=>array('/catalogue/view/'.$model->id),'linkOptions'=>array("class"=>"linkButton")),
				),
				'itemCssClass' => "pb1 inbl",
				'htmlOptions' => array("class" => 'pl0')
			));
		?>
</nav>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<h2 class="pt2 pb1">Suppression</h2>
<p class="txtcenter h6-like pb3">
	<a href="<?php echo $this->createUrl('catalogue/delete/'.$model->id); ?>">Supprimer mon catalogue</a>	
</p>