<?php if(Yii::app()->user->hasFlash('success')):?>
		<div class="txtcenter flashsuccess  pa1 mb2 small-w100 w80 center mw960p">
		     <?php echo Yii::app()->user->getFlash('success'); ?>
		</div>		    
<?php elseif(Yii::app()->user->hasFlash('error')):?>
		<div class="txtcenter flasherror  pa1 mb2 small-w100 w80 center mw960p">
		    <?php echo Yii::app()->user->getFlash('error'); ?>
		</div>		
<?php elseif(Yii::app()->user->hasFlash('notice')):?>
		<div class="txtcenter flashnotice  pa1 mb2 small-w100 w80 center mw960p">
		    <?php echo Yii::app()->user->getFlash('notice'); ?>
		 </div>
<?php endif; ?>
<section id="presentation" class="line pt1">
	<div class="pageCenter pa1">
		<h2 class="logo txtcenter">koob<span>ebook</span></h2>
		<p class="txtcenter biggest mt0">Votre librairie Numérique</p>
		<div class="grid">
			<div class="grid3 mt2">
				<figure class="small-w100">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/publier.png" alt="">
					<figcaption>
						<h3 class="txtcenter">Publier</h3>
						<!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. orbi ultricies dapibus odio at cursus. Aliquam vulputate lectus et aliquet malesuada. Maecenas sollicitudin ut justo eu bibendum. Mauris sodales quam non dui </p> -->
						<p class="txtcenter big">Vous êtes un auteur ou un éditeur, publiez vos livres gratuitement.</p>
					</figcaption>
				</figure>
				<figure class="small-w100 txtcenter">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/consulter.png" alt="">
					<figcaption>
						<h3  class="txtcenter" >Consulter</h3>
						<!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ante risus, pellentesque vitae vestibulum vitae, bibendum vel sem. Morbi ultricies dapibus odio at cursus.</p> -->
						<p class="txtcenter big" >Consulter et acheter les nombreux livres disponible sur le site.</p>
					</figcaption>
				</figure>
				<figure class="small-w100" >
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/lire.png" alt="">
					<figcaption>
						<h3  class="txtcenter" >Lire</h3>
						<!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ante risus, pellentesque vitae vestibulum vitae, bibendum vel sem. Morbi ultricies dapibus odio at cursus.</p> -->
						<p class="txtcenter big">Depuis votre tablette et votre smartphone consultez, téléchargez, lisez les livres de la plate-forme .</p>
					</figcaption>

				</figure>
			</div>
		</div>
	</div>
</section>
	<?php  $this->renderPartial('//catalogue/_viewIndex', array('newCata'=>$newCata,'randCata'=>$randCata,'topBook'=>$topBook)); ?>