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
    $visited = [];

    getAdjacentSameColor($board, $posH, $posX, $color_id, $visited);

    if(count($visited) < 2) {
        return;
    }

    foreach ($visited as $cords) {
        $y = $cords[0];
        $x = $cords[1];
        $board[$y][$x] = null;
    }
    
    $score = 0;
    if(isset($_COOKIE['score']))
        $score = $_COOKIE['score'];
    
    setcookie("score", $score + count($visited) - 1, time() + (86400 * 30), "/");
    count($visited);
}


function getAdjacentSameColor($board, $posH, $posX, $color_id, &$visited) {
    //Mark as visited
    array_push($visited, [$posH, $posX]);

    if(isset($board[$posH+1][$posX]))
        if($board[$posH+1][$posX] == $color_id && array_search([$posH+1, $posX], $visited) === false) {
            getAdjacentSameColor($board, $posH+1, $posX, $color_id, $visited);
        }

    if(isset($board[$posH-1][$posX]))
        if($board[$posH-1][$posX] == $color_id && array_search([$posH-1, $posX], $visited) === false) {
            getAdjacentSameColor($board, $posH-1, $posX, $color_id, $visited);
        }

    if(isset($board[$posH][$posX+1]))
        if($board[$posH][$posX+1] == $color_id && array_search([$posH, $posX+1], $visited) === false) {
            getAdjacentSameColor($board, $posH, $posX+1, $color_id, $visited);
        }

    if(isset($board[$posH][$posX-1]))
        if($board[$posH][$posX-1] == $color_id && array_search([$posH, $posX-1], $visited) === false) {
            getAdjacentSameColor($board, $posH, $posX-1, $color_id, $visited);
        }

    return;
}


function piecesFallingDown(&$board, $i, $saved, $x) {  
    
    if($i+1 >= SIZE_H) {
        return;
    }
    elseif(!is_null($board[$saved][$x]) ) {
        piecesFallingDown($board, $i+1, $saved+1, $x);
    }
    elseif(is_null($board[$i+1][$x]) ){
        piecesFallingDown($board, $i+1, $saved, $x);
    }
    else {
        $board[$saved][$x] = $board[$i+1][$x];
        $board[$i+1][$x] =  null;

        $saved = $saved + 1;
        $i=$saved;
        piecesFallingDown($board, $i, $saved, $x);
    }
}


function checkFinishGame(&$board) {
    $exists_pairs = false;

    for($i= 0; $i < SIZE_H && !$exists_pairs; $i++) {
        for($j= 0; $j < SIZE_H && !$exists_pairs; $j++) {
            $color_id = $board[$i][$j];
            
            if( is_null($color_id) )
                continue;
            
            if( isset($board[$i+1][$j]) ) {
                if($board[$i+1][$j] == $color_id)
                    $exists_pairs = true;
            }

            if( isset($board[$i-1][$j]) ) {
                if($board[$i-1][$j] == $color_id)
                    $exists_pairs = true;
            }

            if( isset($board[$i][$j+1]) ) {
                if($board[$i][$j+1] == $color_id)
                    $exists_pairs = true;
            }

            if( isset($board[$i][$j-1]) ) {
                if($board[$i][$j-1] == $color_id)
                    $exists_pairs = true;
            }
        }
    }

    if(!$exists_pairs) {
        setcookie("game_finish", 1, time() + (86400 * 30), "/");
    }
}