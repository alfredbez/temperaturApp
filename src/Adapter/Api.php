<?php

namespace TempApp\Adapter;

use TempApp\Interfaces\Outputable;
use TempApp\Traits\GetDataFromParser;

class Api implements Outputable {
	use GetDataFromParser;

    protected $type;

    protected $types = [
        'year' => [
            'interval' => 10080, // week = 60 minutes * 24 * 7
            'limit' => 52,
        ],
        'month' => [
            'interval' => 1440, // day = 60 minutes * 24
            'limit' => 30,
        ],
        'week' => [
            'interval' => 720, // half day = 60 minutes * 12
            'limit' => 14,
        ],
        'day' => [
            'interval' => 30, // half hour
            'limit' => 48,
        ],
        '3hours' => [
            'interval' => 3,
            'limit' => 60,
        ],
        'hour' => [
            'interval' => 1,
            'limit' => 60,
        ],
    ];

    protected $defaultType = 'hour';

	public function output() {
		return json_encode($this->getData());
	}

    public function setType($type) {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type ?: $this->defaultType;
    }

    protected function getInterval()
    {
        return $this->types[$this->getType()]['interval'];
    }

    protected function getLimit()
    {
        return $this->types[$this->getType()]['limit'];
    }

    protected function getData() {
        $data = [];
        // getting interval values
        foreach ($this->data as $dataType => $array) {
            $i = 0;
            $result = [];
            foreach ($array as $value) {
                if ($i++ % $this->getInterval() === 0) {
                    $result[] = $value;
                }
            }
            $data[$dataType] = $result;
        }

        // extracting only latest data
        if ($this->getLimit()) {
            $slicedArray = [];
            foreach ($data as $key => $data) {
                $slicedArray[$key] = array_slice($data, -1 * $this->getLimit());
            }
            return $slicedArray;
        }

        return $this->data;
    }
}
