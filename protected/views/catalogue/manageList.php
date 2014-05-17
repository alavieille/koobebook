<?php
/* @var $this CatalogueController */
/* @var $books list of books who isn't push*/
/* @var $pushBooks list of books whi is push */

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/catalogue.js',CClientScript::POS_END);
$this->pageTitle=Yii::app()->name . ' - Gérer';

?>

<h2 class="pt2 pb1 txtcenter">Gérer</h2>

    <div class="txtcenter flasherror pa1 mt1 mb2 small-w100 w80 center mw960p">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
	<nav class="mt1 mb2 mod">
		<?php 
			$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Voir mon catalogue', 'url'=>array('/catalogue/view/'.$catalogue->id),'linkOptions'=>array("class"=>"linkButton")),
				),
				'itemCssClass' => "mt1 pb1 inbl",
				'htmlOptions' => array("class" => 'left pl1')
			));
		?>
		<?php 
			$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Affichage en liste', 'url'=>array('/catalogue/manage',"display"=>"list"),'linkOptions'=>array("class"=>"list mr2","title"=>"Affichage en liste"),
						'active'=>$display=='list'),
					array('label'=>'Affichage en grille', 'url'=>array('/catalogue/manage',"display"=>"grid"),'linkOptions'=>array("class"=>"grid","title"=>"Affichage en grille")),
				),
				'itemCssClass' => "pb1 inbl",
				'htmlOptions' => array("class" => 'pl1 right display-'.$display, "id"=>"displayManage")
			));
		?>
	</nav>

<section id="pushBook" class="list w100 pa1 mb3">
	<h4 class="pb1 mb1 w100">Ebooks à la une</h4>

	<?php if(count($pushBooks) == 0 ) : ?>
		<div id="dropInfo">
			<p class="big txtcenter ">Ebooks mis en avant</p>
			<p class="txtcenter italic"> Ajouter un livre à la une, depuis le menu options</p>

		</div>
	<?php else : ?>
		<table class="striped  data table" summary="">
		<thead>
		<tr>
				<th scope="col" class="txtcenter">Titre</th>
				<th scope="col" class="txtcenter">Auteur</th>
				<th scope="col" class="txtcenter">Prix</th>
				<th scope="col" class="txtcenter w150p">Options</th>
			</tr>

		</thead>
	
		<tbody>
			<?php foreach ($pushBooks as $book) :?>
			<tr>
				<td><a href="<?php echo Yii::app()->createUrl('book/view/',array( 'id'=>$book->id)); ?> "  ><?php echo $book->title;?></a></td>
				<td class="txtcenter" >
					<?php foreach ($book->contributors as $contributor) : ?>
						<?php if($contributor->type == 'author') : ?>
						<a href="<?php echo Yii::app()->createUrl('search/search/',array('type'=>'author','query'=>$contributor->name));  ?>" ><?php echo $contributor->name; ?></a></br>
						<?php endif; ?>
					<?php endforeach ?>
				</td>
				<td class="txtcenter" ><?php echo $book->price ?> &euro;</td>
				<td class="options">
					<a href="<?php echo Yii::app()->createUrl('book/togglePush/',array( 'id'=>$book->id));; ?>" class="push tiny-no-float right" title="Mise à la une">Mise à la une</a>
					<a href="<?php echo Yii::app()->createUrl('book/update/',array( 'id'=>$book->id)); ?>" class="right tiny-no-float edit" title="Modifier">Modifier</a>

					<a href="<?php echo Yii::app()->createUrl('book/delete/',array( 'id'=>$book->id)); ?>" class="right tiny-no-float delete" title="Supprimer">Supprimer</a>

				</td>

				<!-- <td class="txtcenter"><?php echo $book->libraryCount ?></td> -->
			</tr>

			<?php endforeach; ?>
		</tbody>
	</table>

	<?php endif; ?>
</section>
<section id="ltBook" class="list w100 pa1">
	<h4 class="pb1 w100">Vos ebooks</h4>
	<?php 
			$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Ajouter un livre', 'url'=>array('/book/create/'),'linkOptions'=>array("class"=>"linkButton")),
				),
				'itemCssClass' => "pb3 inbl",
				'htmlOptions' => array("class" => 'left pl1')
			));
		?>
		<table class="striped  data table" summary="">
			<thead>
			<tr>
					<th scope="col" class="txtcenter">Titre</th>
					<th scope="col" class="txtcenter">Auteur</th>
					<th scope="col" class="txtcenter">Prix</th>
					<th scope="col" class="txtcenter w150p">Options</th>
				</tr>

			</thead>
		
		<tbody>
			<?php foreach ($books as $book) :?>
			<tr>
					<td><a href="<?php echo Yii::app()->createUrl('book/view/',array( 'id'=>$book->id)); ?> "  ><?php echo $book->title;?></a></td>
				<td class="txtcenter" >
					<?php foreach ($book->contributors as $contributor) : ?>
						<?php if($contributor->type == 'author') : ?>
							<a href="<?php echo Yii::app()->createUrl('search/search/',array('type'=>'author','query'=>$contributor->name));  ?>" ><?php echo $contributor->name; ?></a></br>
						<?php endif; ?>
					<?php endforeach ?>
				</td>
				<td class="txtcenter" ><?php echo $book->price ?> &euro;</td>
				<td class="options">
					<a href="<?php echo Yii::app()->createUrl('book/togglePush/',array( 'id'=>$book->id));; ?>" class="push tiny-no-float  right" title="Mise à la une">Mise à la une</a>
					<a href="<?php echo Yii::app()->createUrl('book/update/',array( 'id'=>$book->id)); ?>" class="edit tiny-no-float  right" title="Modifier">Modifier</a>

					<a href="<?php echo Yii::app()->createUrl('book/delete/',array( 'id'=>$book->id)); ?>" class="delete tiny-no-float  right" title="Supprimer">Supprimer</a>

				</td>

				<!-- <td class="txtcenter"><?php echo $book->libraryCount ?></td> -->
			</tr>

			<?php endforeach; ?>
		</tbody>
	</table>
</section>
