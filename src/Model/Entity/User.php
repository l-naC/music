<?php
//src/Model/Entity/User.php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

class User extends Entity
{
	protected $_accessible = [
		'*' => true, 
		'id' => false
	];

	//function qui permet de hasher le password au moment de l'ajout
	protected function _setPassword($value){
		if (strlen($value)) {
			$hasher = new DefaultPasswordHasher();

			return $hasher->hash($value);
		}
	}
}