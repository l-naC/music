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


<h2>Les plus populaire et mis en favori</h2>
<ul>
	<?php 
	var_dump($result);
	?>
	<li></li>
</ul>

<h2>Les challengers</h2>
<ul>
	<li></li>
</ul>