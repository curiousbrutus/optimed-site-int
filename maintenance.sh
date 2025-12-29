#!/bin/bash

# WordPress Maintenance Script
# This script helps with common maintenance tasks

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}================================================${NC}"
echo -e "${BLUE}Optimed Hospital - WordPress Maintenance${NC}"
echo -e "${BLUE}================================================${NC}"
echo ""

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo -e "${RED}❌ Docker is not running. Please start Docker first.${NC}"
    exit 1
fi

# Function to show menu
show_menu() {
    echo ""
    echo "Select an option:"
    echo "1) Start/Restart all containers"
    echo "2) Stop all containers"
    echo "3) View container status"
    echo "4) View logs (all services)"
    echo "5) View WordPress logs only"
    echo "6) View Nginx logs only"
    echo "7) Backup database"
    echo "8) Clean up Docker resources"
    echo "9) Update all containers"
    echo "10) Access WordPress container shell"
    echo "11) Access MySQL database"
    echo "12) Clear WordPress cache"
    echo "13) Fix file permissions"
    echo "0) Exit"
    echo ""
    read -p "Enter your choice: " choice
}

# Function to start containers
start_containers() {
    echo -e "${YELLOW}Starting containers...${NC}"
    docker compose up -d
    echo -e "${GREEN}✅ Containers started!${NC}"
    docker compose ps
}

# Function to stop containers
stop_containers() {
    echo -e "${YELLOW}Stopping containers...${NC}"
    docker compose down
    echo -e "${GREEN}✅ Containers stopped!${NC}"
}

# Function to show status
show_status() {
    echo -e "${YELLOW}Container Status:${NC}"
    docker compose ps
}

# Function to view all logs
view_logs() {
    echo -e "${YELLOW}Viewing logs (Ctrl+C to exit)...${NC}"
    docker compose logs -f
}

# Function to view WordPress logs
view_wordpress_logs() {
    echo -e "${YELLOW}Viewing WordPress logs (Ctrl+C to exit)...${NC}"
    docker compose logs -f wordpress
}

# Function to view Nginx logs
view_nginx_logs() {
    echo -e "${YELLOW}Viewing Nginx logs (Ctrl+C to exit)...${NC}"
    docker compose logs -f nginx
}

# Function to backup database
backup_database() {
    BACKUP_DIR="./backups"
    mkdir -p $BACKUP_DIR
    TIMESTAMP=$(date +%Y%m%d_%H%M%S)
    BACKUP_FILE="$BACKUP_DIR/db_backup_$TIMESTAMP.sql.gz"
    
    echo -e "${YELLOW}Backing up database...${NC}"
    docker compose exec -T db mysqldump -u wordpress -pwordpress_password wordpress | gzip > $BACKUP_FILE
    echo -e "${GREEN}✅ Database backed up to: $BACKUP_FILE${NC}"
    
    # Keep only last 5 backups
    cd $BACKUP_DIR
    ls -t db_backup_*.sql.gz | tail -n +6 | xargs -r rm
    cd ..
    echo -e "${GREEN}Old backups cleaned (keeping last 5)${NC}"
}

# Function to clean Docker resources
cleanup_docker() {
    echo -e "${YELLOW}Cleaning up Docker resources...${NC}"
    docker system prune -f
    echo -e "${GREEN}✅ Docker cleanup completed!${NC}"
}

# Function to update containers
update_containers() {
    echo -e "${YELLOW}Updating containers...${NC}"
    docker compose pull
    docker compose up -d
    echo -e "${GREEN}✅ Containers updated!${NC}"
}

# Function to access WordPress shell
wordpress_shell() {
    echo -e "${YELLOW}Accessing WordPress container shell...${NC}"
    echo -e "${BLUE}Type 'exit' to return${NC}"
    docker compose exec wordpress bash
}

# Function to access MySQL
access_mysql() {
    echo -e "${YELLOW}Accessing MySQL database...${NC}"
    echo -e "${BLUE}Type 'exit' to return${NC}"
    docker compose exec db mysql -u wordpress -pwordpress_password wordpress
}

# Function to clear cache
clear_cache() {
    echo -e "${YELLOW}Clearing WordPress cache...${NC}"
    
    # Clear Redis cache
    docker compose exec redis redis-cli FLUSHALL
    echo -e "${GREEN}✅ Redis cache cleared${NC}"
    
    # Clear WordPress cache directory
    docker compose exec wordpress find /var/www/html/wp-content/cache -type f -delete 2>/dev/null || true
    echo -e "${GREEN}✅ WordPress cache directory cleared${NC}"
    
    echo -e "${GREEN}✅ Cache cleared successfully!${NC}"
}

# Function to fix permissions
fix_permissions() {
    echo -e "${YELLOW}Fixing file permissions...${NC}"
    
    # Fix permissions for wp-content
    docker compose exec wordpress find /var/www/html/wp-content -type d -exec chmod 755 {} \;
    docker compose exec wordpress find /var/www/html/wp-content -type f -exec chmod 644 {} \;
    
    echo -e "${GREEN}✅ File permissions fixed!${NC}"
}

# Main loop
while true; do
    show_menu
    
    case $choice in
        1) start_containers ;;
        2) stop_containers ;;
        3) show_status ;;
        4) view_logs ;;
        5) view_wordpress_logs ;;
        6) view_nginx_logs ;;
        7) backup_database ;;
        8) cleanup_docker ;;
        9) update_containers ;;
        10) wordpress_shell ;;
        11) access_mysql ;;
        12) clear_cache ;;
        13) fix_permissions ;;
        0) 
            echo -e "${GREEN}Goodbye!${NC}"
            exit 0
            ;;
        *)
            echo -e "${RED}Invalid option. Please try again.${NC}"
            ;;
    esac
    
    echo ""
    read -p "Press Enter to continue..."
done
