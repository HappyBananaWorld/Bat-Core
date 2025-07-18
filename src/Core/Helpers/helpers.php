<?php

function echoS($path)
{
    //    echo dirname(__DIR__,3) . "/public/assets/" . $path;
}
function assets($path)
{
    return dirname(__DIR__, 3) . "/public/assets/" . $path;
}

// i/* f (!function_exists('assets')) {
// } */
