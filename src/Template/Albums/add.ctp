<?php //file : src/Templates/Albums/add.ctp ?>

<?= $this->Form->create($new, ['enctype' => 'multipart/form-data']) ?>
	<h1>Ajouter un album</h1>
	<?= $this->Form->control('title', ['label' => 'Titre']) ?>
	<?= $this->Form->control('style', ['label' => 'Genre']) ?>
	<?= $this->Form->control('releaseyear', ['label' => 'Date de sortie']) ?>
	<?= $this->Form->control('spotify', ['label' => 'Url spotify (exemple : 25eQCECJH4VTpBYV9jhpyE)']) ?>
	<?= $this->Form->control('cover', ['type' => 'file', 'label' => 'Cover']) ?>
	<?= $this->Form->button('Ajouter') ?>
<?= $this->Form->end() ?>