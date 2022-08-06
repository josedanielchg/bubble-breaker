<?php

include_once("./functions/board_logic.php");
include_once("./config/constants.php");
include_once("./functions/colors.php");


$new_board = false;

if( isset($_GET['start']) ):
    $new_board = true;
    $board = generate_board(SIZE_H, SIZE_W);

    setcookie("board_game", json_encode($board), time() + (86400 * 30), "/");
else:
    $board = json_decode($_COOKIE['board_game']);
    $key = array_key_first($_POST);
    $posH = strtok($key, '_');
    $posX = strtok('_');
    $color_id = get_color_name_by_name($_POST[$key]);

    getPiecesToRemove($board, intval($posH), intval($posX), $color_id);

    setcookie("board_game", json_encode($board), time() + (86400 * 30), "/");
endif;

header("Location: game.php");