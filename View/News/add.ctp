<div class="news form">
<?php echo $this->Form->create('News');?>
	<fieldset>
 		<legend><?php echo __('Add News'); ?></legend>
	<?php
		echo $this->Form->input('url');
		echo $this->Form->input('name');
		echo $this->Form->hidden('user_id', array('value' => $this->Session->read('Auth.User.id')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List News', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>