<?php

require_once 'vendor/autoload.php';

use Rtcoder\CliTypo\CliTypo;

CliTypo::text()->color('red color on green background', 'red', 'green');

CliTypo::text()->write(
    CliTypo::format()->flank('Attention', '!', 5)
);

$arr = [
    'name' => 'surname',
    'John' => 'Doe',
    'Clark' => 'Kent',
    'Bruce' => 'Wayne',
    'arr' => [
        'name' => 'surname',
        'John' => 'Doe',
        'Clark' => 'Kent',
        'Bruce' => 'Wayne',
    ],
];
CliTypo::text()->write(
    CliTypo::format()->json(json_encode($arr))
);
CliTypo::text()->write(
    CliTypo::format()->with_date('Test Date')
);
CliTypo::text()->write(
    CliTypo::format()->with_time('Test Time')
);
CliTypo::text()->write(
    CliTypo::format()->with_datetime('Test Datetime')
);
CliTypo::text()->write(
    CliTypo::format()->bordered('Bordered text', '-', '|')
);

CliTypo::format()->dump($arr);
