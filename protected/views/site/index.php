<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="txtcenter flashsuccess pb2">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
<section id="presentation" class="line pt1">
	<div class="pageCenter pa1">
		<h2 class="logo txtcenter">e<span>Librairie</span></h2>
		<p class="txtcenter biggest mt0">Votre librairie Numérique</p>
		<div class="grid">
			<div class="grid3 mt2">
				<figure class="small-w100">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/publier.png" alt="">
					<figcaption>
						<h3 class="txtcenter">Publier</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. orbi ultricies dapibus odio at cursus. Aliquam vulputate lectus et aliquet malesuada. Maecenas sollicitudin ut justo eu bibendum. Mauris sodales quam non dui </p>
						<!-- <p class="txtleft big">Vous êtes un auteur ou un éditeur, publiez votre catalogue gratuitement.</p> -->
					</figcaption>
				</figure>
				<figure class="small-w100 txtcenter">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/consulter.png" alt="">
					<figcaption>
						<h3  class="txtcenter" >Consulter</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ante risus, pellentesque vitae vestibulum vitae, bibendum vel sem. Morbi ultricies dapibus odio at cursus.</p>
						<!-- <p class="txtleft big" >Consulter les nombreux livres disponible sur le site.</p> -->
					</figcaption>
				</figure>
				<figure class="small-w100" >
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/lire.png" alt="">
					<figcaption>
						<h3  class="txtcenter" >Lire</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ante risus, pellentesque vitae vestibulum vitae, bibendum vel sem. Morbi ultricies dapibus odio at cursus.</p>
						<!-- <p class="txtleft big">Depuis votre tablette et votre smartphone importer ou télécharger votre bibliothéque.</p> -->
					</figcaption>
				</figure>
			</div>
		</div>
	</div>
</section>

<section class="panel">
	<div class=" mw960p center">
		<?php if(count($newCata) > 0) : ?>
			<section id="newCatalogue">
				<h3 class="mb2 ml3 mr3">Nouveautés</h3>
				<?php foreach ($newCata as $cata) : ?>
					<?php  $this->renderPartial('//catalogue/_viewNew', array('cata'=>$cata)); ?>
				<?php endforeach; ?>
			<section>
		<?php endif; ?>
	</div>

</section>

<section id="indexCataDiscover">
	<div class=" mw960p center pt1">
		<?php if(isset($randCata)) : ?>
		<h3 class="mb2 ml3 mr3">À découvrir</h3>
		<?php  $this->renderPartial('//catalogue/_viewDiscover', array('cata'=>$randCata)); ?>
		<?php endif; ?>
	</div>

</section>