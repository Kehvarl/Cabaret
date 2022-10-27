
<?php
require_once ('user.php');
require_once ("room.php");
require_once ("login.php");

session_start();


if (!isset($_SESSION['user']))
{
    try
    {
        $_SESSION['user'] = User::login('keHVaRL', 'TestPAss');
    }
    catch (Exception $e)
    {
        print_r($e);
        die('Login Failed');
    }
}

$user = $_SESSION['user'];

try
{
    $r = Room::list($user)[0];
}
catch (Exception $e)
{
    die("No Room");
}

$l = new Login($user, "Kehv", "A Dragon", $r);
$l2 = new Login($user, "Illyrin", "Another Dragon", $r);

$r->addpost(new Post($user, $l->name, "Testing 123", "#c0c0c0"));
$r->addpost(new Post($user, $l2->name, "You know the drill.", "#00c0c0"));

echo "<!doctype html><html class='no-js' lang=''><head><title>Cabaret</title>";
echo "<link rel='stylesheet' href='style/style.css' type='text/css'/>";
echo "</head><body>\n";
echo $r->render();
echo "</body></html>";

