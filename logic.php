<?php

include_once("./functions/board_logic.php");
include_once("./config/constants.php");
include_once("./functions/colors.php");


$new_board = false;

if( isset($_GET['start']) ): //Start new game
    $new_board = true;
    $board = generate_board(SIZE_H, SIZE_W);

    setcookie("board_game", json_encode($board), time() + (86400 * 30), "/");
    setcookie("score", 0, time() + (86400 * 30), "/");
    setcookie("game_finish", 0, time() + (86400 * 30), "/");

else:
    $board = json_decode($_COOKIE['board_game']);
    $key = array_key_first($_POST);
    $posH = strtok($key, '_');
    $posX = strtok('_');
    $color_id = get_color_name_by_name($_POST[$key]);

    // Remove adjacent balls
    getPiecesToRemove($board, intval($posH), intval($posX), $color_id);

    // Move balls
    for($i=0; $i < SIZE_W; $i++)
        piecesFallingDown($board, 0, 0, $i);

    // Check finish game
    checkFinishGame($board);

    setcookie("board_game", json_encode($board), time() + (86400 * 30), "/");
endif;

header("Location: game.php");