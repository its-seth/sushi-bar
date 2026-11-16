<?php
/*
 * leaderboard.php  (GET)
 * Returns the 10 best games, with the player's username.
 * Only logged-in players can see it.
 *
 * Source: generated with Claude (Anthropic), November 2026. Reviewed and adapted by: <your name>
 */

require_once __DIR__ . '/bootstrap.php';
require_login();

$rows = db()->query(
    'SELECT u.username, s.score, s.day, s.played_at AS playedAt
       FROM scores s
       JOIN users u ON u.id = s.user_id
      ORDER BY s.score DESC, s.played_at ASC
      LIMIT 10'
)->fetchAll();

foreach ($rows as &$row) {
    $row['score'] = (int) $row['score'];
    $row['day']   = (int) $row['day'];
}
unset($row);

respond(['ok' => true, 'rows' => $rows]);
