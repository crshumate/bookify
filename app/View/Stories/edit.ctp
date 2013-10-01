<?php

echo $this->Form->create('Story');
echo $this->Form->input('title');
echo $this->Form->input('description', array('type'=>'textarea'));
echo $this->Form->input('plot_id', array('type'=>'select', 'options'=>$plotOptions));
echo $this->Form->submit();
echo $this->Form->end();



?>