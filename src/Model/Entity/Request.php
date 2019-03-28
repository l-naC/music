<?php
//src/Model/Entity/Request.php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Request extends Entity
{
	protected $_accessible = [
		'*' => true, 
		'id' => false
	];
}
