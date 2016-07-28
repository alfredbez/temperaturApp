<?php

namespace TempApp;

class FileParser {
	protected $handle;
	protected $data;

	public function readFile($filepath) {
		$this->rawData = file_get_contents($filepath);

		return (bool) $this->rawData;
	}
	public function getData() {
		foreach (explode("\n", $this->rawData) as $line) {
			$this->parseLine($line);
		}

		return $this->data;
	}
	protected function parseLine($line) {
		$line = preg_replace('/ +/', ' ', $line);
		$arr = explode(' ', $line);

		$temp = $this->parseTemp($arr[1]);
		$humidity = $this->parseHumidity($arr[2]);

		$this->data['temp'][] = $temp;
		$this->data['humidity'][] = $humidity;

		if ($temp && $humidity) {
			$this->data['timestamp'][] = $arr[0];
			$this->data['time'][] = $this->parseTime($arr[0]);
		}
	}

	protected function parseTime($time) {
		return date('H:i', $time);
	}
	protected function valueOnly($str) {
		return substr($str, strpos($str, '=') + 1);
	}
	protected function parseTemp($temp) {
		return (float) $this->valueOnly($temp);
	}
	protected function parseHumidity($humidity) {
		return (float) $this->valueOnly($humidity);
	}
}
