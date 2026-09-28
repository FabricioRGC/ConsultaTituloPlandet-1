<?php

<<<<<<< HEAD
define("BASE_URL", "http://200.233.44.151:82/ConsultaTituloPlandet-1/");
=======
<<<<<<< Updated upstream
define("BASE_URL", "http://200.233.44.151:82/ConsultaTituloPlandet-1/");
=======
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
$host = $_SERVER['HTTP_HOST'] ?? '200.233.44.151:82';
define("BASE_URL", "$protocol://$host/ConsultaTituloPlandet-1/");
>>>>>>> Stashed changes
>>>>>>> 1b2ff91d49a733e2b13cadf3bc79b229bb552b1b
define("URL_VIEW_DOCUMENT", BASE_URL . "view.php?id=");