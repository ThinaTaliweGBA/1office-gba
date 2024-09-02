#!/bin/bash

# Variables
BACKUP_PATH="/home/siya/database-backups/data_1office_0_2.sql"

# Step 4: Open MySQL backup file and replace all 'INSERT' with 'INSERT IGNORE'
sed -i 's/INSERT/INSERT IGNORE/g' $BACKUP_PATH

echo "Replaced all 'INSERT' with 'INSERT IGNORE' in the backup file."
