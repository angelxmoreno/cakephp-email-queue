<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Email Queue');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($emailQueue['EmailQueue']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('To'); ?></dt>
			<dd>
				<?php echo h($emailQueue['EmailQueue']['to']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('To Name'); ?></dt>
			<dd>
				<?php echo h($emailQueue['EmailQueue']['to_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('From Name'); ?></dt>
			<dd>
				<?php echo h($emailQueue['EmailQueue']['from_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('From Email'); ?></dt>
			<dd>
				<?php echo h($emailQueue['EmailQueue']['from_email']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Subject'); ?></dt>
			<dd>
				<?php echo h($emailQueue['EmailQueue']['subject']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Config'); ?></dt>
			<dd>
				<?php echo h($emailQueue['EmailQueue']['config']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Template'); ?></dt>
			<dd>
				<?php echo h($emailQueue['EmailQueue']['template']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Layout'); ?></dt>
			<dd>
				<?php echo h($emailQueue['EmailQueue']['layout']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Domain'); ?></dt>
			<dd>
				<?php echo h($emailQueue['EmailQueue']['domain']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Format'); ?></dt>
			<dd>
				<?php echo h($emailQueue['EmailQueue']['format']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Template Vars'); ?></dt>
			<dd>
				<?php echo h($emailQueue['EmailQueue']['template_vars']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Sent'); ?></dt>
			<dd>
				<?php echo h($emailQueue['EmailQueue']['sent']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Locked'); ?></dt>
			<dd>
				<?php echo h($emailQueue['EmailQueue']['locked']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Send Tries'); ?></dt>
			<dd>
				<?php echo h($emailQueue['EmailQueue']['send_tries']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Send At'); ?></dt>
			<dd>
				<?php echo h($emailQueue['EmailQueue']['send_at']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($emailQueue['EmailQueue']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($emailQueue['EmailQueue']['modified']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Email Queue')), array('action' => 'edit', $emailQueue['EmailQueue']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Email Queue')), array('action' => 'delete', $emailQueue['EmailQueue']['id']), null, __('Are you sure you want to delete # %s?', $emailQueue['EmailQueue']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Email Queues')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Email Queue')), array('action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

