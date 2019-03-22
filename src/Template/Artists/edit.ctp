<?php //file : src/Templates/Artists/edit.ctp  ?>

<?= $this->Form->create($artist) ?>
	<h1>Modifier un artist</h1>
	<?= $this->Form->control('pseudonym', ['label' => 'Artist']) ?>
	<?= $this->Form->control('debut', ['label' => 'Année de début']) ?>
	<?= $this->Form->control('country', ['label' => 'Pays d\'origine']) ?>
	<?= $this->Form->control('spotify', ['label' => 'Url spotify (exemple : 25eQCECJH4VTpBYV9jhpyE)']) ?>
<?= $this->Form->button('Modifier') ?>
<?= $this->Form->end() ?>