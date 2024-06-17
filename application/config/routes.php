<?php
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route["admin_portal"] = "adminPages/goToAdminPortal";
$route["dashboard"] = "adminPages/goToDashboard";
$route["administrators"] = "adminPages/goToAdministrators";

$route["(:any)"] = "adminPages/$1";


