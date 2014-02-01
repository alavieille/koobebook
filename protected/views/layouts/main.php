<!doctype html>
<html lang="fr">
	<head>
			<meta charset="UTF-8">
			<title><?php echo CHtml::encode($this->pageTitle); ?></title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/knacss.css" media="all">
			<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" media="all"> 		
			<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" media="all"> 
	</head>
	<body>
		<header id="header" class="line pa1 " role="banner">
			<div class="pageCenter">
				<nav id="userNav" class="right mr3">
					<?php 

					$this->widget('zii.widgets.CMenu',array(
						'items'=>array(
							array('label'=>'Connexion', 'url'=>array('/site/login'), 'itemOptions'=>array("class"=>"small-hidden"), 'visible'=>Yii::app()->user->isGuest),
							array('label'=>'Mon compte', 'url'=>array('/user/view/' . yii::app()->user->id ), 'itemOptions'=>array("class"=>"small-hidden"), 'visible'=>!Yii::app()->user->isGuest,"linkOptions"=>array("class"=>"linkVisible")),

							array('label'=>'Deconnexion', 'url'=>array('/site/logout'), 'itemOptions'=>array("class"=>"small-hidden"), 'visible'=>!Yii::app()->user->isGuest),

							array('label'=>'Inscription', 'url'=>array('/user/create'), 'itemOptions'=>array("class"=>"small-hidden"), 'visible'=>Yii::app()->user->isGuest,"linkOptions"=>array("class"=>"linkVisible"))
						),
						'itemCssClass' => "inbl pr2",
					));
					?>
				</nav>
				<div class="clearfix">&nbsp;</div>
				<h1 class="left ml1 mt0 txtcenter small-w100" id="logo" ><a href="<?php echo Yii::app()->request->baseUrl; ?>" class="logo inbl">e<span>Librairie</span></a></h1>
				
			
				<!-- ========== compact navigation =========== !-->
				<nav id="compactNav" class="grid desktop-hidden small-w100 mt2">
					<ul class="grid2">
						<li id="showMenu" class=" inbl small-w50 ">menu</li>
						<li id="showSearch" class="inbl small-w50">recherche</li>
					</ul>
				</nav>
		

				<nav id="siteNav" class="right mr3 bigger small-w100 txtcenter" role="navigation">
				

					<?php $this->widget('zii.widgets.CMenu',array(
					'items'=>array(
							array('label'=>'Connexion', 'url'=>array('/site/login'), 'itemOptions'=>array("class"=>"desktop-hidden"), 'visible'=>Yii::app()->user->isGuest),
							array('label'=>'Mon compte', 'url'=>array('/user/view/' . yii::app()->user->id ), 'visible'=>!Yii::app()->user->isGuest, 'itemOptions'=>array("class"=>"desktop-hidden"), "linkOptions"=>array("class"=>"linkVisible")),
							array('label'=>'Deconnexion', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest, 'itemOptions'=>array("class"=>"desktop-hidden")),
							array('label'=>'Inscription', 'url'=>array('/user/create'), 'visible'=>Yii::app()->user->isGuest, 'itemOptions'=>array("class"=>"desktop-hidden"), "linkOptions"=>array("class"=>"linkVisible")),
						array('label'=>'Catalogues', 'url'=>array('/site/index' )),
						array('label'=>'Aide', 'url'=>array('/site/index' )),
						),
					'itemCssClass' => "inbl pr2 small-w100",

					)); ?>
		
				</nav>
			</div>

		</header>

		<div id="main" role="main" class="line pageCenter  pa1">
			<?php echo $content; ?>

		</div>
	</body>
</hmtl>
