<?php

App::uses('AppController', 'Controller');

/**
 * EmailQueues Controller
 *
 * @property EmailQueue $EmailQueue
 */
class EmailQueuesController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny();
		if(!isset($this->params['prefix']) || !isset($this->params['admin']) || $this->params['admin'] !== true){
			$redirect = am($this->request->params,array('admin'=>true));
			$this->redirect($redirect);
		}
	}
	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->EmailQueue->recursive = 0;
		$this->set('emailQueues', $this->Paginator->paginate());
	}

	/**
	 * admin_view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this->EmailQueue->id = $id;
		if (!$this->EmailQueue->exists()) {
			throw new NotFoundException(__('Invalid %s', __('email queue')));
		}
		$this->set('emailQueue', $this->EmailQueue->read(null, $id));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->EmailQueue->create();
			if ($this->EmailQueue->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('email queue')), 'alert', array(
				    'plugin' => 'TwitterBootstrap',
				    'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('email queue')), 'alert', array(
				    'plugin' => 'TwitterBootstrap',
				    'class' => 'alert-error'
					)
				);
			}
		}
	}

	/**
	 * admin_edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this->EmailQueue->id = $id;
		if (!$this->EmailQueue->exists()) {
			throw new NotFoundException(__('Invalid %s', __('email queue')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['EmailQueue']['template_vars'] = json_decode($this->request->data['EmailQueue']['template_vars'], true);
			if ($this->EmailQueue->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('email queue')), 'alert', array(
				    'plugin' => 'TwitterBootstrap',
				    'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('email queue')), 'alert', array(
				    'plugin' => 'TwitterBootstrap',
				    'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->EmailQueue->read(null, $id);
		}
	}

	/**
	 * admin_delete method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->EmailQueue->id = $id;
		if (!$this->EmailQueue->exists()) {
			throw new NotFoundException(__('Invalid %s', __('email queue')));
		}
		if ($this->EmailQueue->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('email queue')), 'alert', array(
			    'plugin' => 'TwitterBootstrap',
			    'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('email queue')), 'alert', array(
		    'plugin' => 'TwitterBootstrap',
		    'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
	}

}
