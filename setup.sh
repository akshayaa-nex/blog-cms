#!/bin/bash

# Blog CMS Setup Script
# This script helps you set up the Blog CMS locally

echo "🚀 Blog CMS Installation Guide"
echo "================================"
echo ""

# Check if composer is installed
if ! command -v composer &> /dev/null; then
    echo "❌ Composer is not installed. Please install Composer first."
    exit 1
fi

echo "✅ Composer found"
echo ""

# Install dependencies
echo "📦 Installing PHP dependencies..."
composer install

if [ ! -f .env ]; then
    echo "📝 Creating .env file..."
    cp env .env
    echo "⚠️  Please update .env with your database credentials"
fi

echo ""
echo "🗄️  Setting up database..."
echo "Please ensure MySQL/MariaDB is running and you have created the database."
echo ""

# Run migrations
echo "🔄 Running migrations..."
php spark migrate

echo ""
echo "✅ Installation complete!"
echo ""
echo "📝 Next steps:"
echo "1. Update .env file with your database credentials"
echo "2. Run: php spark serve"
echo "3. Visit: http://localhost:8080"
echo ""
echo "🔗 API Documentation: Check README.md for comprehensive API docs"
echo ""
