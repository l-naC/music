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

    public function add($artist_id)
    {
        $new = $this->Albums->newEntity();
        if ($this->request->is('post')) {
            $new = $this->Albums->patchEntity($new, $this->request->getData());

            if (in_array($this->request->getData()['cover']['type'], ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])) {

                $ext = pathinfo($this->request->getData()['cover']['name'], PATHINFO_EXTENSION);

                $name = 'a-'.rand(0,3000).'-'.time().'.'.$ext;

                $address = WWW_ROOT.'data/covers/'.$name;

                $new->cover = $name;

                move_uploaded_file($this->request->getData('cover')['tmp_name'], $address);

            }else{
                $new->cover = null;
                $this->Flash->error('Ce format de fichier n\'est pas autorisé');
            }
            $new->artist_id = $artist_id;
            if ($this->Albums->save($new)) {
                $this->Flash->success('Ok');

               return $this->redirect(['controller' => 'artists', 'action' => 'view', $artist_id]);
            }
            $this->Flash->error('Planté');
        }
        $this->set(compact('new'));
    }

    public function edit($id)
    {
        $album = $this->Albums->get($id);

        if ($this->request->is(['post', 'put'])) {

            $this->Albums->patchEntity($album, $this->request->getData());
            if ($this->Albums->save($album)) {
                $this->Flash->success('Modif ok');
                return $this->redirect(['action' => 'view', $album->id]);
            }
            $this->Flash->error('Modif planté');
        }
        $this->set(compact('album'));
    }

    public function delete($id)
    {
        if($this->request->is(['post', 'delete'])){
            $album = $this->Albums->get($id);
            
            if ($this->Albums->delete($album)) {
                $this->Flash->success('Supprimé');
                return $this->redirect(['controller' => 'artists', 'action' => 'view', $album->artist_id]);
            }else{
                $this->Flash->error('Supprimession planté');
                return $this->redirect(['action' => 'view', $album->id]);
            }
        }else{ 
            throw new NotFoundException('Methode interdite (c\'est pas beau de tricher)');   
        }
    }

    public function editImage($id)
    {
        $album = $this->Albums->get($id);

        $old_cover = $album->cover;
        $old = WWW_ROOT.'data/pictures/'.$album->cover;

        if ($this->request->is(['post', 'put'])) {

            $this->Albums->patchEntity($album, $this->request->getData());

            if (in_array($this->request->getData()['cover']['type'], ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])) {

                $ext = pathinfo($this->request->getData()['cover']['name'], PATHINFO_EXTENSION);

                $name = 'a-'.rand(0,3000).'-'.time().'.'.$ext;

                $address = WWW_ROOT.'data/covers/'.$name;

                $album->cover = $name;

                move_uploaded_file($this->request->getData('cover')['tmp_name'], $address);

                if ($this->Albums->save($album)) {

                    if (!empty($old_cover) && file_exists($old)){
                        unlink($old);
                    }

                    $this->Flash->success('Image modifiée');

                    return $this->redirect(['action' => 'view', $album->id]);

                }else{
                    $this->Flash->error('Image non modifiée');
                }

            }else{
                $album->cover = $old_cover;
                $this->Flash->error('Ce format de fichier n\'est pas autorisé');
            }
        }
        $this->set(compact('album'));
    }

    public function deleteImage($id)
    {
        if($this->request->is(['post'])){
            $album = $this->Albums->get($id);
            $old_cover= $album->cover;
            $old = WWW_ROOT.'data/covers/'.$album->cover;
            if (!empty($old_cover) && file_exists($old)){
                unlink($old);
            }
            $album->cover = null;
            $this->Albums->save($album);
            $this->Flash->success('Image supprimée');
            return $this->redirect(['action' => 'view', $album->id]);
            
        }else{
            throw new NotFoundException('Access denied, try again');   
        }
        
    }
}
