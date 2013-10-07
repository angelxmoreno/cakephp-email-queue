<?php

App::uses('AppModel', 'Model');

/**
 * EmailQueue model
 *
 */
class EmailQueue extends AppModel {

/**
 * Name
 *
 * @var string $name
 * @access public
 */
	public $name = 'EmailQueue';

/**
 * Database table used
 *
 * @var string
 * @access public
 */
	public $useTable = 'email_queue';

/**
 * Stores a new email message in the queue
 *
 * Enqueue a single email:
 *
 * `$this->EmailQueue->enqueue('john@example.com');`
 *
 * Enqueue a single email with a name:
 *
 * `$this->EmailQueue->enqueue(array('john@example.com' => 'John Doe'));`
 *
 * Enqueue multiple emails using a combination of single emails with name and single email with no name:
 *
 * `$this->EmailQueue->enqueue(array(
 *	'jane@example.com',
 *	array('john@example.com' => 'John Doe')
 * );`
 *
 *
 * @param mixed $to String with email, Array with email as key or an Array using a combination of both
 * @param array $data associative array of variables to be passed to the email template
 * @param array $options list of options for email sending. Possible keys:
 *
 * - subject : Email's subject
 * - send_at : date time sting representing the time this email should be sent at (in UTC)
 * - template :  the name of the element to use as template for the email message
 * - layout : the name of the layout to be used to wrap email message
 * - format: Type of template to use (html, text or both)
 * - config : the name of the email config to be used for sending
 * - from_email : The email address which the email is to be sent from
 * - from_name : The name used in the `from`
 *
 *
 * @return void
 */
	public function enqueue($to, array $data = array(), $options = array()) {
		$defaults = array(
			'subject' => '',
			'send_at' => gmdate('Y-m-d H:i:s'),
			'template' => 'default',
			'layout' => 'default',
			'format' => 'both',
			'template_vars' => $data,
			'config' => 'default'
		);

		$email = $options + $defaults;
		$recipients = !is_array($to) ? array($to) : $to;
		foreach ($recipients as $to => $to_name) {
			$email['to'] = null;
			$email['to_name'] = null;
			if (is_int($to) && !is_array($to_name)) {
				$email['to'] = $to_name;
			} elseif(is_int($to) && is_array($to_name)) {
				$email['to'] = key($to_name);
				$email['to_name'] = current($to_name);
			} elseif(is_string($to) && is_string($to_name)) {
				$email['to'] = $to;
				$email['to_name'] = $to_name;
			}

			$this->create();
			$this->save($email);
		}
	}

/**
 * Returns a list of queued emails that needs to be sent
 *
 * @param integer $size, number of unset emails to return
 * @return array list of unsent emails
 * @access public
 */
	public function getBatch($size = 10) {
		$this->getDataSource()->begin();

		$emails = $this->find('all', array(
			'limit' => $size,
			'conditions' => array(
				'EmailQueue.sent' => false,
				'EmailQueue.send_tries <=' => 3,
				'EmailQueue.send_at <=' => gmdate('Y-m-d H:i:s'),
				'EmailQueue.locked' => false
			),
			'order' => array('EmailQueue.created' => 'ASC')
		));

		if (!empty($emails)) {
			$ids =  Set::extract('{n}.EmailQueue.id', $emails);
			$this->updateAll(array('locked' => true), array('EmailQueue.id' => $ids));
		}

		$this->getDataSource()->commit();
		return $emails;
	}

/**
 * Releases locks for all emails in $ids
 *
 * @return void
 **/
	public function releaseLocks($ids) {
		$this->updateAll(array('locked' => false), array('EmailQueue.id' => $ids));
	}

/**
 * Releases locks for all emails in queue, useful for recovering from crashes
 *
 * @return void
 **/
	public function clearLocks() {
		$this->updateAll(array('locked' => false));
	}

/**
 * Marks an email from the queue as sent
 *
 * @param string $id, queued email id
 * @return boolean
 * @access public
 */
	public function success($id) {
		$this->id = $id;
		return $this->saveField('sent', true);
	}

/**
 * Marks an email from the queue as failed, and increments the number of tries
 *
 * @param string $id, queued email id
 * @return boolean
 * @access public
 */
	public function fail($id) {
		$this->id = $id;
		$tries = $this->field('send_tries');
		return $this->saveField('send_tries', $tries + 1);
	}

/**
 * Converts array data for template vars into a json serialized string
 *
 * @param array $options
 * @return boolean
 **/
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['template_vars'])) {
			$this->data[$this->alias]['template_vars'] = json_encode($this->data[$this->alias]['template_vars']);
		}

		return parent::beforeSave($options);
	}

/**
 * Converts template_vars back into a php array
 *
 * @param array $results
 * @param boolean $primary
 * @return array
 **/
	public function afterFind($results, $primary = false) {
		if (!$primary) {
			return parent::afterFind($results, $primary);
		}

		foreach ($results as &$r) {
			if (!isset($r[$this->alias]['template_vars'])) {
				return $results;
			}
			$r[$this->alias]['template_vars'] = json_decode($r[$this->alias]['template_vars'], true);
		}

		return $results;
	}

}
