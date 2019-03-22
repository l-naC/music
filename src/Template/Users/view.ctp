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
	<li><?php echo $bookmark->artist->pseudonym; ?></li>
</ul>	
<?php endforeach ?>

