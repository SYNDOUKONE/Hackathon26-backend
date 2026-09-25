#!/bin/sh
set -e

echo "🚀 Starting deployment process..."

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Run migrations (force is required for production)
php artisan migrate --force

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment completed successfully!"
