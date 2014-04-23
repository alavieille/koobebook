<h2 class="txtcenter pt0 pb0">Éditeurs</h2>

<section class="mod" id="indexCatalogue">
	<div class="center mw960p">	
		<?php if(count($newCata) > 0) : ?>
		<section class="pt2" id="newCatalogue">
			<h3 class="w100 mb2 mr3 pl1">
				<a class="icon icon-bracket2 after" href="<?php echo Yii::app()->createUrl('catalogue/new/');  ?>">Nouveaux éditeurs</a>
			</h3>
			<?php foreach ($newCata as $cata) : ?>
				<?php  $this->renderPartial('//catalogue/_viewNew', array('cata'=>$cata)); ?>
			<?php endforeach; ?>
		<section>
		<?php endif; ?>
	</div>


<?php if(isset($randCata)) : ?>
	<section id="discoverCatalogue" class="pa2 catalogue">
		<div class="center mw960p">
			<h3 class="w100 mb2 mr3 pl1">Découvrir un éditeur</h3>
			<?php  $this->renderPartial('//catalogue/_viewDiscover', array('cata'=>$randCata)); ?>
		</div>
	</section>
<?php endif; ?>

<?php if(isset($topBook)) : ?>
	<div class="center mw960p">	
		<?php if(count($topBook) > 0) : ?>
		<section id="topDownload">
			<h3 class="w100 mb2 mr3 pl1">
				<a class=" icon icon-bracket2 after" href="<?php echo Yii::app()->createUrl('book/topDownload/');  ?>">Top téléchargement</a>
			</h3>
			<div class="autogrid5 catalogue">
				
			<?php foreach ($topBook as $book) : ?>
				<?php  $this->renderPartial('//book/_viewBookCatalogue', array('book'=>$book)); ?>
			<?php endforeach; ?>
			</div>
		<section>
		<?php endif; ?>
	</div>

<?php endif; ?>
	

</section>