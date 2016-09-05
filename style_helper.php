<?php
	class StyleHelper {
		
		// ensure that a new StyleHelper object can't be created
		private function __construct() {}
		private function __clone() {}
		
		// allow the class to scan for CSS files
		public static function scan($dir) {
			// the extension of the files we are scanning for
		    static $include = array("css");
		    
		    if (isset($dir) && is_readable($dir)){		// validate the input
		        $dlist = array();
		        $dir = realpath($dir);				// get the full path to the directory
		        
		        // recursively scan the path for all files
		        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir,RecursiveDirectoryIterator::KEY_AS_PATHNAME),RecursiveIteratorIterator::SELF_FIRST, RecursiveIteratorIterator::CATCH_GET_CHILD);
		        
		        // examine all the files found
		        foreach($objects as $entry){
					if(in_array(pathinfo($entry)['extension'], $include)){
						$dlist[] = str_replace($dir . '/', '', $entry);		// save only the files which have extensions included in $include[]
	                }
		        }    
		        
		        return $dlist;
		    }
		
		}
	}
?>