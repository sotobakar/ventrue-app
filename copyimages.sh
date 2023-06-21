#!/bin/bash

# Copy organization images

# Given: I am using a bash script

# When: I execute the bash script

# Then: all files from directory D would be removed and replaced with files from a specific directory.

# Set the source directory containing the files to be copied
SOURCE_DIR="./public/seed"

# Set the destination directory to where the files will be copied
DEST_DIR="./storage/app/public"

# Remove all files from the destination directory
rm -rf ${DEST_DIR}/*

# Copy all files from the source directory to the destination directory
cp -r ${SOURCE_DIR}/* ${DEST_DIR}/

chmod -R 777 storage/app/public/

# Print a message indicating that the operation has completed successfully
echo "All files from directory D have been removed and replaced with files from ${SOURCE_DIR}."
