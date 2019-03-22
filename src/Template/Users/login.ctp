<?php //file : src/Templates/Users/login.ctp ?>

<?= $this->Form->create() ?>
	<h1>Connexion</h1>
	<?= $this->Form->control('pseudo', ['label' => 'Pseudo']) ?>
	<?= $this->Form->control('password', ['label' => 'Mot de passe', 'type' => 'password']) ?>
	<?= $this->Form->button('Login') ?>
<?= $this->Form->end() ?>