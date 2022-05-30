<?php
    require_once ("room.php");
    echo "<!doctype html><html class='no-js' lang=''><head><title>Cabaret</title>";
    echo "<link rel='stylesheet' href='style/style.css' type='text/css'/>";
    echo "</head><body>\n";

    $r = new Room("Main", "Room");
    $r->posts[] = new Post("Kehvarl", "First Post.", "#c0c0c0");
    $r->posts[] = new Post("Kehvarl", "Second Post.", "#000080");
    $r->posts[] = new Post("Kehvarl", "Third Post.", "#000000");

    echo $r->render();

    echo "</body></html>";
