<?php
session_start();

require_once __DIR__ . "/../app/core/Router.php";
require_once __DIR__ . "/../routes/web.php";

Router::dispatch();
