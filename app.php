<?php

require 'bootstrap.php';

$parser = new TempApp\FileParser;
$parser->readFile(getenv('DATA_PATH'));

$apiAdapter = new TempApp\Adapter\Api;
$apiAdapter->setData($parser->getData());
