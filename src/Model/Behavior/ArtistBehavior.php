<?php
//src/Model/Behavior/ArtistBehavior.php

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;
use ArrayObject;


class ArtistBehavior extends Behavior
{
	protected $_defaultCongif = [
		'field' => 'picture'
	];
	public function beforeDelete(Event $event, EntityInterface $entity, ArrayObject $options)
	{
        $address = WWW_ROOT.'data/pictures/'.$entity->picture;
        if (!empty($entity->picture) && file_exists($address)) {
            unlink ($address);
        }

        return true;
	}
}
