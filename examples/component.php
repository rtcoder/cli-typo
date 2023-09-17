<?php

require_once 'vendor/autoload.php';

use Rtcoder\CliTypo\CliTypo;

$pass = CliTypo::component()->password('Password');
echo "your password is: " . $pass . PHP_EOL;

for ($i = 0; $i <= 100; $i++) {
    CliTypo::component()->progress($i);
    usleep(100000);
}
$arr = [
    ['name', 'surname'],
    ['John', 'Doe'],
    ['Clark', 'Kent'],
    ['Bruce', 'Wayne'],
];
CliTypo::component()->table($arr);

$arr = [
    'name' => 'surname',
    'John' => 'Doe',
    'Clark' => 'Kent',
    'Bruce' => 'Wayne',
];
CliTypo::component()->elements($arr);
CliTypo::component()::decision('Do you like orange?');
CliTypo::component()->indicator(3, 6);
echo PHP_EOL;

$answer = CliTypo::component()->read('Question', ['First', 'Second', 'Third']);
echo 'Answer: ' . $answer . PHP_EOL;

CliTypo::component()->wait(5, true, true);

