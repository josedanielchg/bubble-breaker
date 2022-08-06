<?php 
    include_once("./functions/colors.php");

    $board = json_decode($_COOKIE['board_game']);
    $score = $_COOKIE['score'];
    $game_finish = $_COOKIE['game_finish'];
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

        <div class="disable <?php if($game_finish == 1) echo "active"; ?>">
            <h2 class="disable__title">Game Finish!</h2>
            <h2><a href="logic.php?start=1" class="start_button">Start New Game!</a></h2>
        </div>
    </form>

    <div class="score">
        <h1>Score: <?php echo $score; ?></h1>
    </div>

    <script src="assets/js/main.js"></script>
</body>
</html>