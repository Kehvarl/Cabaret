<?php
require_once ("post.php");
require_once ("room.php");

function get_posts()
{


    $r = new Room("Main", "Room");
    $r->posts[] = new Post("Kehvarl", "First Post.", "#c0c0c0");
    $r->posts[] = new Post("Kehvarl", "Second Post.", "#000080");
    $r->posts[] = new Post("Kehvarl", "Third Post.", "#000000");

    return json_encode($r, JSON_PRETTY_PRINT);
}

$routes = array(
    '/load'      => get_posts(),
    '/hello' => 'Hello, World!',
    '/users' => 'Users!'
);

// This is our router.
function router($routes)
{
    // Iterate through a given list of routes.
    foreach ($routes as $path => $content) {
        if ($path == $_SERVER['PATH_INFO']) {
            // If the path matches, display its contents and stop the router.
            echo $content;
            return;
        }
    }

    // This can only be reached if none of the routes matched the path.
    echo 'Sorry! Page not found';
}

// Execute the router with our list of routes.
router($routes);