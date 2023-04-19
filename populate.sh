#! /bin/bash

# Remove all directories and files in storage/app/public
sh ./copyimages.sh

# Seed database
sh -c "php artisan migrate:fresh --seed"