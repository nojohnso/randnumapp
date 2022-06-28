<?php

$_dice = intval($_GET['d']);
$_sides = intval($_GET['s']);

$_rolls = array();

if ($_dice > 6) {
    echo "You cannot roll more than 6 dice.";
} elseif ($_sides > 20) {
    echo "Nice try buddy.";
} elseif ($_sides < 1) {
    echo "Nice try buddy.";
} else {
    $x = 1;
    do {
        $_rolls[] = rand(1, $_sides);
        $x++;
    } while ($x <= $_dice);
    
    $dice_total = 0;

    foreach ($_rolls as $_roll) {
        $dice_total+=$_roll;
    }

    $data = array(
        "rolls"=>$_rolls,
        "total"=>$dice_total
    );

    echo json_encode($data);
}


?>
