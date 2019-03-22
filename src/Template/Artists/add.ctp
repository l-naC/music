<?php //file : src/Templates/Artists/add.ctp ?>

<?= $this->Form->create($new, ['enctype' => 'multipart/form-data']) ?>
	<h1>Ajouter un artist</h1>
	<?= $this->Form->control('pseudonym', ['label' => 'Artist']) ?>
	<?= $this->Form->control('debut', ['label' => 'Année de début']) ?>
	<?= $this->Form->control('country', ['label' => 'Pays d\'origine']) ?>
	<?= $this->Form->control('spotify', ['label' => 'Url spotify']) ?>
	<?= $this->Form->control('picture', ['type' => 'file', 'label' => 'Photo']) ?>
	<?= $this->Form->button('Ajouter') ?>
<?= $this->Form->end() ?>