<?php

include "db.php";   

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$player_x = isset($data["player_x"]) ? $data["player_x"] : "Player X";
$player_o = isset($data["player_o"]) ? $data["player_o"] : "Player O";
$winner   = isset($data["winner"])   ? $data["winner"]   : "Draw";


$player_x = mysqli_real_escape_string($conn, $player_x);
$player_o = mysqli_real_escape_string($conn, $player_o);
$winner   = mysqli_real_escape_string($conn, $winner);

$sql = "INSERT INTO scores (player_x, player_o, winner)
        VALUES ('$player_x', '$player_o', '$winner')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["status" => "success", "message" => "Score saved!"]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}

mysqli_close($conn);  
