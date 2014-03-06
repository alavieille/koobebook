<?php
/* @var $this CatalogueController */
/* @var $books list of books who isn't push*/
/* @var $pushBooks list of books whi is push */

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/catalogue.js',CClientScript::POS_END);
$this->pageTitle=Yii::app()->name . ' - Gérer';

?>

<h2 class="pt2 pb1 txtcenter">Gérer</h2>

    <div class="txtcenter flasherror pb2">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
	<nav class="center mw960p mb2">
		<?php 
			$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Voir mon catalogue', 'url'=>array('/catalogue/view/'.$catalogue->id),'linkOptions'=>array("class"=>"linkButton")),
				),
				'itemCssClass' => "pb1 inbl",
				'htmlOptions' => array("class" => 'pl1')
			));
		?>
	</nav>

<section id="pushBook" class="w100 pa1 mb3">
	<h4 class="pb1 mb1 w100">Ebooks à la une</h4>

	<?php if(count($pushBooks) == 0 ) : ?>
		<div id="dropInfo">
			<p class="big txtcenter ">Ebooks mis en avant</p>
			<p class="txtcenter italic"> Ajouter un livre à la une, depuis le menu contextuel</p>
			<p class="txtcenter">Ou faites un glissé-déposé du livre que vous souhaité mettre en avant</p>
		</div>
		<?php endif; ?>
		<div class="autogrid5 dropper">
			<?php foreach ($pushBooks as $book) :?>
				<?php $this->renderPartial('//book/_viewBookManage', array('book'=>$book)); ?>
			<?php endforeach; ?>
		</div>
</section>
<section id="ltBook" class="w100 pa1">
	<h4 class="pb1 mb1 w100">Vos ebooks</h4>
	<div class="autogrid5">
		<div class="ml1 mb2 mr1 mt2 tiny-w100	" id="addEbook">
			<a class="center" href="<?php echo Yii::app()->createUrl('book/create/'); ?>">

				<p id="iconAdd" class="txtcenter">+</p>
				<p class="txtcenter ma0">Ajouter un livre</p>
			</a>
		</div>
		<?php foreach ($books as $book) :?>

			<?php $this->renderPartial('//book/_viewBookManage', array('book'=>$book)); ?>
		
		<?php endforeach; ?>
	</div>
</section>
