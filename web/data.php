<?php

require __DIR__ . '/../app.php';

if (isset($_GET['type']) && !empty($_GET['type'])) {
    $apiAdapter->setType($_GET['type']);
}
echo "var data={$apiAdapter->output()};";
