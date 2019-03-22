<?php
//src/Model/Table/ArtistsTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class BookmarksTable extends Table
{
	public function initialize(array $config)
    {
    	$this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Artists', [
            'foreignKey' => 'artist_id',
            'joinType' => 'INNER',
            'dependent' => true,
            'cascadeCallbacks' => true
        ]);
    }

    public function validationDefault(Validator $v)
    {
        $v->notEmpty('user_id')
        ->notEmpty('artist_id');
        return $v;
    }
}
