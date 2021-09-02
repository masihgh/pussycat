<?php
/*
* Route Web Here
*/

$router->add('', ['controller' => 'Home', 'action' => 'actionindex']);
$router->add('{controller}/{action}');

?>