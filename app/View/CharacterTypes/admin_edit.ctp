<?
echo $this->Form->create('CharacterType');
echo $this->Form->input('type');
echo $this->Form->input('description');
echo $this->Form->submit('Save');
echo $this->Form->end();

pr($this->params);

?>
