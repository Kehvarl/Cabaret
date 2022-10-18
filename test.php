
<?php
/*
    try
    {
        $conn = new PDO('mysql:host=localhost;dbname=cabaret',$_SERVER['MYSQL_USER'],$_SERVER['MYSQL_PASSWORD']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected\n";
    }
    catch (PDOException  $e)
    {
        die("Unable to connect: " . $e->getMessage());
    }
    $conn = null;
*/

    require_once ('user.php');
    require_once ("room.php");
    require_once ("login.php");
    $user = null;
    try
    {
        //$user = User::create('Kehvarl', 'kehvarl@kehvarl.com', 'PAssword');
        $user = User::login('Kehvarl', '');
        //print_r($user->jsonSerialize());
        //print_r($user->password_hash);
        //print(User::check_password('Kehvarl', 'password'));
    }
    catch (Exception $e)
    {
        print_r($e);
    }
    try
    {
        $r = Room::list($user)[0];
    }
    catch (Exception $e)
    {
        die("No Room");
        //$r = new Room("Main", "Room");
    }
    $l = new Login($user, "Kehv", "A Dragon", $r);
    $l2 = new Login($user, "Illyrin", "A Dragon", $r);

    $r->addpost(new Post($l->name, "Test", "#c0c0c0"));
    $r->addpost(new Post($l2->name, "Test2", "#00c0c0"));

    echo "<!doctype html><html class='no-js' lang=''><head><title>Cabaret</title>";
    echo "<link rel='stylesheet' href='style/style.css' type='text/css'/>";
    echo "</head><body>\n";
    echo $r->render();
    echo "</body></html>";


/*
    require_once ("room.php");
    echo "<!doctype html><html class='no-js' lang=''><head><title>Cabaret</title>";
    echo "<link rel='stylesheet' href='style/style.css' type='text/css'/>";
    echo "</head><body>\n";

    $r = new Room("Main", "Room");
    $r->posts[] = new Post("Kehvarl", "First Post.", "#c0c0c0");
    $r->posts[] = new Post("Kehvarl", "Second Post.", "#000080");
    $r->posts[] = new Post("Kehvarl", "Third Post.", "#000000");
    $r->posts[] = new Post("Kehvarl", "Posting posting madness..", "#000000");

    echo $r->render();

    echo "</body></html>";
*/
