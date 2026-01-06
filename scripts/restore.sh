#!/bin/bash

# Restore script dla Malarz Trzebnica

if [ -z "$1" ]; then
    echo "Usage: ./restore.sh backup_file.tar.gz"
    exit 1
fi

BACKUP_FILE=$1
RESTORE_DIR="/var/www/malarz-trzebnica-php"

echo "Starting restore from $BACKUP_FILE"

# Extract backup
tar -xzf "$BACKUP_FILE" -C /

echo "Files restored successfully"
echo "Please check configuration files (.env, config.php)"
