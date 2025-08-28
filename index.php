<?php

# -
error_reporting(E_ALL);
ini_set('display_errors', 1);

# -
require_once "./app/Autoloader.php";
__load_all_classes();

# -
(new AppController())->_route();