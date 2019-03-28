<?php
//src/Model/Table/RequestsTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class RequestsTable extends Table
{
	public function initialize(array $config)
    {
    	$this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $v)
    {
        $v->notEmpty('artistname')
        ->maxLength('artistname', 100)
        ->allowEmpty('albumtitle');
        return $v;
    }
}
