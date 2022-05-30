<?php
    require_once ("post.php");
    require_once ("room.php");

    $r = new Room("Main", "Room");
    $r->posts[] = new Post("Kehvarl", "First Post.", "#c0c0c0");
    $r->posts[] = new Post("Kehvarl", "Second Post.", "#000080");
    $r->posts[] = new Post("Kehvarl", "Third Post.", "#000000");

    echo json_encode($r, JSON_PRETTY_PRINT);