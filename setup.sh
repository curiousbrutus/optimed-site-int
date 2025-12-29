#!/bin/bash

# Optimed Hospital WordPress Setup Script
# This script helps set up the WordPress site quickly

set -e

echo "================================================"
echo "Optimed Hospital - WordPress Setup"
echo "================================================"
echo ""

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    echo "❌ Docker is not installed. Please install Docker first."
    echo "Visit: https://docs.docker.com/get-docker/"
    exit 1
fi

# Check if Docker Compose is installed
if ! command -v docker-compose &> /dev/null; then
    echo "❌ Docker Compose is not installed. Please install Docker Compose first."
    echo "Visit: https://docs.docker.com/compose/install/"
    exit 1
fi

echo "✅ Docker and Docker Compose are installed"
echo ""

# Create .env file if it doesn't exist
if [ ! -f .env ]; then
    echo "📝 Creating .env file from .env.example..."
    cp .env.example .env
    echo "✅ .env file created"
    echo "⚠️  Please edit .env file with your configuration"
    echo ""
else
    echo "✅ .env file already exists"
    echo ""
fi

# Create necessary directories
echo "📁 Creating necessary directories..."
mkdir -p wordpress
mkdir -p wp-content/uploads
mkdir -p wp-content/cache
chmod -R 755 wp-content

echo "✅ Directories created"
echo ""

# Start Docker containers
echo "🐳 Starting Docker containers..."
docker-compose up -d

echo ""
echo "⏳ Waiting for services to be ready..."
sleep 10

echo ""
echo "================================================"
echo "✅ Setup Complete!"
echo "================================================"
echo ""
echo "Your WordPress site is now running at:"
echo "  🌐 Website: http://localhost:8080"
echo "  🗄️  phpMyAdmin: http://localhost:8081"
echo ""
echo "Next steps:"
echo "  1. Visit http://localhost:8080 in your browser"
echo "  2. Complete the WordPress installation wizard"
echo "  3. Go to Appearance → Themes and activate 'Optimed Modern'"
echo "  4. Configure your site settings"
echo ""
echo "To stop the containers, run:"
echo "  docker-compose down"
echo ""
echo "To view logs, run:"
echo "  docker-compose logs -f"
echo ""
echo "For more information, see README.md"
echo "================================================"
