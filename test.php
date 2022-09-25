<?php
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
