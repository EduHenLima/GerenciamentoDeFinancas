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
