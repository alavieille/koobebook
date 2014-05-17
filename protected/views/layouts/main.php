<!doctype html>
<html lang="fr">
	<head>
			<meta charset="UTF-8">
			<title><?php echo CHtml::encode($this->pageTitle); ?></title>
			<link rel="shortcut icon" href="<?php echo yii::app()->baseUrl; ?>/images/favicon.ico" type="image/x-icon" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			
			<?php 
				// style
				Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/form.css');
				Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/knacss.css');
				Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/style.css');
				
				//js
				Yii::app()->clientScript->registerCoreScript('jquery');
				Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/site.js',CClientScript::POS_END);
				
				Yii::app()->clientScript->registerScript('helpers', '                                                           
		          yii = {                                                                                                     
		              urls: {                                                                                                 
		                  saveEdits: '.CJSON::encode(Yii::app()->createUrl('edit/save')).',                                   
		                  base: '.CJSON::encode(Yii::app()->baseUrl).'                                                        
		              }                                                                                                       
		          };                                                                                                          
		      ',CClientScript::POS_HEAD); 
				

			?>
		
	</head>
	<body>
		<header id="header" class="line pa1 " role="banner">
			<div class="pageCenter">
				<nav id="userNav" class="right mr3">
					<?php 

					$this->widget('zii.widgets.CMenu',array(
						'items'=>array(
							array('label'=>'Connexion', 'url'=>array('/site/login'), 'itemOptions'=>array("class"=>"small-hidden"), 'visible'=>Yii::app()->user->isGuest),
							array('label'=>'Mon compte', 'url'=>array('/library/'), 'itemOptions'=>array("class"=>"small-hidden"), 'visible'=>!Yii::app()->user->isGuest,"linkOptions"=>array("class"=>"linkVisible")),

							array('label'=>'Deconnexion', 'url'=>array('/site/logout'), 'itemOptions'=>array("class"=>"small-hidden"), 'visible'=>!Yii::app()->user->isGuest),

							array('label'=>'Inscription', 'url'=>array('/user/create'), 'itemOptions'=>array("class"=>"small-hidden"), 'visible'=>Yii::app()->user->isGuest,"linkOptions"=>array("class"=>"linkVisible"))
						),
						'itemCssClass' => "inbl pr2",
					));
					?>
				</nav>
				<div class="clearfix">&nbsp;</div>
				<h1 class="left ml1 mt0 txtcenter small-w100" id="logo" ><a href="<?php echo Yii::app()->request->baseUrl; ?>" class="logo inbl">koob<span>ebook</span></a></h1>
				
			
				<!-- ========== compact navigation =========== !-->
				<nav id="compactNav" class="grid desktop-hidden small-w100 mt2">
					<ul class="grid2">
						<li id="showMenu" class=" inbl small-w50 ">menu</li>
						<li id="showSearch" class="inbl small-w50"><a class='inbl' href="<?php echo $this->createUrl('/search/') ?>">rechercher</a></li>
					</ul>
				</nav>
		

				<nav id="siteNav" class="right mr3 bigger small-w100 txtcenter" role="navigation">
				

					<?php $this->widget('zii.widgets.CMenu',array(
					'items'=>array(
							array('label'=>'Connexion', 'url'=>array('/site/login'), 'itemOptions'=>array("class"=>"desktop-hidden"), 'visible'=>Yii::app()->user->isGuest),
							array('label'=>'Mon compte', 'url'=>array('/library/' . yii::app()->user->id ), 'visible'=>!Yii::app()->user->isGuest, 'itemOptions'=>array("class"=>"desktop-hidden"), "linkOptions"=>array("class"=>"linkVisible")),
							array('label'=>'Deconnexion', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest, 'itemOptions'=>array("class"=>"desktop-hidden")),
							array('label'=>'Inscription', 'url'=>array('/user/create'), 'visible'=>Yii::app()->user->isGuest, 'itemOptions'=>array("class"=>"desktop-hidden"), "linkOptions"=>array("class"=>"linkVisible")),
						array('label'=>'Éditeurs', 'url'=>array('/catalogue/index' )),
						array('label'=>'Aide', 'url'=>array('/site/help' )),
						array('label'=>'Rechercher', 'url'=>array('/search/'), "itemOptions"=>array("class"=>"small-hidden linkSearch")),
						),
					'itemCssClass' => "inbl pr2 small-w100",

					)); ?>
		
				</nav>
			</div>

		</header>

		<div id="main" role="main" class="line">
		<?php if(count($this->breadcrumbs) > 0): ?>
			<div id="breadcrumb" class="line pt2">
		 		<?php 
				    if ( Yii::app()->controller->route !== 'site/index' )
				        $this->breadcrumbs = array_merge(array (Yii::t('zii','Home')=>Yii::app()->homeUrl), $this->breadcrumbs);
				 
				    $this->widget('zii.widgets.CBreadcrumbs', array(
				        'links'=>$this->breadcrumbs,
				        'homeLink'=>false,
				        'tagName'=>'ul',
				        'separator'=>'/',
				        'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
				        'inactiveLinkTemplate'=>'<li><span>{label}</span></li>',
				        'htmlOptions'=>array ('class'=>'mw960p center pl0')
				    )); ?><!-- breadcrumbs -->
			</div>
		 <?php endif; ?>
		
			<?php echo $content; ?>

		</div>
	</body>
</hmtl>
