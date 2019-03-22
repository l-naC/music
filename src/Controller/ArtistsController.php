<?php
//src/Controller/ArtistsController.php

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;

class ArtistsController extends AppController
{
	public function index()
    {
    	$artists = $this->Artists->find();
    	//$artists = $this->paginate($this->Artists);
        $this->set(compact('artists'));
    }

    public function view($id)
    {
        $artist = $this->Artists->get($id, [
            'contain' => ['Albums']
        ]);

        $albums = $this->Artists->Albums->find();

        $this->set(compact('artist', 'albums'));
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
                $this->Flash->error('Ce format de fichier n\'est pas autorisé');
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
