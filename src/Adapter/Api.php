<?php

namespace TempApp\Adapter;

use TempApp\Interfaces\Outputable;
use TempApp\Traits\GetDataFromParser;

class Api implements Outputable {
	use GetDataFromParser;
	public function output() {
		return json_encode($this->data);
	}
}
