<?php //file : src/Templates/Users/view.ctp 
?>
<?php if ($user->pseudo != $auth->user('pseudo')) { ?>
<h1>Un utilisateur</h1>
<?php }else{ ?>
<h1>Mon profil</h1>
<?php } ?>

<p>
	<span class="label">Pseudo :</span>
	<?php echo $user->pseudo; ?>
</p>
<?php if ($user->status == 'admin') { ?>
<p>
	<span class="label">Status :</span>
	<?php echo $user->status; ?>
</p>
<?php } ?>
<h2>Favoris</h2> 
<?php if (!empty($user->bookmarks)) { ?>
	<?php foreach ($user->bookmarks as $bookmark): ?>
	<ul>
		<li>
			<figure>
				<?php if (!empty($bookmark->artist->picture)) { ?>
					<?= $this->Html->image('../data/pictures/'.$bookmark->artist->picture, ['alt' => 'Affiche de :'.$bookmark->artist->pseudonym]) ?>
				<?php }else{ ?>
					<?= $this->Html->image('picture_default.png', ['alt' => 'Visuel non disponible']) ?>
				<?php } ?>
				<figcaption>
					<?= $bookmark->artist->pseudonym; ?>
					<?php if(($auth->user()) && ($auth->user('id')) == $user->id) { ?>
						<?= $this->Form->postLink('Supprimer', ['controller' => 'bookmarks', 'action' => 'delete', $bookmark->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer ce favori ?', 'class' => 'link_add icon times']); ?>
					<?php } ?>
				</figcaption>
			</figure>
				
		</li>
	</ul>	
	<?php endforeach ?>

	<h2>Nuage de point des genres favoris</h2>
	<div id="cloud">
		<ul>
			<?php foreach ($style as $key => $value): ?>
			<li><?= $value->style ?> : <?= $value->count ?> point(s)</li>
			<?php endforeach ?>
		</ul>
		
		<div>
			<?php foreach ($style as $key => $value): ?>
			<div>
				<p id="point" style="width: <?= $value->count ?>0px; height: <?= $value->count ?>0px;"></p>
				<p><?= $value->count ?></p>
			</div>
			<?php endforeach ?>
		</div>
	</div>
<?php }else{
	echo "Aucun favori d'ajouté";
} ?>

<?php if(($auth->user()) && ($auth->user('id')) != $user->id) { ?>
	<h2>Favoris en commun</h2>
	<?php 
	foreach ($commons as $common): ?>
	<ul>
		<li>
			<figure>
				<?php if (!empty($common->artist->picture)) { ?>
					<?= $this->Html->image('../data/pictures/'.$common->artist->picture, ['alt' => 'Affiche de :'.$common->artist->pseudonym]) ?>
				<?php }else{ ?>
					<?= $this->Html->image('picture_default.png', ['alt' => 'Visuel non disponible']) ?>
				<?php } ?>
				<figcaption>
					Affiche de : <?= $common->artist->pseudonym; ?>
				</figcaption>
			</figure>
		</li>
	</ul>	
	<?php endforeach ?>

	<h2>Ces artistes peuvent vous interesser</h2>
	<?php 
	foreach ($differents as $different): ?>
	<ul>
		<li>
			<figure>
				<?php if (!empty($different->artist->picture)) { ?>
					<?= $this->Html->image('../data/pictures/'.$different->artist->picture, ['alt' => 'Affiche de :'.$different->artist->pseudonym]) ?>
				<?php }else{ ?>
					<?= $this->Html->image('picture_default.png', ['alt' => 'Visuel non disponible']) ?>
				<?php } ?>
				<figcaption>
					Affiche de : <?= $different->artist->pseudonym; ?>
				</figcaption>
			</figure>
		</li>
	</ul>	
	<?php endforeach ?>
<?php } ?>