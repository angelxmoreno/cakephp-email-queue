<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('List %s', __('Email Queues'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('to');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('to_name');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('from_name');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('from_email');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('subject');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('config');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('template');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('layout');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('format');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('template_vars');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('sent');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('locked');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('send_tries');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('send_at');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($emailQueues as $emailQueue): ?>
			<tr>
				<td nowrap="nowrap"><?php echo h($emailQueue['EmailQueue']['to']); ?>&nbsp;</td>
				<td nowrap="nowrap"><?php echo h($emailQueue['EmailQueue']['to_name']); ?>&nbsp;</td>
				<td nowrap="nowrap"><?php echo h($emailQueue['EmailQueue']['from_name']); ?>&nbsp;</td>
				<td nowrap="nowrap"><?php echo h($emailQueue['EmailQueue']['from_email']); ?>&nbsp;</td>
				<td nowrap="nowrap"><?php echo h($emailQueue['EmailQueue']['subject']); ?>&nbsp;</td>
				<td nowrap="nowrap"><?php echo h($emailQueue['EmailQueue']['config']); ?>&nbsp;</td>
				<td nowrap="nowrap"><?php echo h($emailQueue['EmailQueue']['template']); ?>&nbsp;</td>
				<td nowrap="nowrap"><?php echo h($emailQueue['EmailQueue']['layout']); ?>&nbsp;</td>
				<td nowrap="nowrap"><?php echo h($emailQueue['EmailQueue']['format']); ?>&nbsp;</td>
				<td nowrap="nowrap"><?php echo h($emailQueue['EmailQueue']['template_vars']); ?>&nbsp;</td>
				<td nowrap="nowrap"><?php echo h($emailQueue['EmailQueue']['sent']); ?>&nbsp;</td>
				<td nowrap="nowrap"><?php echo h($emailQueue['EmailQueue']['locked']); ?>&nbsp;</td>
				<td nowrap="nowrap"><?php echo h($emailQueue['EmailQueue']['send_tries']); ?>&nbsp;</td>
				<td nowrap="nowrap"><?php echo h($emailQueue['EmailQueue']['send_at']); ?>&nbsp;</td>
				<td nowrap="nowrap"><?php echo h($emailQueue['EmailQueue']['created']); ?>&nbsp;</td>
				<td nowrap="nowrap" class="actions btn-group">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $emailQueue['EmailQueue']['id']), array('class'=>'btn')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $emailQueue['EmailQueue']['id']), array('class'=>'btn')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $emailQueue['EmailQueue']['id']), array('class'=>'btn'), __('Are you sure you want to delete # %s?', $emailQueue['EmailQueue']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>

		<?php echo $this->BootstrapPaginator->pagination(); ?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Email Queue')), array('action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>