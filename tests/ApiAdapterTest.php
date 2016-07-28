<?php

use PHPUnit\Framework\TestCase;
use TempApp\Adapter\Api;
use TempApp\FileParser;

class ApiAdapterTest extends TestCase {
	protected $parser;
	public function setUp() {
		$this->parser = new FileParser;
		$this->parser->readFile('tests/assets/dummy.txt');
	}
	public function testThatItOutputsJsonData() {
		$apiAdapter = new Api;
		$apiAdapter->setData($this->parser->getData());
		$this->assertEquals(
			'{"temp":[21.9,20.9],"humidity":[58.7,68.7],"timestamp":["1469733250","1469734250"],"time":["19:14","19:30"]}',
			$apiAdapter->output()
		);
	}
}
