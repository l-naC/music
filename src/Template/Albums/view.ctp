<?php //file : src/Templates/Albums/view.ctp 
?>
<h1>Un album</h1>

<figure>
	<?php if (!empty($album->cover)) { ?>
		<?= $this->Html->image('../data/covers/'.$album->cover, ['alt' => 'Affiche de :'.$album->title]) ?>
	<?php }else{ ?>
		<?= $this->Html->image('cover_default.png', ['alt' => 'Visuel non disponible']) ?>
	<?php } ?>
	<figcaption>
		Affiche de : <?= $album->title ?>
		<?php if(($auth->user()) && ($auth->user('status')) == 'admin') { ?>
		<?= $this->Html->link('Edit Image', ['action' => 'edit_image', $album->id]); ?>
			<?php if (!empty($album->cover)) { ?>
			<?= $this->Form->postLink('Supprimer', ['action' => 'delete_image', $album->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer la photo de cette album ?']); ?>
			<?php } ?>
		<?php } ?>
	</figcaption>
</figure>
<p>
	<span class="label">album :</span>
	<?php echo $album->title; ?>
</p>
<p>
	<span class="label">Début :</span>
	<?php if(!empty($album->releaseyear)) { echo $album->releaseyear; }else{ echo 'inconnue'; }  ?>
</p>
<p>
	<span class="label">Genre :</span>
	<?php if(!empty($album->style)) { echo $album->style; }else{ echo 'pas définie'; }  ?>
</p>
<p>
	<a href="<?= $album->spotify ?>">Lien spotify</a>
</p>
<p>
	<?php 
		$lien_bdd = strstr($album->spotify, 'album/');
		$lien = 'https://open.spotify.com/embed/'.$lien_bdd;
	?>
	<iframe src="<?= $lien ?>" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
</p>
<p>
	<span class="label">Fiche créée le :</span>
	<?php echo $album->created->i18nFormat('dd/MM/yyyy HH:mm:ss'); ?>
</p>
<p>
	<span class="label">Fiche modifiée le :</span>
	<?php echo $album->modified->i18nFormat('dd/MM/yyyy HH:mm:ss'); ?>
</p>
<?php if(($auth->user()) && ($auth->user('status')) == 'admin') { ?>
	<div class="row text-center">
		<?= $this->Html->link('Edit', ['action' => 'edit', $album->id], ['class' => 'col-3 link']); ?>
		<?= $this->Form->postLink('Supprimer', ['action' => 'delete', $album->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer cette album ?', 'class' => 'col-3 link']); ?>
	</div>
<?php } ?>
