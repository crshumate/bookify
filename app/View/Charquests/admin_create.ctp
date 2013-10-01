<?php
echo $this->Form->create('Charquest');
echo $this->Form->input('question');
echo $this->Form->input('charquest_type_id', array('type'=>'select', 'options'=>$typeOptions));
echo $this->Form->submit();
echo $this->Form->end();



?>