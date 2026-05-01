<?php
// ================================================
//  get_scores.php — Fetch Score History
//  Called by JavaScript to load past game results.
//  Returns a JSON list of the last 10 games.
// ================================================

include "db.php";

header("Content-Type: application/json");

$sql    = "SELECT player_x, player_o, winner, played_at
           FROM scores
           ORDER BY played_at DESC
           LIMIT 10";

$result = mysqli_query($conn, $sql);


$scores = [];

if ($result && mysqli_num_rows($result) > 0) {
    
    while ($row = mysqli_fetch_assoc($result)) {
        $scores[] = $row;
    }
}


$sql2    = "SELECT winner, COUNT(*) as wins
            FROM scores
            WHERE winner != 'Draw'
            GROUP BY winner
            ORDER BY wins DESC
            LIMIT 1";

$result2 = mysqli_query($conn, $sql2);
$topPlayer = mysqli_fetch_assoc($result2);

echo json_encode([
    "history" => $scores,
    "top_player" => $topPlayer
]);

mysqli_close($conn);
?>
