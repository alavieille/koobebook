<?php
/* @var $this CatalogueController */

$this->pageTitle=Yii::app()->name . ' - Tableau de bord';

?>

<section>
	<h2 class="pt2 mb3">Tableau de bord</h2>
	<nav>
		<?php 
			$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Afficher les livres payants', 'url'=>array('/catalogue/monitoring','type'=>'buy'),'visible'=>($type != 'buy')),
					array('label'=>'Afficher les livres gratuits', 'url'=>array('/catalogue/monitoring','type'=>'free'),'visible'=>($type == 'buy')),
				),
				'itemCssClass' => "pb2 inbl",
				'htmlOptions' => array("class" => 'pl0 left')
			));
		?>
	</nav>
	<table class="striped  data table" summary="">
		<thead>
			<tr>
				<th scope="col" class="txtcenter">Titre</th>
				<th scope="col" class="txtcenter">Prix</th>
				<th scope="col" class="txtcenter">Téléchargement</th>
			</tr>

		</thead>
	
		<tbody>
			<tr>
				<td class="txtcenter ">Total</td>
				<td class="txtcenter" ><?php echo $totalPrice ?> &euro;</td>
				<td class="txtcenter"><?php echo $totalDownload ?></td>
			</tr>
			<?php foreach ($monitoring as $book) : ?>
			<tr>
				<td><?php echo $book->title ?></td>
				<td class="txtcenter" ><?php echo $book->price ?> &euro;</td>
				<?php if($type == 'buy') : ?>
					<td class="txtcenter"><?php echo $book->paymentCount ?></td>
				<?php else : ?>
					<td class="txtcenter"><?php echo $book->libraryCount ?></td>
				<?php endif; ?>
			</tr>

			<?php endforeach; ?>
		</tbody>
	</table>

</section>