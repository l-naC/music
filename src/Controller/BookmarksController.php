<?php
//src/Controller/BookmarksController.php

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;

class BookmarksController extends AppController
{
    public function view()
    {

    }

    public function add($artist_id)
    {
        $bookmark = $this->Bookmarks->newEntity();

        $bookmark->user_id = $this->Auth->user('id');

        $bookmark->artist_id = $artist_id;

        if ($this->Bookmarks->save($bookmark)) {
            $this->Flash->success('Artiste ajouté en favori');

            return $this->redirect(['controller' => 'artists', 'action' => 'view', $bookmark->artist_id]);
        }
        $this->Flash->error('Planté');
    }
}