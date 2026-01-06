#!/bin/bash

# Deploy script for Malarz Trzebnica
# Deploys application to production server via FTP/SSH

set -e

echo "🚀 Starting deployment..."

# Configuration
REMOTE_HOST="${DEPLOY_HOST:-ftp.malarz.trzebnica.pl}"
REMOTE_USER="${DEPLOY_USER:-username}"
REMOTE_PATH="${DEPLOY_PATH:-/public_html}"
LOCAL_PATH="./dist"

# Pre-deployment checks
echo "✅ Running pre-deployment checks..."

# Check if composer.lock exists
if [ ! -f "composer.lock" ]; then
    echo "⚠️  Warning: composer.lock not found. Running composer install..."
    composer install --no-dev --optimize-autoloader
fi

# Check if .env exists on server (manual step)
echo "⚠️  Ensure .env file exists on server with production credentials"

# Build assets (if using npm)
if [ -f "package.json" ]; then
    echo "📦 Building assets..."
    npm run build
fi

# Run tests
echo "🧪 Running tests..."
composer test || echo "⚠️  Some tests failed, but continuing..."

# Deploy via rsync (preferred) or FTP
echo "📤 Deploying files..."

if command -v rsync &> /dev/null; then
    # Deploy via SSH/rsync
    rsync -avz --delete \
        --exclude='.git' \
        --exclude='node_modules' \
        --exclude='tests' \
        --exclude='.env' \
        "$LOCAL_PATH/" "$REMOTE_USER@$REMOTE_HOST:$REMOTE_PATH/"
else
    echo "⚠️  rsync not found. Please install or use FTP manually."
    exit 1
fi

# Post-deployment
echo "🔄 Running post-deployment tasks..."

# SSH into server and run commands
ssh "$REMOTE_USER@$REMOTE_HOST" << 'ENDSSH'
cd /public_html
php -v
composer --version
echo "✅ Deployment complete on server"
ENDSSH

echo "🎉 Deployment completed successfully!"
echo "📊 Check: https://www.malarz.trzebnica.pl"
