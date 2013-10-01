<!DOCTYPE html> 

<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<? $file_name = sprintf('book.%s-%s', $this->params['controller'],$this->params['action']);?>
	<?=  $this->Html->css(array('book.base', $file_name));?>
	
<body>
	<div id="wrapper" class="span12">
		<div id="inner-wrapper">
		
		<?if($this->params['controller']=='stories' && $this->params['action']=='index') :?>
		<select id="story-select">
		<?
		foreach($storyOptions as $i=>$story){
			$optionVal = $i;
			$optionTitle = $story;
			if($optionVal == $storyId){
				$selected="selected='selected'";
				$class="class='selected'";
			} else{
				$selected = null;
				$class = null;
			}
			echo sprintf("<option %s %s value='%s'>%s</option>", $class, $selected, $optionVal, $optionTitle);

		}

		?>
		</select>	
		<?php endif;?>	
		
	<nav>
		<ul>
			<li><?= $this->Html->link('Home', array('controller'=>'stories', 'action'=>'index', 'admin'=>false));?></li>
			<li><?= $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout'));?></li>
			
			<?php
			 if((isset($user) && $this->params['admin']) && $user['role_id']=='1') :?>
				<hr />
				
			<li><?= $this->Html->link('Leave Admin', array('controller'=>'stories', 'action'=>'index', 'admin'=>false));?></li>
			<?php endif;?>
			
		</ul>
		
		</nav>	
		<?php echo $this->Session->flash();?> 		
<?= $content_for_layout; ?>
	</div>
</div>

<?= $this->Html->script(array('jquery-1.8.0.min.js','bootstrap.min', 'book.base', $file_name))?>

</body>
</html>
