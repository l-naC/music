<?php //file : src/Templates/Request/add.ctp ?>

<?= $this->Form->create($new) ?>
	<h1>Envoyer une requetes d'ajout d'artiste ou d'album à un admin</h1>
	<?= $this->Form->control('artistname', ['label' => 'Nom d\'un artiste']) ?>
	<?= $this->Form->control('albumtitle', ['label' => 'Nom d\'un album']) ?>
	<?= $this->Form->button('Ajouter') ?>
<?= $this->Form->end() ?>