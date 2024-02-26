<?php
require_once 'vendor/autoload.php';
session_start();

$counter = new Counter();

if (!Visitor::isCounted()) {
    $counter->incrementCount();
}


echo "Unique visits: " . $counter->getCount();




?>