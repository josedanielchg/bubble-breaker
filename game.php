<?php 
    include_once("./functions/colors.php");

    $board = json_decode($_COOKIE['board_game']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game - Bubble Breaker</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <form action="logic.php" method="post">

        <table class="board">
            <?php foreach ($board as $indexR => $row): ?>
                <tr class="board__row">
                    <?php foreach($row as $indexC => $elem): ?>
                        <td class="board__column">
                            <?php $name = $indexR . "_" . $indexC; ?>

                            <label for="<?php echo $name; ?>" class="ball <?php echo get_color_name_by_id($elem); ?>">
                                <?php if(!is_null($elem)): ?>
                                    <input type="checkbox" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo get_color_name_by_id($elem); ?>">
                                <?php endif; ?>

                                <span class="ball__index">["<?php echo $name; ?>]</span>
                            </label>
                        </td>
                    <?php endforeach; ?>

                </tr>
            <?php endforeach; ?>
        </table>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>