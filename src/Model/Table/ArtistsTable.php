<?php
//src/Model/Table/ArtistsTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ArtistsTable extends Table
{
	public function initialize(array $config)
    {
    	$this->addBehavior('Timestamp');
        $this->addBehavior('Artist');

        $this->hasMany('Albums', [
            'foreignKey' => 'artist_id'
        ]);
    }

    public function validationDefault(Validator $v)
    {
        $v->notEmpty('pseudonym')
        ->maxLength('pseudonym', 100)
        ->allowEmpty('debut')
        ->allowEmpty('contry')
        ->allowEmpty('picture')
        ->allowEmpty('spotify');
        return $v;
    }
}
