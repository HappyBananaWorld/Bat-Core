<?php

function echoS($path)
{
    //    echo dirname(__DIR__,3) . "/public/assets/" . $path;
}
function assets(string $path): string
{
    $version = file_exists("public/assets/$path") ? filemtime("public/assets/$path") : time();
    return "/assets/" . ltrim($path, '/') . '?v=' . $version;
}

function images(string $path): string
{
    $version = file_exists("public/images/$path") ? filemtime("public/images/$path") : time();
    return "/images/" . ltrim($path, '/') . '?v=' . $version;
}


function public_path(string $relativePath): string
{
    // Assume 'public' folder is 3 levels up from this script
    return dirname(__DIR__, 3) . "/public" . $relativePath;
}


// i/* f (!function_exists('assets')) {
// } */
