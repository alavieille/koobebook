<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="txtcenter flashsuccess pb2">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
<section id="presentation" class="line separator pt2">
	<h2 class="logo txtcenter">Lib<span>ebook</span></h2>
	<p class="txtcenter biggest mt0">Votre librairie Numérique</p>
	<div class="grid">
		<div class="grid3 mt2">
			<figure class="small-w100">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/publier.png" alt="">
				<figcation>
					<h3 class="txtcenter">Publier</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ante risus, pellentesque vitae vestibulum vitae, bibendum vel sem. Morbi ultricies dapibus odio at cursus. Aliquam vulputate lectus et aliquet malesuada. Maecenas sollicitudin ut justo eu bibendum. Mauris sodales quam non dui blandit, nec euismod est facilisis. Sed et velit sapien. Suspendisse vitae sem blandit, pulvinar nibh eget, adipiscing justo</p>
					<!-- <p class="txtleft big">Vous êtes un auteur ou un éditeur, publiez votre catalogue gratuitement.</p> -->
				</figcation>
			</figure>
			<figure class="small-w100 txtcenter">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/consulter.png" alt="">
				<figcation>
					<h3  class="txtcenter" >Consulter</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ante risus, pellentesque vitae vestibulum vitae, bibendum vel sem. Morbi ultricies dapibus odio at cursus. Aliquam vulputate lectus et aliquet malesuada. Maecenas sollicitudin ut justo eu bibendum. Mauris sodales quam non dui blandit, nec euismod est facilisis. Sed et velit sapien. Suspendisse vitae sem blandit, pulvinar nibh eget, adipiscing justo</p>
					<!-- <p class="txtleft big" >Consulter les nombreux livres disponible sur le site.</p> -->
				</figcation>
			</figure>
			<figure class="small-w100" >
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/lire.png" alt="">
				<figcation>
					<h3  class="txtcenter" >Lire</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ante risus, pellentesque vitae vestibulum vitae, bibendum vel sem. Morbi ultricies dapibus odio at cursus. Aliquam vulputate lectus et aliquet malesuada. Maecenas sollicitudin ut justo eu bibendum. Mauris sodales quam non dui blandit, nec euismod est facilisis. Sed et velit sapien. Suspendisse vitae sem blandit, pulvinar nibh eget, adipiscing justo</p>
					<!-- <p class="txtleft big">Depuis votre tablette et votre smartphone importer ou télécharger votre bibliothéque.</p> -->
				</figcation>
			</figure>
		</div>
	</div>


</section>