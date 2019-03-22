<?php
//src/Controller/AlbumsController.php

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;

class AlbumsController extends AppController
{
    public function view($id)
    {
        $album = $this->Albums->get($id);

        $this->set(compact('album'));
    }
}
