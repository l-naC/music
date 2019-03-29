<?php
//src/Controller/ArtistsController.php

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;

class ArtistsController extends AppController
{
    public $paginate = [
        'limit' => 25,
        'order' => [
            'Artists.pseudonym' => 'asc'
        ]
    ];
	public function index()
    {
    	$artists = $this->paginate($this->Artists);

        $popular = $this->Artists->Bookmarks->find();
        $popular
        ->select(['artist_id', 'count' => $popular->func()->count('*')])
        ->group(['artist_id'])
        ->order(['count' => 'DESC'])
        ->limit(3);
        $populars = $popular->all();

        $artists_pseudonym = array();
        foreach ($populars as $value){
            $artists_pseudonym[] = $this->Artists->get($value->artist_id);
        }

        $bookmarks = $this->Artists->Bookmarks->find();
        $bookmarks_array = array();
        foreach ($bookmarks as $value){
            $bookmarks_array[] = $value->artist_id;
        }
        $notpopular = $this->Artists->find()->where(['id NOT IN' => $bookmarks_array])->order('rand()')->limit(3);
        $count = 0;
        foreach ($notpopular as $value ){ $count++; }

        $challenger = $this->Artists->Bookmarks->find();
        $challenger->select(['artist_id', 'count' => $challenger->func()->count('*')])
        ->group(['artist_id'])
        ->order(['count' => 'ASC'])
        ->limit(3-$count);
        $challengers = $challenger->all();

        $notpopulars = array();
        foreach ($challengers as $value){
            $notpopulars[] = $this->Artists->get($value->artist_id);
        }

        $this->set(compact('artists', 'notpopulars','notpopular', 'artists_pseudonym'));
    }

    public function view($id)
    {
        $artist = $this->Artists->get($id, [
            'contain' => ['Albums']
        ]);

        $query = $this->Artists->Bookmarks->find();
        $query
        ->select([
            'count' => $query->func()->count('id')
        ])
        ->where(['artist_id' => $id]);

        $result = $query->first();

        $bookmarks = $this->Artists->Bookmarks->find();
        $bookmarks->where(['user_id' => $this->Auth->user('id'), 'artist_id' => $id]);

        $bookmark = $bookmarks->first();      

        $this->set(compact('artist', 'result', 'bookmark'));
    }

    public function add()
    {
        $new = $this->Artists->newEntity();
        if ($this->request->is('post')) {
            $new = $this->Artists->patchEntity($new, $this->request->getData());

            if (in_array($this->request->getData()['picture']['type'], ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])) {

                $ext = pathinfo($this->request->getData()['picture']['name'], PATHINFO_EXTENSION);

                $name = 'a-'.rand(0,3000).'-'.time().'.'.$ext;

                $address = WWW_ROOT.'data/pictures/'.$name;

                $new->picture = $name;

                move_uploaded_file($this->request->getData('picture')['tmp_name'], $address);
            }else{
                $new->picture = null;
            }
            if ($this->Artists->save($new)) {
                $this->Flash->success('Ok');

               return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Planté');
        }
        $this->set(compact('new'));
    }

    public function edit($id)
    {
        $artist = $this->Artists->get($id);

        if ($this->request->is(['post', 'put'])) {

            $this->Artists->patchEntity($artist, $this->request->getData());
            if ($this->Artists->save($artist)) {
                $this->Flash->success('Modif ok');
                return $this->redirect(['action' => 'view', $artist->id]);
            }
            $this->Flash->error('Modif planté');
        }
        $this->set(compact('artist'));
    }

    public function delete($id)
    {
        if($this->request->is(['post', 'delete'])){
            $artist = $this->Artists->get($id);
            
            if ($this->Artists->delete($artist)) {
                $this->Flash->success('Supprimé');
                return $this->redirect(['action' => 'index']);
            }else{
                $this->Flash->error('Supprimession planté');
                return $this->redirect(['action' => 'view', $id]);
            }
        }else{
            throw new NotFoundException('Methode interdite (c\'est pas beau de tricher)');   
        }
    }

    public function editImage($id)
    {
        $artist = $this->Artists->get($id);

        $old_picture = $artist->picture;
        $old = WWW_ROOT.'data/pictures/'.$artist->picture;

        if ($this->request->is(['post', 'put'])) {

            $this->Artists->patchEntity($artist, $this->request->getData());

            if (in_array($this->request->getData()['picture']['type'], ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])) {

                $ext = pathinfo($this->request->getData()['picture']['name'], PATHINFO_EXTENSION);

                $name = 'a-'.rand(0,3000).'-'.time().'.'.$ext;

                $address = WWW_ROOT.'data/pictures/'.$name;

                $artist->picture = $name;

                move_uploaded_file($this->request->getData('picture')['tmp_name'], $address);

                if ($this->Artists->save($artist)) {

                    if (!empty($old_picture) && file_exists($old)){
                        unlink($old);
                    }

                    $this->Flash->success('Image modifiée');

                    return $this->redirect(['action' => 'view', $artist->id]);

                }else{
                    $this->Flash->error('Image non modifiée');
                }

            }else{
                $artist->picture = $old_picture;
                $this->Flash->error('Ce format de fichier n\'est pas autorisé');
            }
        }
        $this->set(compact('artist'));
    }

    public function deleteImage($id)
    {
        if($this->request->is(['post'])){
            $artist = $this->Artists->get($id);
            $old_picture= $artist->picture;
            $old = WWW_ROOT.'data/pictures/'.$artist->picture;
            if (!empty($old_picture) && file_exists($old)){
                unlink($old);
            }
            $artist->picture = null;
            $this->Artists->save($artist);
            $this->Flash->success('Image supprimée');
            return $this->redirect(['action' => 'view', $artist->id]);
            
        }else{
            throw new NotFoundException('Access denied, try again');   
        }
        
    }
}
