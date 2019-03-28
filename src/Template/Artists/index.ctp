<?php //file : src/Templates/Artists/index.ctp ?>
<p>Il y a <?= $artists->count(); ?> artiste(s)</p>

<table>
	<tr>
		<th>Artiste</th>
		<th>Style</th>
		<th>Début</th>
	</tr>
	<?php foreach ($artists as $uneLigne) : ?>
	<tr>
		<td><?= $this->Html->link($uneLigne->pseudonym, ['action' => 'view', $uneLigne->id]); ?></td>
		<td><?= (!empty($uneLigne->style)) ? $uneLigne->style : 'Pas définie' ?></td>
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
<?php foreach ($artists_pseudonym as $value): ?>
<ul>
	<li>
		<figure>
			<?php if (!empty($value->picture)) { ?>
				<?= $this->Html->image('../data/pictures/'.$value->picture, ['alt' => 'Affiche de :'.$value->pseudonym]) ?>
			<?php }else{ ?>
				<?= $this->Html->image('picture_default.png', ['alt' => 'Visuel non disponible']) ?>
			<?php } ?>
			<figcaption>
				Affiche de : <?= $value->pseudonym; ?>
			</figcaption>
		</figure>
	</li>
</ul>	
<?php endforeach ?>



<h2>Les challengers</h2>
<?php foreach ($notpopulars as $value): ?>
<ul>
	<li>
		<figure>
			<?php if (!empty($value->picture)) { ?>
				<?= $this->Html->image('../data/pictures/'.$value->picture, ['alt' => 'Affiche de :'.$value->pseudonym]) ?>
			<?php }else{ ?>
				<?= $this->Html->image('picture_default.png', ['alt' => 'Visuel non disponible']) ?>
			<?php } ?>
			<figcaption>
				Affiche de : <?= $value->pseudonym; ?>
			</figcaption>
		</figure>
	</li>
</ul>	
<?php endforeach ?>