<div id="help" class="pageCenter pa1">
<?php $this->renderPartial('_navHelp'); ?>
<div id="contentHelp" class="mt3 pl2 mb3">
		
	<section id="presHelp">
		<h3>Présentation</h3>
		<p><span class="logo">koob<span>ebook</span></span> est une plate-forme de diffusion et de vente de livre numérique de différents <a href="#format"> formats</a>. Elle a pour principale objectif de mettre en avant les petits éditeurs et les auteurs qui s'auto-édite</p>
	</section>
	<section id="compte">
		<h3>Compte utilisateur</h3>
		<p>La création d'un compte est requis pour certaines opérations sur la plate-forme telle que <a href="#achat">l'achat</a> d'un livre ou encore la <a href="#editor">diffusion ou la vente</a> d'un de vos livres. Il apporte aussi d'autre avantage tel que la sauvegarde des différents livre gratuit que vous aurez téléchargé.</p>
		<h5>Comment créer un compte ? </h5>
		<p>1. Cliquez sur le lien <b>Inscription</b> en haut à droite du site.</p>
		<img class="ma2" src="<?php echo Yii::app()->request->baseUrl; ?>/images/help/inscription.png" alt="Lien d'inscription">
		<p>2. Remplissez les différentes informations (Email, Mot de passe) .</p>
		<p>3. Valider votre inscription, vous serez automatiquement connecté.</p>
		<p>Si vous rencontrez un erreur quelconque lors de cette procédure, veuillez <a href="#contact">contacter</a> l'administrateur du site.</p>
	</section>
	<section id="lecteur">
		<h3>Lecteur</h3>
		<h4 id="download">Télécharger un livre</h4>
		<p>Il existe deux types de livre, les livres gratuits et les livres payants.</p>
		<h5>Livres gratuits</h5>
		<p>Par exemple, si vous desirez acquerir <b>20000 lieues sous les mers</b> qui est un livre gratuit, il vous suffit de vous rendre sur la page du livre et du cliquer sur le bouton <b>Télécharger</b> (1).</p> 
		<p>Si le livre est disponible en plusieurs <a href="#format">formats</a>, vous pouvez choisir le format que vous desirez téléchargé en cliquant sur la liste déroulante à côté du bouton <b>Télécharger</b> (2).</p>
		<img class="ma2" src="<?php echo Yii::app()->request->baseUrl; ?>/images/help/download.png" alt="Lien de téléchargement d'un ebook">
		<p>Nb : Vous ne devez pas être obligatoirement connecté pour télécharger un livre gratuit. Mais si vous êtes connecté, le livre sera automatiquement ajouté à votre <a href="#bibliothèque">bibliothèque</a>.</p>
		<h5>Livres payants</h5>
		<h4 id="library">Bibliothèque</h4>
		<p>La bibliothèque contient tous les livres pour avez téléchargés / achetés.</p>
		<p>Pour accéder à votre bibliothèque, vous devez être connecté.</p>
		<p>Une fois connecté, cliquez sur le lien <b>Mon compte</b> en haut à droite du site et vous serez redirigez directement sur votre bibliothèque, si ce n'est pas le cas cliquez sur le lien <b>Ma bibliothèque</b> dans le menu gauche de votre compte.</p>
	</section>
	<section id="editor">
		<h3>Éditeur/Auteur</h3>
		<p>Si vous êtes un éditeur ou un auteur qui désire publier un livre, il vous faut dans un premier temps créer un <a href="#compte">compte</a> et vous connecter.</p>
		<p>Tous les livres numériques que vous désirez diffusés sont regroupés dans un catalogue.</p>
		<p>Si vous n'avez pas encore crée un catalogue, il vous faut donc en créer un pour pouvoir diffuser un livre.</p>
		<h4 id="createCata">Créer son catalogue</h4>
		<p>1. Connectez vous.</p>
		<p>2. Acceder à votre compte (lien en haut à droite).</p>
		<p>3. Cliquez sur <b>Créer</b> dans le sous-menu <b>Catalogue</b> du menu de gauche.</p>
		<img class="ma2" src="<?php echo Yii::app()->request->baseUrl; ?>/images/help/catalogue.png" alt="Lien de création d'un catalogue">
		<p>4. Entrez un nom d'édtion puis cliquez sur <b>Créer</b>.</p>
		<p>5. Vous pouvez modifier le nom de votre catalogue et sa description dans le menu <b>paramètres</b>.</p>
		<h4 id="publish">Ajouter un livre à son catalogue</h4>
		<p>1. Cliquez sur <b>Gérer</b> dans le menu de votre compte</p>
		<p>2. Cliquez sur le bouton <b>Ajouter un livre</b>.</p>
		<p>L'ajout d'un livre se déroule en deux étapes :</p>
		<p>Etape 1 : Ajouter les differents fichiers (epub, mobi, pdf) du livre numérique puis cliquer sur le bouton <b>étape suivante</b>.</p>
		<p>Etape 2 : Compléter les informations du livres (titre, description, auteurs, prix, langue, etc).</p>
		<p>Rmq : Lors de l'étape 2 des informations peuvent déjà être remplis, celle-ci ont été extraite à partir des fichiers envoyé dans l'étape 1.</p>
		<p>Une fois ces deux étapes terminées, cliquez sur le bouton <b>Ajouter</b> en bas de la page.</p>
		
		<h4 id="manageCata">Gérer son catalogue</h4>
		<p>Pour gèrer votre catalogue, il vous suffit de vous connecter et de cliquer sur le lien <b>Gèrer</b> dans le menu gauche de votre compte.</p>
		<p>Vous accederez alors à la page de gestion de votre catalogue.</p>
		<p class="mt3">Pour gèrer votre catalogue, il existe deux modes d'affichage, l'affichage sous forme de liste et sous forme de grille.</p>
		<p>Pour changer le mode d'affichage, cliquez sur un des deux boutons en haut à droite.</p>
		<img class="ma2" src="<?php echo Yii::app()->request->baseUrl; ?>/images/help/displayManage.png" alt="Bouton pour changer l'affichage">
		
		<p class="mt3">Depuis ce panneau de gestion vous avez accés à differentes actions :</p>
		<p>1. Ajouter un livre.</p>
		<p>2. Supprimer un livre.</p>
		<p>3. Mettre à jour un livre.</p>
		<p>4. Mettre en avant un livre. Si vous mettez un livre en avant, celui-ci sera mise en avant lors de l'affichage de votre catalogue.</br>
		Rmq: Vous ne pouvez mettre en avant que 5 livres.
		</p>


		<h4 id="delete">Supprimer</h4>
		<p>Vous pouvez à tous moment decidé de supprimer votre catalogue en allant dans le menu <b>Paramètres</b> de votre compte.</p>
		<p>Attention toutefois les livres de votre catalogue, ne seront pas supprimer de la plate-forme, ils seront juste détaché de votre compte.</p>
		<p>Ainsi les utilisateurs qui ont téléchargé ou achété un de vos livres auront toujours accès à ces derniers, il en est de même lorsque vous supprimez un livre de votre catalogue.</p>
	</section>
	<section id="format">
		<h3>Formats</h3>
		<p>La palte-forme support trois formats :</p>
		<p>1. EPUB</p>
		<p>2. MOBI</p>
		<p>2. PDF</p>
	</section>
	<section  id="opds">
		<h3>OPDS</h3>
		<p>La plate-forme supporte le standard OPDS. Le standard OPDS permet de naviguer et obtenir les livres d'un éditeur depuis une application de lecture</p>
		<p>Applications qui supporte le standard OPDS (liste non exhaustive) : </p>
		<ul>
			<li>Aldiko (Android)</li>
			<li>Readmill (Android, IOS)</li>
			<li>Mantano Reader (Android, IOS)</li>
			<li>FB Reader (Android)</li>
			<li>Moon + (Android)</li>
		</ul>
		<p>Pour importer un catalogue d'un éditeur dans votre application de lecture.</p>
		<p>Il vous suffit de vous rendre sur la page d'un éditeur et de cliquer sur le lien <b>Exporter au format opds</b>.</p>
		<p>Pour plus d'informations sur le standard opds : <a href="http://opds-spec.org/">Spécification OPDS.</a></p>
	</section>
	<section id="contact">
		<h3>Contact</h3>
		<p>Pour toutes questions ou problèmes rencontrés sur la plate-forme, vous pouvez contacter l'administrateur en cliquant sur ce lien.</p>
		<p><a class="txtcenter" href="mailto:<?php echo Yii::app()->params['adminEmail'] ?>">Contacter l'administrateur</a></p>
	</section>
	</div>
</div>