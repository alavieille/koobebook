<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<p id="privateMenu" class="small-visible desktop-hidden pa1 h5-like txtcenter icon-down">Menu</p>

<nav class="w25 mt3 pr2 pl3 mb1 mr3 left small-no-float small-inbl " id="privateNav">
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
	<!-- <h3 class="">Bibliothèque</h3>
		<ul>
			<li><a href="">Voir ma biliothèque</a></li>
		</ul> -->
	<h3 class="">Catalogue</h3>
	<?php 
		$catalogueUser = Catalogue::model()->findByAttributes(array('userId'=>yii::app()->user->id));
		$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Créer', 'url'=>array('/catalogue/create'),'visible'=>!isset($catalogueUser)),
				array('label'=>'Gérer', 'url'=>array('/catalogue/manage/'),'visible'=>isset($catalogueUser)),
				array('label'=>'Paramètres', 'url'=>array('/catalogue/update/'),'visible'=>isset($catalogueUser)),
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