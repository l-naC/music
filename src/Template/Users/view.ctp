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
	<li><?php echo $bookmark->artist->pseudonym; ?>
	<?php if(($auth->user()) && ($auth->user('id')) == $user->id) { ?>
		<span><?= $this->Form->postLink('Supprimer', ['controller' => 'bookmarks', 'action' => 'delete', $bookmark->id, $user->id], ['confirm' => 'Etes-vous sûr de vouloir supprimer ce favori ?']); ?></span>
	<?php } ?>
	</li>
</ul>	
<?php endforeach ?>

<?php if(($auth->user()) && ($auth->user('id')) != $user->id) { ?>

<h2>Favoris en commun</h2>
<?php 
var_dump($common->first());
foreach ($common as $commons): ?>
<ul>
	<li><?php echo $commons->artist_id; ?>
</ul>	
<?php endforeach ?>

<h2>Ces artistes peuvent vous interesser</h2>
<?php 
foreach ($different as $differents): ?>
<ul>
	<li><?php echo $differents->artist_id; ?>
</ul>	
<?php endforeach ?>

<?php } ?>

