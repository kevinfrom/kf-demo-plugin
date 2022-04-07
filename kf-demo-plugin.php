<?php

/**
 * Plugin Name: KF Demo plugin
 * Description: Kevin's demo plugin for testing things in WordPress
 * Version: 1.0.0
 * Author: Kevin From @ Mindthemedia
 */

use App\Hooks\HookManager;

require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/functions.php';

HookManager::getInstance()->registerHooks();
