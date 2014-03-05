<?php
/* @var $this CatalogueController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle=Yii::app()->name."- Catalogues" ;	

?>


<section class="center mt2 mod mw960p" id="indexCatalogue">
	
<h2 class="txtcenter pt2">Catalogues</h2>

<?php if(count($newCata) > 0) : ?>
	<section id="newCatalogue">
		<h3 class="mb2 ml3 mr3">Nouveautés</h3>
		<?php foreach ($newCata as $cata) : ?>
			<section class="pa2 pt0 pb1">
				<a  class="knacss-debug block" href="<?php echo Yii::app()->createUrl('catalogue/view/',array( 'id'=>$cata["catalogue"]->id)); ?> ">
					<a  class="icon icon-bracket2 after" href="<?php echo Yii::app()->createUrl('catalogue/view/',array( 'id'=>$cata["catalogue"]->id)); ?> ">
					<h4 class="name inbl pr2"><?php echo ucfirst($cata["catalogue"]->name) ?></h4>
					Découvrir le catalogue</a>
					<div class=" mt2 center autogrid5 mb0 line">
					<?php foreach ($cata["books"] as $book) : ?>
						<?php  $this->renderPartial('_viewBook', array('book'=>$book)); ?>
					<?php endforeach; ?>
					</div>
				</a>
			</section>
		<?php endforeach; ?>
	<section>
<?php endif; ?>


<?php if(isset($randCata)) : ?>
	<h3 class="mb2 ml3 mr3">À découvrir</h3>
	<section id="discoverCatalogue" class="pa2">
	<a href="<?php echo Yii::app()->createUrl('catalogue/view/',array( 'id'=>$randCata->id)); ?> ">
		<h4 class="name inbl">
		<?php echo ucfirst($randCata->name) ?>
		</h4>
		<a  class="ml2 inbl icon icon-bracket2 after" href="<?php echo Yii::app()->createUrl('catalogue/view/',array( 'id'=>$randCata->id)); ?> ">Découvrir le catalogue</a>
		<p class="description mt1 mb3"><?php echo $randCata->getExcerptDescription(400) ?></p>
	</a>
		<div class=" center autogrid5 mb0 books small-hidden">
			<?php foreach (array_slice($randCata->books, 0 , 5) as $book) {
				$this->renderPartial('_viewBook', array('book'=>$book));
			} ?>
		</div>
	</section>
<?php endif; ?>


</section>
