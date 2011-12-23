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
<?php 
// set the contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'News',
		'items' => array(
			$this->Html->link(__('List News', true), array('action' => 'index')),
			$this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')),
			$this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')),
			)
		),
	)));
?>