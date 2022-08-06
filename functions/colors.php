<?php 

include_once("./config/constants.php");

function get_color_name_by_id($id) {
    $name = ""; 

    if(is_null($id))
        return "invisible";

    switch ($id) {
        case COLOR_RED:
            $name = "red";
            break;

        case COLOR_YELLOW:
            $name = "yellow";
            break;

        case COLOR_GREEN:
            $name = "green";
            break;

        case COLOR_ORANGE:
            $name = "orange";
            break;

        case COLOR_BLUE:
            $name = "blue";
            break;

        case COLOR_PURPLE:
            $name = "purple";
            break;

        default:
            $name = ""; 
            break;
    }

    return $name;
}


function get_color_name_by_name($name) {
    $color = ""; 

    switch ($name) {
        case "red":
            $color = COLOR_RED;
            break;

        case "yellow":
            $color = COLOR_YELLOW;
            break;

        case "green":
            $color = COLOR_GREEN;
            break;

        case "orange":
            $color = COLOR_ORANGE;
            break;

        case "blue":
            $color = COLOR_BLUE;
            break;

        case "purple":
            $color = COLOR_PURPLE;
            break;

        default:
            $color = ""; 
            break;
    }

    return $color;
}