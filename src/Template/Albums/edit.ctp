<?php //file : src/Templates/Albums/edit.ctp  ?>

<?= $this->Form->create($album) ?>
	<h1>Modifier un album</h1>
	<?= $this->Form->control('title', ['label' => 'Titre']) ?>
	<?= $this->Form->control('style', ['label' => 'Genre']) ?>
	<?= $this->Form->control('releaseyear', ['label' => 'Date de sortie']) ?>
	<?= $this->Form->control('spotify', ['label' => 'Url spotify (exemple : 25eQCECJH4VTpBYV9jhpyE)']) ?>
<?= $this->Form->button('Modifier') ?>
<?= $this->Form->end() ?>