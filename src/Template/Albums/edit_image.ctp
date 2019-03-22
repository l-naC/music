<?php //file : src/Templates/Albums/edit_image.ctp  ?>

<?= $this->Form->create($album, ['enctype' => 'multipart/form-data']) ?>
	<h1>Modification de l'affiche : <?= $album->title ?> </h1>
	<?= $this->Form->control('cover', ['type' => 'file', 'label' => 'Affiche']) ?>
	<figure>
		<?php if (!empty($album->cover)) { ?>
			<?= $this->Html->image('../data/covers/'.$album->cover, ['alt' => 'Affiche de :'.$album->title]) ?>
		<?php }else{ ?>
			<?= $this->Html->image('cover_default.png', ['alt' => 'Visuel non disponible']) ?>
		<?php } ?>
		<figcaption>
			Image actuelle
		</figcaption>
	</figure>
<?= $this->Form->button('Modifier') ?>
<?= $this->Form->end() ?>