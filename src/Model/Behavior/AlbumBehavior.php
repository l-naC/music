<?php
//src/Model/Behavior/AlbumBehavior.php

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;
use ArrayObject;


class AlbumBehavior extends Behavior
{
	protected $_defaultCongif = [
		'field' => 'cover'
	];
	public function beforeDelete(Event $event, EntityInterface $entity, ArrayObject $options)
	{
        $address = WWW_ROOT.'data/covers/'.$entity->cover;
        if (!empty($entity->cover) && file_exists($address)) {
            unlink ($address);
        }

        return true;
	}
}
