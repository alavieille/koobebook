<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<nav class="w25 mt3 pr2 pl3 mb1 mr3 left small-w100" id="privateNav">
	<h3 class="small-hidden">Profil</h3>
	<?php 
		$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Mon profil', 'url'=>array('/user/view/'.yii::app()->user->id)),
				array('label'=>'Modifier', 'url'=>array('/user/update')),
				array('label'=>'Supprimer', 'url'=>array('/user/delete')),
			),
			'itemCssClass' => "txtcenter pb1",
		));
	?>
	<h3 class="small-hidden">Bibliothéque</h3>
		<ul>
			<li><a href="">Voir ma biliothéque</a></li>
		</ul>
	<h3 class="small-hidden">Boutique</h3>
	<ul>
			<li><a href="">Voir ma boutique</a></li>
			<li><a href="">Personaliser ma boutique</a></li>
		</ul>
</nav>

<section id="content" class="w70 mod small-w100">
	<?php echo $content; ?>
</section>

<?php $this->endContent(); ?>