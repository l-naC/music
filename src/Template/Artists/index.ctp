<?php //file : src/Templates/Artists/index.ctp ?>
<p>Il y a <?= $artists->count(); ?> artist(s)</p>

<table>
	<tr>
		<th>Artist</th>
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