<?php

$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
$host = $_SERVER['HTTP_HOST'] ?? '200.233.44.151:82';
define("BASE_URL", "$protocol://$host/ConsultaTituloPlandet-1/");
define("URL_VIEW_DOCUMENT", BASE_URL . "view.php?id=");
