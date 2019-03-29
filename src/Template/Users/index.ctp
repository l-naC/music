<?php //file : src/Templates/Users/index.ctp ?>
<p>Il y a <?= $users->count(); ?> user(s)</p>

<table>
	<tr>
		<th>Pseudo</th>
		<th>Status</th>
		<th>Created</th>
		<th>Modified</th>
	</tr>
	
	<?php foreach ($users as $uneLigne) : ?>
	<tr>
		<td><?= $this->Html->link($uneLigne->pseudo, ['action' => 'view', $uneLigne->id]); ?></td>
		<td><?= $uneLigne->status ?></td>
		<td><?= $uneLigne->created->i18nFormat('dd/MM/yyyy') ?></td>
		<td><?= $uneLigne->modified->i18nFormat('dd/MM/yyyy') ?></td>
	</tr>
	<?php endforeach; ?>
</table>