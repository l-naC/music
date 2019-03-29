<?php //file : src/Templates/Users/add.ctp ?>

<?= $this->Form->create($new) ?>
	<h1>Créer un compte </h1>
	<?= $this->Form->control('pseudo', ['label' => 'Pseudo']) ?>
	<?= $this->Form->control('password', ['label' => 'Password', 'type' => 'password']) ?>
	<?= $this->Form->button('Ajouter') ?>
<?= $this->Form->end() ?>