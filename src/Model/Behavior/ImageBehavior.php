<?php
//src/Model/Behavior/ImageBehavior.php

//A quel espace de logique au quel il appartient. Donc juste son espace logique
namespace App\Model\Behavior;

//Va charger des element en memoire pour qu'on puisse les utiliser, comme un import
use Cake\ORM\Behavior;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;
use ArrayObject;


class ImageBehavior extends Behavior
{
	//indique sur quelle colonne on travaille
	protected $_defaultCongif = [
		'field' => 'picture'
	];
	//fonction qui sera appeller à chaque fois que l'on utilisera la methode ->delete sur un enregistrement movie
	public function beforeDelete(Event $event, EntityInterface $entity, ArrayObject $options)
	{
		//on recree le chemin vers le fichier
        $address = WWW_ROOT.'data/picture/'.$entity->picture;
        //si le nom du fichier n'est pas vide et que le fichier existenn on le supprime
        if (!empty($entity->picture) && file_exists($address)) {
            unlink ($address);
        }

        return true;
	}
}
