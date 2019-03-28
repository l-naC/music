<?php
//src/Controller/RequestsController.php

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
class RequestsController extends AppController
{
	public function index()
    {
    	$requests = $this->Requests->find();
    	$requests->where(['status' => 'pending']);

    	$requests_accept = $this->Requests->find();
    	$requests_accept->where(['status' => 'accept']);

    	$requests_decline = $this->Requests->find();
    	$requests_decline->where(['status' => 'decline']);

        $this->set(compact('requests', 'requests_accept', 'requests_decline'));
    }

    public function add()
    {
        $new = $this->Requests->newEntity();
        $new->user_id = $this->Auth->user('id');
        if ($this->request->is('post')) {
            $new = $this->Requests->patchEntity($new, $this->request->getData());

            if ($this->Requests->save($new)) {
                $this->Flash->success('Ok');

               return $this->redirect(['controller' => 'artists', 'action' => 'index']);
            }
            $this->Flash->error('Planté');
        }
        $this->set(compact('new'));
    }

    public function accept($id)
    {
    	$request_accept = $this->Requests->get($id);

        if ($this->request->is(['post', 'put'])) {

            $this->Requests->patchEntity($request_accept, $this->request->getData());
            $request_accept->status= 'accept';
            if ($this->Requests->save($request_accept)) {
                $this->Flash->success('Modif ok');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Modif planté');
        }
    }

    public function decline($id)
    {
    	$request_decline = $this->Requests->get($id);

        if ($this->request->is(['post', 'put'])) {

            $this->Requests->patchEntity($request_decline, $this->request->getData());
            $request_decline->status = 'decline';
            if ($this->Requests->save($request_decline)) {
                $this->Flash->success('Modif ok');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Modif planté');
        }
    }
}