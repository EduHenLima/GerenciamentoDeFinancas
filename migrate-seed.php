<?php

/**
 * Run "php migrate-seed.php"
 * Command to drop migration->create again and create all seeds
 */

exec(__DIR__ . 'vendor/bin/phinx rollback -t=0');
exec(__DIR__ . 'vendor/bin/phinx migrate');
exec(__DIR__ . 'vendor/bin/phinx seed:run');