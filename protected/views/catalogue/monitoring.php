<?php
/* @var $this CatalogueController */

$this->pageTitle=Yii::app()->name . ' - Tableau de bord';

?>

<section>
	<h2 class="pt2 mb3">Tableau de bord</h2>

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

				<td class="txtcenter"><?php echo $book->libraryCount ?></td>
			</tr>

			<?php endforeach; ?>
		</tbody>
	</table>

</section>