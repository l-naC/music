<?php //file : src/Templates/Users/view.ctp 
?>
<h1>Un utilisateur</h1>

<p>
	<span class="label">Pseudo :</span>
	<?php echo $user->pseudo; ?>
</p>
<p>
	<span class="label">Status :</span>
	<?php echo $user->status; ?>
</p>
<h2>Favoris</h2> 
<?php 
foreach ($user->bookmarks as $bookmark): ?>
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
					<?= $this->Form->postLink('Supprimer', ['controller' => 'bookmarks', 'action' => 'delete', $bookmark->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer ce favori ?']); ?>
				<?php } ?>
			</figcaption>
		</figure>
			
	</li>
</ul>	
<?php endforeach ?>

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

