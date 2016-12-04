<?php

require_once "app/models/slide.php";

class SlideTest extends PHPUnit_Framework_TestCase {

	// create a new slide with only a name
	public function testNewSlideObjectWithNameOnly() {
		$slideName = 'test name';
		$slide = new Slide($slideName);
		$this->assertTrue($slide->name == $slideName);
	}

	// create a new slide with a partial list of parameters
	public function testNewSlideObjectWithParams() {
		$params = array('id'				 => 1,
						'name'				 => 'test slide',
						'caption'			 => 'test caption',
						'type'				 => 'image/jpeg',
						'path_to_image'		 => '/some_directory',
						'publication_status' => true,
						'expiration_date'	 => date('Y-m-d'),
						'tmp_name'			 => 'this is where php stores me',
						'size'				 => 1000000);
		
		$slide = new Slide($params);

		foreach ($slide as $key => $value) {
			$slide_params[$key] = $value;
		}
		$this->assertEquals($slide_params, $params);
	}
}
?>