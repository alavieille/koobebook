<!doctype html>
<html lang="fr">
	<head>
			<meta charset="UTF-8">
			<title><?php echo CHtml::encode($this->pageTitle); ?></title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/knacss.css" media="all">
			<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" media="all"> 
	</head>
	<body>
		<header id="header" class="line pa1 " role="banner">
			<div class="center">
				<h1 class="left ml1 txtcenter small-w100" id="logo" ><a href="<?php echo Yii::app()->request->baseUrl; ?>" class="logo inbl">Lib<span>ebook</span></a></h1>
				
				<!-- ========== compact navigation =========== !-->
				<nav id="compactNav" class="grid desktop-hidden small-w100 mt2">
					<ul class="grid2">
						<li id="showMenu" class=" inbl small-w50 ">menu</li>
						<li id="showSearch" class="inbl small-w50">recherche</li>
					</ul>
				</nav>
		

				<nav id="navigation" class="right mr3 bigger small-w100 txtcenter " role="navigation">
					<?php $this->widget('zii.widgets.CMenu',array(
					'items'=>array(
						array('label'=>'Catalogues', 'url'=>array('/site/index' )),
						array('label'=>'Aide', 'url'=>array('/site/index' )),
						),
					'itemCssClass' => "inbl pr2 small-w100",

					)); ?>
				</nav>

			</div>

		</header>

		<div id="main" role="main" class="line center">
			<?php echo $content; ?>

		</div>
	</body>
</hmtl>
