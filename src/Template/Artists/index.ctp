<?php //file : src/Templates/Artists/index.ctp ?>
<p>Il y a <?= $artists->count(); ?> artiste(s)</p>

<h2>Liste</h2>
<table>
	<tr>
		<th>Artiste</th>
		<th>Pays</th>
		<th>Début</th>
	</tr>
	<?php foreach ($artists as $uneLigne) : ?>
	<tr>
		<td><?= $this->Html->link($uneLigne->pseudonym, ['action' => 'view', $uneLigne->id]); ?></td>
		<td><?= (!empty($uneLigne->country)) ? $uneLigne->country : 'Pas définie' ?></td>
		<td><?php echo $uneLigne->debut ?></td>
	</tr>
	<?php endforeach; ?>
</table>
<div class="paging">
	<?php 
		echo $this->Paginator->first("First");
		echo $this->Paginator->numbers();
		echo $this->Paginator->last("Last");
	?>
</div>

<h2>Le top des artistes</h2>
<?php 
foreach ($artists_pseudonym as $value): 
?>

<ul>
	<li>
		<figure>
			<?php if (!empty($value->picture)) { ?>
				<?= $this->Html->image('../data/pictures/'.$value->picture, ['alt' => 'Affiche de :'.$value->pseudonym]) ?><br>
			<?php }else{ ?>
				<?= $this->Html->image('picture_default.png', ['alt' => 'Visuel non disponible']) ?>
			<?php } ?>
			<figcaption>
				<?= $value->pseudonym; ?>
			</figcaption>
		</figure>
	</li>
</ul>	
<?php endforeach ?>



<h2>Les challengers</h2>
<?php foreach ($notpopulars as $value):
if($value->count < 2){
?>
<ul>
	<li>
		<figure>
			<?php if (!empty($value->picture)) { ?>
				<?= $this->Html->image('../data/pictures/'.$value->picture, ['alt' => 'Affiche de :'.$value->pseudonym]) ?>
			<?php }else{ ?>
				<?= $this->Html->image('picture_default.png', ['alt' => 'Visuel non disponible']) ?>
			<?php } ?>
			<figcaption>
				<?= $value->pseudonym; ?>
			</figcaption>
		</figure>
	</li>
</ul>	
<?php } endforeach ?>