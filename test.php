<?php
    require_once ("room.php");
    echo "<!doctype html><html class='no-js' lang=''><head><title>Cabaret</title>";
    echo "<link rel='stylesheet' href='style/style.css' type='text/css'/>";
    echo "</head><body>\n";

    $r = new Room("Main", "Room");
    $r->posts[] = new Post("Kehvarl", "First Post.");
    $r->posts[] = new Post("Kehvarl", "Second Post.");
    $r->posts[] = new Post("Kehvarl", "Third Post.");

    echo $r->render();

    echo "</body></html>";
