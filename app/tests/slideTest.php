<?php

require_once "app/models/slide.php";
require_once "connection.php";


class SlideTest extends PHPUnit_Framework_TestCase {

	// setup the test fixture
	public function setUp() {
		$this->slide_properties = array( 'id'				=> 1,
										 'name'				=> 'test slide',
										 'caption'			=> 'test caption',
										 'type'				=> 'image/jpeg',
										 'filename'			=> 'tests/test.jpg',
									 	 'published' 		=> true,
									 	 'expires'	 		=> date('Y-m-d'),
										 'size'				=> 1000000,
										 'tmp_name'			=> 'test.jpg');

		$this->slide = new Slide($this->slide_properties);
	}


	// tearDown the test fixture
	public function tearDown() {
		unset($this->slide_properties);
	}


	// create a new slide with only a name
	public function testNewSlideObjectWithNameOnly() {
		$this->slide = new Slide($this->slide_properties['name']);
		$this->assertTrue($this->slide->name == $this->slide_properties['name']);
	}


	// create a new slide with an array of parameters
	public function testNewSlideObjectWithParams() {
		
		foreach ($this->slide as $key => $value) {
			$slide_params[$key] = $value;
		}
		$this->assertArraySubset($this->slide_properties, $slide_params);
	}


	// retrieve all of the slides in the database
	public function testRetrieveAllSlidesFromDB() {
		$slides = Slide::all();
		foreach ($slides as $slide) {
			foreach ($this->slide_properties as $key => $value) {
				$this->assertArrayHasKey($key, (array)$slide);
			}
		}
	}


	// save a slide to the database
	public function testSaveAndRemoveSlideFromDatabaseAndFilesystem() {
		foreach ($this->slide as $key => $value) {
			switch ($key) {
				case 'name': break;
				case 'caption': break;
				case 'filename': break;
				default: $this->slide->$key = null;
			}
		}

		$result = $this->slide->upload();
		$this->assertInternalType('int', $result);
		$this->slide->id = $result;
		$this->assertEquals($this->slide->remove(true), 1);
	}
}
?>