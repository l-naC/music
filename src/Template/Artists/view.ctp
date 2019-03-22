<?php //file : src/Templates/Artists/view.ctp 
?>
<h1>Un artist</h1>

<figure>
	<?php if (!empty($artist->picture)) { ?>
		<?= $this->Html->image('../data/pictures/'.$artist->picture, ['alt' => 'Affiche de :'.$artist->pseudonym]) ?>
	<?php }else{ ?>
		<?= $this->Html->image('picture_default.png', ['alt' => 'Visuel non disponible']) ?>
	<?php } ?>
	<figcaption>
		Affiche de : <?= $artist->pseudonym ?>
		<?= $this->Html->link('Edit Image', ['action' => 'edit_image', $artist->id]); ?>
		<?php if (!empty($artist->picture)) { ?>
		<?= $this->Form->postLink('Supprimer', ['action' => 'delete_image', $artist->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer la photo de cette artist ?']); ?>
		<?php } ?>
	</figcaption>
</figure>
<p>
	<span class="label">Artist :</span>
	<?php echo $artist->pseudonym; ?>
</p>
<p>
	<span class="label">Début :</span>
	<?php if(!empty($artist->debut)) { echo $artist->debut; }else{ echo 'inconnue'; }  ?>
</p>
<p>
	<span class="label">Pays d'origine :</span>
	<?php if(!empty($artist->country)) { echo $artist->country; }else{ echo 'inconnue'; }  ?>
</p>
<p>
	<a href="https://open.spotify.com/artist/<?= $artist->spotify ?>">Lien spotify</a>
</p>
<p>
	<iframe src="https://open.spotify.com/embed/artist/<?= $artist->spotify ?>" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
</p>
<p>
	<span class="label">Fiche créée le :</span>
	<?php echo $artist->created->i18nFormat('dd/MM/yyyy HH:mm:ss'); ?>
</p>
<p>
	<span class="label">Fiche modifiée le :</span>
	<?php echo $artist->modified->i18nFormat('dd/MM/yyyy HH:mm:ss'); ?>
</p>
<div>
	<h2>Albums</h2>
	<?= $this->Html->link('Ajouter un album', ['controller' => 'albums', 'action' => 'add', $artist->id]); ?>
</div>

<?php 
if (empty($artist->albums)) {
	echo "<p>Aucun album</p>";
}else foreach ($artist->albums as $album) { ?>
	<article class="comments">
		<p><?= $this->Html->link($album->title, ['controller' => 'albums', 'action' => 'view', $album->id]); ?></p>
	</article>
<?php } ?>
<div class="row text-center">
	<?= $this->Html->link('Edit', ['action' => 'edit', $artist->id], ['class' => 'col-3 link']); ?>
	<?= $this->Form->postLink('Supprimer', ['action' => 'delete', $artist->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer cette artist ?', 'class' => 'col-3 link']); ?>
</div>
