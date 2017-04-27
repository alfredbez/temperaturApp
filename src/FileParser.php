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

        $this->importToDb();

		return $this->data;
	}
	protected function parseLine($line) {
		$line = preg_replace('/ +/', ' ', $line);
		$arr = explode(' ', $line);

		if (!array_filter($arr)) {
		    return;
        }

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
		return date('d.m.Y - H:i', $time);
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

    protected function importToDb() {
        $values = [];
        for ($i=0; $i < count($this->data['time']); $i++) {
            $values[] = '('.implode(',', [
                $this->data['timestamp'][$i],
                $this->data['temp'][$i],
                $this->data['humidity'][$i],
            ]).')';
        }
        $values = implode(',', $values);
        $query = "INSERT INTO
            data (timestamp, temperatur, humidity)
            VALUES $values
            ON DUPLICATE KEY UPDATE timestamp=timestamp";

        $mysqli = new \mysqli(
            getenv("MYSQL_HOST"),
            getenv("MYSQL_USER"),
            getenv("MYSQL_PASS"),
            getenv("MYSQL_NAME")
        );
        $mysqli->query($query);
    }
}
