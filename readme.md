Use php 7.1

Migration = To create a database

Seeders = Create fake date in database

# Commando to run migrations

Created Migration:
vendor/bin/phinx migrate

Drop All Migrations: 
vendor/bin/phinx rollback -t=0

# Command to run seders
Generate all seeders in file
vendor/bin/phinx seed:run

# Faker
Excelent lib to generate dates to insert in your bank 

# Run service
php -S localhost:8080 -t public public/index.php
