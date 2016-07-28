<?php

use PHPUnit\Framework\TestCase;
use TempApp\FileParser;

class FileParserReadTest extends TestCase {
	public function testThatItCanReadAFile() {
		$path = 'tests/assets/dummy.txt';

		$parser = new FileParser;
		// can read that file
		$this->assertTrue($parser->readFile($path));
	}
}
