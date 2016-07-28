<?php

use PHPUnit\Framework\TestCase;
use TempApp\Adapter\Db;
use TempApp\FileParser;

class DbAdapterTest extends TestCase {
	protected $parser;
	public function setUp() {
		$this->parser = new FileParser;
		$this->parser->readFile('tests/assets/dummy.txt');
	}
	public function testThatItOutputsJsonData() {
		$dbAdapter = new Db;
		$dbAdapter->setData($this->parser->getData());
		// test $dbAdapter->output();
	}
}
