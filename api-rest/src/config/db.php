<?php
$db = new PDO("sqlite:src/config/db.sqlite");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

// $db->exec("
//     CREATE TABLE IF NOT EXISTS users (
//         id INTEGER PRIMARY KEY,
//         msisdn TEXT NOT NULL,
//         name TEXT NOT NULL,
//         access_level INTEGER NOT NULL,
//         password TEXT NOT NULL
//     );
// ");