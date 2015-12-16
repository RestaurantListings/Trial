<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 11/4/15
 * Time: 1:07 PM
 */
$env = $app->detectEnvironment(function() {
    return gethostname() == 'restaurantlistings.com' ? 'production' : 'local';
});
?>