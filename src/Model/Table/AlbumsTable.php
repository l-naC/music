<?php
//src/Model/Table/AlbumsTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AlbumsTable extends Table
{
	public function initialize(array $config)
    {
    	$this->addBehavior('Timestamp');
        $this->addBehavior('Album');

        $this->belongsTo('Artists', [
            'foreignKey' => 'artist_id',
            'joinType' => 'INNER',
            'dependent' => true,
            'cascadeCallbacks' => true
        ]);
    }

    public function validationDefault(Validator $v)
    {
        $v->notEmpty('title')
        ->maxLength('title', 100)
        ->allowEmpty('cover')
        ->allowEmpty('styke')
        ->allowEmpty('spotify')
        ->allowEmpty('releaseyear');
        return $v;
    }
}
