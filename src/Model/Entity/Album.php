<?php
//src/Model/Entity/Album.php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Album extends Entity
{
	protected $_accessible = [
		'*' => true, 
		'id' => false
	];
}
