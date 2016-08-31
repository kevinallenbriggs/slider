<?php
	function dirScan($dir) {
	
	    $include = array("css");
	    if (isset($dir) && is_readable($dir)){
	        $dlist = array();
	        $dir = realpath($dir);
	        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir,RecursiveDirectoryIterator::KEY_AS_PATHNAME),RecursiveIteratorIterator::SELF_FIRST, RecursiveIteratorIterator::CATCH_GET_CHILD);
	
	        foreach($objects as $entry){
				if(in_array(pathinfo($entry)['extension'], $include)){
					$dlist[] = str_replace($dir . '/', '', $entry);
                }
	        }    
	        
	        return $dlist;
	    }
	
	}
?>