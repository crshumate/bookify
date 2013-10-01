<?
echo $this->Form->create('Note');
echo $this->Form->input('title');
echo $this->Form->input('note');
echo $this->Form->input('story_id', array(
	'type'=>'select', 
	'options'=>$storyOptions,
	'empty'=>false,
	'selected'=>$storyId
	)
);
echo $this->Form->submit('Save Note');
echo $this->Form->end();


?>