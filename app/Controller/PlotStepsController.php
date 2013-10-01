<?php
class PlotStepsController extends AppController {
	public $theme = 'Book';
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('admin_ajax_edit', 'admin_ajax_delete'));	
		$uid = $this->Auth->user('id');
		//if(isset($this->params['admin']))

	}
	public function admin_ajax_edit($id=null){
		$this->autoRender=false;
	$this->PlotStep->id = $id;
	return json_encode($this->PlotStep->read());	
	}
	
	public function admin_index(){
		if($_GET){
			$this->set('openAcc', $_GET['openAcc']);
		}else{
			$this->set('openAcc', 0);	
		}
		$plots = $this->PlotStep->Plot->find('all', array('fields'=>array("Plot.id", "Plot.type")));
		$plotOptions=array();
		$plotSteps = $this->PlotStep->find('all');
	    $formatted=array();	
		foreach($plots as $plot){
			$id=$plot['Plot']['id'];
			$type = $plot['Plot']['type'];
			$formatted[$type]=array();
			foreach($plotSteps as $step){
				if($step['PlotStep']['plot_id']==$id){
					array_push($formatted[$type], $step);	
				}
			}
		}
		$this->set('plots', $formatted);		
	
		foreach($plots as $plot){
		 $plotOptions[$plot['Plot']['id']] = $plot['Plot']['type'];	
		}
		$this->set('plotOptions', $plotOptions);
		if($this->request->is('post')){
			
			$data=$this->request->data;
			if($saved=$this->PlotStep->save($data)){
				$this->Session->setFlash('Plot Step Saved!');
				$this->redirect('/admin/plot_steps?openAcc='.($saved['PlotStep']['plot_id']-1));
				
			}
		}
	}


	public function admin_ajax_delete($id=null){
		$this->autoRender=false;
		if($deleted=$this->PlotStep->delete($id)){
			return json_encode('success');
		}else{
			return json_encode('fail');
		}
	
		
	}
	
	public function admin_ajax_save(){
		$this->autoRender=false;
		if($this->request->is('post')){
			$data=$this->request->data;
			if($saved=$this->PlotStep->save($data)){
				return json_encode($saved);
			}
		}
		return 'false';
	}


}

?>