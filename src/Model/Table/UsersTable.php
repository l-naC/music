<?php
//src/Model/Table/UsersTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');

        $this->hasMany('Bookmarks', [
            'foreignKey' => 'user_id'
        ]);
    }

    public function validationDefault(Validator $v)
    {
        $v->notEmpty('pseudo')
        ->maxLength('pseudo', 50)
        ->notEmpty('password');
        return $v;
    }
}
