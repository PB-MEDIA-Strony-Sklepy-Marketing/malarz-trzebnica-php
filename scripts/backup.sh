#!/bin/bash

# Backup script dla Malarz Trzebnica
# Wykonuje backup plików i bazy danych (jeśli używana)

BACKUP_DIR="/backups"
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")
PROJECT_DIR="/var/www/malarz-trzebnica-php"

echo "Starting backup at $(date)"

# Create backup directory
mkdir -p "$BACKUP_DIR"

# Backup files
tar -czf "$BACKUP_DIR/files_$TIMESTAMP.tar.gz" \
    --exclude="$PROJECT_DIR/vendor" \
    --exclude="$PROJECT_DIR/node_modules" \
    --exclude="$PROJECT_DIR/cache" \
    "$PROJECT_DIR"

echo "Files backup completed: files_$TIMESTAMP.tar.gz"

# Backup database (jeśli używana)
# mysqldump -u root -p malarz_trzebnica > "$BACKUP_DIR/db_$TIMESTAMP.sql"

# Remove old backups (older than 30 days)
find "$BACKUP_DIR" -name "*.tar.gz" -mtime +30 -delete
find "$BACKUP_DIR" -name "*.sql" -mtime +30 -delete

echo "Backup completed at $(date)"
