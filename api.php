<?php
require_once ("post.php");
require_once ("room.php");

session_start();

if (!isset($_SESSION['room'])) {
    $_SESSION['room'] = new Room("Main", "The Mane plane");
    $_SESSION['room']->posts[] = new Post("Kehvarl", "First Post.", "#c0c0c0");
    $_SESSION['room']->posts[] = new Post("Kehvarl", "Second Post.", "#000080");
    $_SESSION['room']->posts[] = new Post("Kehvarl", "Third Post.", "#000000");
}

function get_posts()
{
        return json_encode($_SESSION['room'], JSON_PRETTY_PRINT);
}

function post()
{
    $name = "err";
    $message = "err";
    $color = "#800000";
    if (isset($_POST['name']))
        $name = $_POST['name'];
    if (isset($_POST['message']))
        $message = $_POST['message'];
    if (isset($_POST['color']))
        $color = $_POST['color'];
    $_SESSION['room']->posts[] = new Post($name, $message, $color);

    return true;
}

$routes = array(
    '/load'     => get_posts(),
    '/post'     => post(),
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