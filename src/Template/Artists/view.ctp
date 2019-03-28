<?php //file : src/Templates/Artists/view.ctp 
?>
<h1>Un artiste</h1>
<?= "<h2>".$result->count." personnes l'on mis en favori</h2>" ?>
<figure>
	<?php if (!empty($artist->picture)) { ?>
		<?= $this->Html->image('../data/pictures/'.$artist->picture, ['alt' => 'Affiche de :'.$artist->pseudonym]) ?>
	<?php }else{ ?>
		<?= $this->Html->image('picture_default.png', ['alt' => 'Visuel non disponible']) ?>
	<?php } ?>
	<figcaption>
		Affiche de : <?= $artist->pseudonym ?>
		<?php if(($auth->user()) && ($auth->user('status')) == 'admin') { ?>
			<?= $this->Html->link('Edit Image', ['action' => 'edit_image', $artist->id]); ?>
			<?php if (!empty($artist->picture)) { ?>
			<?= $this->Form->postLink('Supprimer', ['action' => 'delete_image', $artist->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer la photo de cette artist ?']); ?>
			<?php } ?>
		<?php } ?>
	</figcaption>
</figure>
<?php if($auth->user()) { ?>
<div class="margin">
	<?= $this->Html->link('Ajouter en favori', ['controller' => 'bookmarks', 'action' => 'add', $artist->id], ['class' => 'link_add']); ?>
</div>
<?php } ?>
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
<div class="margin">
	<a href="<?= $artist->spotify ?>">Lien spotify</a>
</div>
<p>
	<?php 
		$lien_bdd = strstr($artist->spotify, 'artist/');
		$lien = 'https://open.spotify.com/embed/'.$lien_bdd;
	?>
	<iframe src="<?= $lien ?>" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
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
	<?php 
	if(($auth->user()) && ($auth->user('status')) == 'admin') {
		echo "<div class='margin'>".$this->Html->link('Ajouter un album', ['controller' => 'albums', 'action' => 'add', $artist->id], ['class' => 'link_add'])."</div>"; 
	} 
	?>
</div>

<?php 
if (empty($artist->albums)) {
	echo "<p>Aucun album</p>";
}else foreach ($artist->albums as $album) { ?>
	<article class="comments">
		<p><?= $this->Html->link($album->title, ['controller' => 'albums', 'action' => 'view', $album->id]); ?></p>
	</article>
<?php } ?>

<?php if(($auth->user()) && ($auth->user('status')) == 'admin') { ?>
	<div class="row">
		<?= $this->Html->link('Edit', ['action' => 'edit', $artist->id], ['class' => 'col-3 link']); ?>
		<?= $this->Form->postLink('Supprimer', ['action' => 'delete', $artist->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer cette artist ?', 'class' => 'col-3 link']); ?>
	</div>
<?php } ?>
