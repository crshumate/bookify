<?php
class PlotDevStepsController extends AppController {
		public $theme = 'Book';
	
	public function beforeFilter(){
	
	}
	
	public function development ($id=null){
		$storyId = CakeSession::read('storyId');
		
		//get $plotId from $story
		$story = $this->PlotDevStep->Story->findById($storyId);
		$plotId = $story['Story']['plot_id'];
	
		//get at all set $plotDev
		$plotDev = $this->PlotDevStep->findAllByStoryId($storyId);
		
		//create unsetArray for plotStep dd
		$unsetArr=array();
		foreach($plotDev as $dev){
		 $unsetArr[]=$dev['PlotDevStep']['plot_step_id'];
		}
		$this->set('unsetArr', $unsetArr);
		
		//get all $plotSteps for this $plotId
		$plotSteps = $this->PlotDevStep->PlotStep->findAllByPlotId($plotId);
		
		
		$this->set('plotSteps', $plotSteps);
		
		//get PlotStep Options
		$psOptions = array();
		foreach($plotSteps as $step){
			$psOptions[$step['PlotStep']['id']]=$step['PlotStep']['title'];
		}
	
		$this->set('psOptions', $psOptions);
	}
}	
?>