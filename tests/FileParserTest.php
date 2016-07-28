<?php

use PHPUnit\Framework\TestCase;
use TempApp\FileParser;

class FileParserTest extends TestCase {
	protected $parser;
	public function setUp() {
		$this->parser = new FileParser;
		$this->parser->readFile('tests/assets/dummy.txt');
	}
	public function testThatItParsesTemperature() {
		$this->assertEquals(21.9, $this->parser->getData()['temp'][0]);
		$this->assertEquals(20.9, $this->parser->getData()['temp'][1]);
	}
	public function testThatItParsesHumidity() {
		$this->assertEquals(58.7, $this->parser->getData()['humidity'][0]);
		$this->assertEquals(68.7, $this->parser->getData()['humidity'][1]);
	}
	public function testThatItParsesTimestamp() {
		$this->assertEquals(1469733250, $this->parser->getData()['timestamp'][0]);
		$this->assertEquals(1469734250, $this->parser->getData()['timestamp'][1]);
	}
}
