<?php
require 'theme_update_check.php';
$MyUpdateChecker = new ThemeUpdateChecker(
    'womness',
    'https://kernl.us/api/v1/theme-updates/5a615b8ad3a06a26c3e3d01e/'
);
// $MyUpdateChecker->license = "aKernlLicenseKey";  <---- optional
// $MyUpdateChecker->remoteGetTimeout = 5; <---- optional

?>
