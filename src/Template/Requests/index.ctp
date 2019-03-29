<?php //file : src/Templates/Artists/index.ctp ?>
<h2>En attente</h2>
<table>
	<tr>
		<th>Nom d'artiste</th>
		<th>Nom d'album</th>
		<th>Status</th>
		<th></th>
	</tr>
	<?php foreach ($requests as $uneLigne) : ?>
	<tr>
		<td><?= $uneLigne->artistname ?></td>
		<td><?= ($uneLigne->albumtitle) ? $uneLigne->albumtitle : 'inconnue' ?></td>
		<td><?php echo $uneLigne->status ?></td>
		<?php if($uneLigne->status == 'pending') { ?>
		<td>
			<?= $this->Form->postLink('', ['action' => 'accept', $uneLigne->id], ['class' => 'col-3 link icon check']); ?>
			<?= $this->Form->postLink('', ['action' => 'decline', $uneLigne->id], ['class' => 'col-3 link icon times']); ?>
		</td>
		<?php } ?>
	</tr>
	<?php endforeach; ?>
</table>

<h2>Accepté</h2>
<table>
	<tr>
		<th>Nom d'artiste</th>
		<th>Nom d'album</th>
		<th>Status</th>
	</tr>
	<?php foreach ($requests_accept as $uneLigne) : ?>
	<tr>
		<td><?= $uneLigne->artistname ?></td>
		<td><?= ($uneLigne->albumtitle) ? $uneLigne->albumtitle : 'inconnue' ?></td>
		<td><?php echo $uneLigne->status ?></td>
	</tr>
	<?php endforeach; ?>
</table>

<h2>Refusé</h2>
<table>
	<tr>
		<th>Nom d'artiste</th>
		<th>Nom d'album</th>
		<th>Status</th>
	</tr>
	<?php foreach ($requests_decline as $uneLigne) : ?>
	<tr>
		<td><?= $uneLigne->artistname ?></td>
		<td><?= ($uneLigne->albumtitle) ? $uneLigne->albumtitle : 'inconnue' ?></td>
		<td><?php echo $uneLigne->status ?></td>
	</tr>
	<?php endforeach; ?>
</table>