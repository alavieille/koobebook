<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<nav class="w25 mt3 pr2 pl3 mb1 mr3 left small-w100" id="privateNav">
	<h3 class="">Compte</h3>
	<?php 
		$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Modifier', 'url'=>array('/user/update')),
				array('label'=>'Supprimer', 'url'=>array('/user/delete/'.yii::app()->user->id)),
			),
			'itemCssClass' => "txtcenter pb1",
		));
	?>
	<h3 class="">Bibliothéque</h3>
		<ul>
			<li><a href="">Voir ma biliothéque</a></li>
		</ul>
	<h3 class="">Catalogue</h3>
	<?php 
		$catalogueUser = Catalogue::model()->findByAttributes(array('userId'=>yii::app()->user->id));
		$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Créer', 'url'=>array('/catalogue/create'),'visible'=>!isset($catalogueUser)),
				array('label'=>'Modifier', 'url'=>array('/catalogue/update/'),'visible'=>isset($catalogueUser)),
				array('label' =>'Ajouter Livre', 'url'=>array('book/create/')),
			),
			'itemCssClass' => "txtcenter pb1",
		));
	?>
<!-- 	<ul>
			<li><a href="">Créer mon catalogue</a></li>
			<li><a href="">Voir mon catalogue</a></li>
			<li><a href="">Personaliser mon catalogue</a></li>
		</ul> -->
</nav>

<section id="content" class="w70 mod small-w100">
	<?php echo $content; ?>
</section>

<?php $this->endContent(); ?>