<?php 
App::uses('AppHelper', 'View/Helper');

class BookHelper extends AppHelper {
    public $helpers = array('Html', 'Form');

	public function unsetOptions($arr, $unsetArray){
		foreach($unsetArray as $i=>$unsetValue){
			foreach($arr as $j=>$a){
				if($unsetValue==$j){
					unset($arr[$j]);
				}
			}
			
		}
	   return $arr;	
	}

}

?>