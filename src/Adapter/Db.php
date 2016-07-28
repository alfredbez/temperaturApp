<?php

namespace TempApp\Adapter;

use TempApp\Interfaces\Outputable;
use TempApp\Traits\GetDataFromParser;

class Db implements Outputable {
	use GetDataFromParser;
	public function output() {
		// save in Db
		// pdo?
	}
}
