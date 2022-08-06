<?php

include_once("./config/constants.php");


function generate_board($sizeH, $sizeW) {
    $board;

    for ($h=0; $h < $sizeH ; $h++)
        for($w=0; $w < $sizeW; $w++) {
            $color = array_rand(COLORS);
            $board[$h][$w] = $color;
        }

   return $board;
}


function getPiecesToRemove(&$board, $posH, $posX, $color_id) {
    $new = [];
    $visited = [];

    getAdjacentSameColor($board, $posH, $posX, $color_id, $new, $visited);

    foreach ($visited as $cords) {
        $y = $cords[0];
        $x = $cords[1];
        $board[$y][$x] = null;
    }
}


function getAdjacentSameColor($board, $posH, $posX, $color_id, &$new, &$visited) {
    //Remove this position from a new position
    array_push($visited, [$posH, $posX]);

    if($board[$posH+1][$posX] == $color_id && array_search([$posH+1, $posX], $visited) === false) {
        getAdjacentSameColor($board, $posH+1, $posX, $color_id, $new, $visited);
    }

    if($board[$posH-1][$posX] == $color_id && array_search([$posH-1, $posX], $visited) === false) {
        getAdjacentSameColor($board, $posH-1, $posX, $color_id, $new, $visited);
    }

    if($board[$posH][$posX+1] == $color_id && array_search([$posH, $posX+1], $visited) === false) {
        getAdjacentSameColor($board, $posH, $posX+1, $color_id, $new, $visited);
    }

    if($board[$posH][$posX-1] == $color_id && array_search([$posH, $posX-1], $visited) === false) {
        getAdjacentSameColor($board, $posH, $posX-1, $color_id, $new, $visited);
    }

    return;
}