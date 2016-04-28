<?php

class FileParser
{
    protected $handle;
    protected $data;

    public function __construct($filename)
    {
        $this->handle = fopen($filename, "r");
        $this->parseFile();
    }
    public function __toString()
    {
        return json_encode($this->data);
    }
    protected function parseFile()
    {
        if ($this->handle) {
            while (($line = fgets($this->handle)) !== false) {
                $this->parseLine($line);
            }
            fclose($this->handle);
        }
    }
    protected function parseLine($line)
    {
        $line = preg_replace('/ +/', ' ', $line);
        $arr  = explode(' ', $line);

        $temp     = $this->parseTemp($arr[1]);
        $humidity = $this->parseHumidity($arr[2]);

        $this->data['temp'][]     = $temp;
        $this->data['humidity'][] = $humidity;

        if ($temp && $humidity) {
            $this->data['time'][] = $this->parseTime($arr[0]);
        }
    }

    protected function parseTime($time)
    {
        return date('H:i', $time);
    }
    protected function valueOnly($str)
    {
        return substr($str, strpos($str, '=') + 1);
    }
    protected function parseTemp($temp)
    {
        return (float) $this->valueOnly($temp);
    }
    protected function parseHumidity($humidity)
    {
        return (float) $this->valueOnly($humidity);
    }
}
