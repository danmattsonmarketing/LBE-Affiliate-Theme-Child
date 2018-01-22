<?php
require 'theme_update_check.php';
$MyUpdateChecker = new ThemeUpdateChecker(
    'womness',
    'https://kernl.us/api/v1/theme-updates/5a653f8f2822ed62e077c03a/'
);
// $MyUpdateChecker->license = "aKernlLicenseKey";  <---- optional
// $MyUpdateChecker->remoteGetTimeout = 5; <---- optional

?>
