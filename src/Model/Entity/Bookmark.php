<?php
//src/Model/Entity/Bookmark.php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

class Bookmark extends Entity
{
	protected $_accessible = [
		'*' => true, 
		'id' => false
	];
}