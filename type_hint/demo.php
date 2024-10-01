<?php

declare(strict_types=1);

require_once 'I.php';
require_once 'C.php';
require_once 'A.php';
require_once 'B.php';

define('EOL', "<br>");

class Demo {
    public function typeAReturnA() : null {
        echo __FUNCTION__ . EOL;
        return null; 
    }
}

$demo = new Demo();
$demo->typeAReturnA();

