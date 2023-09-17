<?php

require_once 'vendor/autoload.php';

use Rtcoder\CliTypo\CliTypo;

CliTypo::alert()->error('This is an error');
CliTypo::alert()->warning('This is warning');
CliTypo::alert()->success('This is success');
CliTypo::alert()->info('This is info');
