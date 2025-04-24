<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Migration.php';

$migration = new Migration();
$migration->applyMigration(); 