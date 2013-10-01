<h2>Login</h2>
<?php

echo $this->Form->create('User');
echo $this->Session->flash();
echo $this->Session->flash('Auth');
echo $this->Form->input('username', array('label'=>'email'));
echo $this->Form->input('password', array('label'=>'password'));
echo $this->Form->submit('Login', array('class'=>'btn'));
echo $this->Form->end();

?>
<ul>
	
	<li><?php echo $this->Html->link('Create Account',array('controller'=>'users', 'action'=>'create'));?></li>
</ul>