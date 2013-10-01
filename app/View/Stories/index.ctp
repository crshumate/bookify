
<div id="steps" class="row">
	<div class="span2 step">
		<p><?= $this->Html->link('Create Story', array('controller'=>'stories', 'action'=>'create')); ?></p>
	</div>
	<div class="span2 step">
		<p><?= $this->Html->link('Create Character', array('controller'=>'characters', 'action'=>'create')); ?></p>
	</div>
	<div class="span2 step">
		<p><?= $this->Html->link('Character Development', array('controller'=>'characters', 'action'=>'view')); ?></p>
	</div>
	<div class="span2 step">
		<p><?= $this->Html->link('Story Settings', array('controller'=>'stories', 'action'=>'edit')); ?></p>
	</div>
	
	<div class="span2 step">
		<p><?= $this->Html->link('Notes', array('controller'=>'notes', 'action'=>'create')); ?></p>
	</div>
	
	<?php if ($user['role_id']==1) :?>
 	<div class="clear span12"><hr /></div>
	
	<h2 class="clear">Admin Features</h2>
	
	<div class="span2 step">
		<p><?= $this->Html->link('Plot Steps', array('admin' => true, 'controller' => 'plot_steps', 'action' => 'index'));
		?></p>
		
	</div>
	
	<div class="span2 step">
		<p><?= $this->Html->link('Character Profile Questions', array('admin' => true, 'controller' => 'charquests', 'action' => 'create'));
		?></p>
		
	</div>
	<div class="span2 step">
		<p><?= $this->Html->link('Character Types', array('admin' => true, 'controller' => 'character_types', 'action' => 'create'));
		?></p>
		
	</div>
	<?php endif; ?>
	
</div>

<!--<h2>Your Stories</h2>
<hr />


<ul>
<?php

foreach($stories as $story){
	
	$title=$story['Story']['title'];
	$desc = $story['Story']['description'];
	$id = $story['Story']['id'];
	$li = sprintf("<li class='story'><h2><a href='edit/%s'>%s</a></h2><p>%s</p></li>", $id, $title, $desc);
	echo $li;
	}

?>	
</ul>-->