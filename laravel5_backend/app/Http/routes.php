<?php

use App\Services\Routes as RoutesManager;

$routesManager = new RoutesManager();
$routesManager->admin()->www();
#$routesManager->home()->www();