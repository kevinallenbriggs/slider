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
	public function testNewSlideObjectWithPartialParams() {
		$params = array('name' => 'test slide',
						'caption' => 'test caption',
						'publication_status' => true);
		$slide = new Slide($params);
		$this->assertTrue($slide->name == 'test slide');
		$this->assertTrue($slide->caption == 'test caption');
		$this->assertTrue($slide->publication_status == true);

		foreach ($slide as $key => $value) {
			$slide_params[$key] = $value;
		}
		$this->assertArraySubset($params, $slide_params);
	}
}
?>