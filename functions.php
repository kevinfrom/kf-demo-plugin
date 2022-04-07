<?php

use Xicrow\PhpDebug\Debugger;

function debug($data, $trace_offset = 1)
{
    Debugger::debug($data, compact('trace_offset'));
}

function dd($data)
{
    debug($data, 2);
    die;
}

