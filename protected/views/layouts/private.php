<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); 
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/private.css');

?>
<div id="private" class=" pt0 mod">
	<p id="privateMenu" class="small-visible desktop-hidden pa1 h5-like txtcenter icon-down">Menu</p>
	<nav class=" mt0 pt1  mb1 left small-no-float small-inbl " id="privateNav">
		<h3 class="pl2">Compte</h3>
		<?php 
			$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Modifier', 'url'=>array('/user/update')),
					array('label'=>'Supprimer', 'url'=>array('/user/delete/'.yii::app()->user->id)),
				),
			));
		?>
		<h3 class="pl2 mt3 pt2">Bibliothèque</h3>
			<?php 
				$this->widget('zii.widgets.CMenu',array(
					'items'=>array(
						array('label'=>'Ma Bibliothèque', 'url'=>array('/library/view')),
					),
				));
			?>
		<h3 class="pl2 mt3 pt2">Catalogue</h3>
		<?php 
			$catalogueUser = Catalogue::model()->findByAttributes(array('userId'=>yii::app()->user->id));
			
			$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Créer', 'url'=>array('/catalogue/create'),'visible'=>!isset($catalogueUser)),
					array('label'=>'Gérer', 'url'=>array('/catalogue/manage/'),'visible'=>isset($catalogueUser)),
					array('label'=>'Tableau de bord', 'url'=>array('/catalogue/monitoring/'),'visible'=>isset($catalogueUser)),
					array('label'=>'Paramètres', 'url'=>array('/catalogue/update/'),'visible'=>isset($catalogueUser)),
				),

			));
		?>
	</nav>

	<section id="content" class="pa3  pt0 mod small-w100 ">
		<?php echo $content; ?>
	</section>
</div>
<?php $this->endContent(); ?>