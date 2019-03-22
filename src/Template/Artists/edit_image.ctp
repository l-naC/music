<?php //file : src/Templates/Artists/edit_image.ctp  ?>

<?= $this->Form->create($artist, ['enctype' => 'multipart/form-data']) ?>
	<h1>Modification de l'affiche : <?= $artist->title ?> </h1>
	<?= $this->Form->control('picture', ['type' => 'file', 'label' => 'Affiche']) ?>
	<figure>
		<?php if (!empty($artist->picture)) { ?>
			<?= $this->Html->image('../data/pictures/'.$artist->picture, ['alt' => 'Affiche de :'.$artist->title]) ?>
		<?php }else{ ?>
			<?= $this->Html->image('picture_default.png', ['alt' => 'Visuel non disponible']) ?>
		<?php } ?>
		<figcaption>
			Image actuelle
		</figcaption>
	</figure>
<?= $this->Form->button('Modifier') ?>
<?= $this->Form->end() ?>