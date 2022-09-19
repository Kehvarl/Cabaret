<?php
require_once ("post.php");
require_once ("room.php");

session_start();

if (!isset($_SESSION['room'])) {
    $_SESSION['room'] = new Room("Main", "The Main plane");
    $_SESSION['room']->posts[] = new Post("Kehvarl", "First Post.", "#c0c0c0");
    $_SESSION['room']->posts[] = new Post("Kehvarl", "Second Post.", "#000080");
    $_SESSION['room']->posts[] = new Post("Kehvarl", "Third Post.", "#000000");
}

function clear()
{
    unset($_SESSION['room']);
}

function get_posts()
{
        return json_encode($_SESSION['room'], JSON_PRETTY_PRINT);
}

function post()
{
    $post = json_decode(file_get_contents('php://input'), true);
    $name = "err";
    $message = "err";
    $color = "#800000";
    $font =  null;
    if (isset($post['name']))
        $name = $post['name'];
    if (isset($post['message']))
        $message = $post['message'];
    if (isset($post['color']))
        $color = $post['color'];
    if (isset($post['font']) && $post['font'] != "Default")
        $font = $post['font'];
    $_SESSION['room']->addpost(new Post($name, $message, $color, $font));

    return true;
}

$routes = array(
    '/load'     => 'get_posts',
    '/post'     => 'post',
    '/reset'    => 'clear',
    '/users'    => 'Users!'
);

// This is our router.
function router($routes)
{
    // Iterate through a given list of routes.
    foreach ($routes as $path => $content) {
        if ($path == $_SERVER['PATH_INFO']) {
            // If the path matches, display its contents and stop the router.
            echo $content();
            return;
        }
    }

    // This can only be reached if none of the routes matched the path.
    echo 'Sorry! Page not found';
}

// Execute the router with our list of routes.
router($routes);