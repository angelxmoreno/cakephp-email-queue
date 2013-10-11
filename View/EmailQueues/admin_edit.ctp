<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('EmailQueue', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Admin Edit %s', __('Email Queue')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('to', array());
				echo $this->BootstrapForm->input('to_name');
				echo $this->BootstrapForm->input('from_name', array());
				echo $this->BootstrapForm->input('from_email', array());
				echo $this->BootstrapForm->input('subject', array());
				echo $this->BootstrapForm->input('config', array());
				echo $this->BootstrapForm->input('template', array());
				echo $this->BootstrapForm->input('layout', array());
				echo $this->BootstrapForm->input('domain');
				echo $this->BootstrapForm->input('format', array());
				echo $this->BootstrapForm->input('template_vars', array(
				    'value' => json_encode($this->request->data['EmailQueue']['template_vars'])
				));
				echo $this->BootstrapForm->input('sent', array());
				echo $this->BootstrapForm->input('locked', array());
				echo $this->BootstrapForm->input('send_tries', array());
				echo $this->BootstrapForm->input('send_at');
				echo $this->BootstrapForm->hidden('id');
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('EmailQueue.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('EmailQueue.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Email Queues')), array('action' => 'index'));?></li>
		</ul>
		</div>
	</div>
</div>