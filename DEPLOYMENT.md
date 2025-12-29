# Deployment Guide - Optimed Hospital WordPress Site

This guide covers deploying the Optimed Hospital WordPress site to a production environment.

## Pre-Deployment Checklist

- [ ] Backup current site (if applicable)
- [ ] Test all features in staging environment
- [ ] Update all plugins and themes
- [ ] Optimize database
- [ ] Optimize and compress images
- [ ] Test on multiple browsers and devices
- [ ] Verify all forms are working
- [ ] Check all internal links
- [ ] Verify SSL certificate is ready
- [ ] Prepare DNS records

## Server Requirements

### Minimum Requirements
- **PHP**: 8.1 or higher
- **MySQL**: 8.0 or higher / MariaDB 10.5 or higher
- **Web Server**: Nginx (recommended) or Apache 2.4+
- **RAM**: 2GB minimum, 4GB recommended
- **Disk Space**: 10GB minimum
- **SSL Certificate**: Required for production

### Recommended PHP Extensions
- mysqli or pdo_mysql
- curl
- gd or imagick
- mbstring
- xml
- zip
- openssl
- bcmath

## Deployment Methods

### Method 1: Using All-in-One WP Migration (Recommended for Easy Setup)

#### On Development/Staging:
1. Install "All-in-One WP Migration" plugin
2. Go to All-in-One WP Migration → Export
3. Select "Export to File"
4. Download the .wpress file when ready

#### On Production Server:
1. Install fresh WordPress
2. Install "All-in-One WP Migration" plugin
3. Increase upload limit if needed (see below)
4. Go to All-in-One WP Migration → Import
5. Upload and import the .wpress file
6. Update site URLs in Settings → General

#### Increase Upload Limit for Large Imports:
```php
// Add to wp-config.php
define('WP_MEMORY_LIMIT', '512M');
define('WP_MAX_MEMORY_LIMIT', '512M');
```

Or use this plugin filter:
```php
// Add to functions.php or custom plugin
add_filter('ai1wm_max_file_size', function() {
    return 512 * 1024 * 1024; // 512MB
});
```

### Method 2: Manual Deployment

#### Step 1: Prepare Files
```bash
# On your development machine
cd /path/to/optimed-site-int

# Create archive excluding unnecessary files
tar -czf optimed-site.tar.gz \
    --exclude='node_modules' \
    --exclude='.git' \
    --exclude='wp-content/cache' \
    --exclude='wp-content/uploads/cache' \
    wp-content/ \
    composer.json \
    nginx.conf \
    uploads.ini
```

#### Step 2: Set Up Production Server

**Install Dependencies:**
```bash
# Ubuntu/Debian
sudo apt update
sudo apt install -y nginx mysql-server php8.1-fpm php8.1-mysql \
    php8.1-curl php8.1-gd php8.1-mbstring php8.1-xml \
    php8.1-zip php8.1-bcmath redis-server

# CentOS/RHEL
sudo yum install -y nginx mysql-server php81-fpm php81-mysqlnd \
    php81-curl php81-gd php81-mbstring php81-xml \
    php81-zip redis
```

**Create MySQL Database:**
```bash
sudo mysql -u root -p

CREATE DATABASE optimed_wp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'optimed_user'@'localhost' IDENTIFIED BY 'strong_password_here';
GRANT ALL PRIVILEGES ON optimed_wp.* TO 'optimed_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

#### Step 3: Install WordPress
```bash
cd /var/www
sudo wget https://wordpress.org/latest.tar.gz
sudo tar -xzf latest.tar.gz
sudo mv wordpress optimed
cd optimed
```

#### Step 4: Upload and Extract Your Files
```bash
# Upload optimed-site.tar.gz to server, then:
cd /var/www/optimed
sudo tar -xzf /path/to/optimed-site.tar.gz
sudo chown -R www-data:www-data /var/www/optimed
sudo find /var/www/optimed -type d -exec chmod 755 {} \;
sudo find /var/www/optimed -type f -exec chmod 644 {} \;
```

#### Step 5: Configure wp-config.php
```bash
cd /var/www/optimed
sudo cp wp-config-sample.php wp-config.php
sudo nano wp-config.php
```

Update these values:
```php
define('DB_NAME', 'optimed_wp');
define('DB_USER', 'optimed_user');
define('DB_PASSWORD', 'your_strong_password');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', 'utf8mb4_unicode_ci');

// Get security keys from: https://api.wordpress.org/secret-key/1.1/salt/
// Paste them here

// Performance
define('WP_CACHE', true);
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M');

// Redis
define('WP_REDIS_HOST', 'localhost');
define('WP_REDIS_PORT', 6379);

// Disable file editing
define('DISALLOW_FILE_EDIT', true);

// Force SSL
define('FORCE_SSL_ADMIN', true);
```

#### Step 6: Configure Nginx
```bash
sudo nano /etc/nginx/sites-available/optimed
```

Use the nginx.conf from the repository as a template:
```nginx
server {
    listen 80;
    server_name optimedhospital.com www.optimedhospital.com;
    
    # Redirect to HTTPS
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name optimedhospital.com www.optimedhospital.com;
    
    root /var/www/optimed;
    index index.php index.html;
    
    # SSL Configuration
    ssl_certificate /etc/letsencrypt/live/optimedhospital.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/optimedhospital.com/privkey.pem;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;
    
    # Use the rest of the nginx.conf configuration from repository
    # ... (copy from nginx.conf)
}
```

Enable site:
```bash
sudo ln -s /etc/nginx/sites-available/optimed /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

#### Step 7: Install SSL Certificate
```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d optimedhospital.com -d www.optimedhospital.com
```

#### Step 8: Set Up Automatic Backups
```bash
# Create backup script
sudo nano /usr/local/bin/backup-wordpress.sh
```

```bash
#!/bin/bash
BACKUP_DIR="/backups/wordpress"
DATE=$(date +%Y%m%d_%H%M%S)
SITE_DIR="/var/www/optimed"
DB_NAME="optimed_wp"
DB_USER="optimed_user"
DB_PASS="your_password"

mkdir -p $BACKUP_DIR

# Backup files
tar -czf $BACKUP_DIR/files_$DATE.tar.gz $SITE_DIR

# Backup database
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME | gzip > $BACKUP_DIR/db_$DATE.sql.gz

# Keep only last 7 days
find $BACKUP_DIR -mtime +7 -delete
```

Make executable and add to cron:
```bash
sudo chmod +x /usr/local/bin/backup-wordpress.sh
sudo crontab -e
# Add: 0 2 * * * /usr/local/bin/backup-wordpress.sh
```

### Method 3: Docker Deployment

#### Docker Compose for Production
Update docker-compose.yml for production:

```yaml
version: '3.8'

services:
  db:
    image: mysql:8.0
    restart: always
    environment:
      MYSQL_DATABASE: wordpress
      MYSQL_USER: wordpress
      MYSQL_PASSWORD: ${DB_PASSWORD}
      MYSQL_ROOT_PASSWORD: ${DB_ROOT_PASSWORD}
    volumes:
      - db_data:/var/lib/mysql
    networks:
      - backend

  redis:
    image: redis:7-alpine
    restart: always
    networks:
      - backend
    volumes:
      - redis_data:/data

  wordpress:
    image: wordpress:6.9-php8.3-fpm
    restart: always
    depends_on:
      - db
      - redis
    environment:
      WORDPRESS_DB_HOST: db:3306
      WORDPRESS_DB_NAME: wordpress
      WORDPRESS_DB_USER: wordpress
      WORDPRESS_DB_PASSWORD: ${DB_PASSWORD}
      WORDPRESS_DEBUG: 'false'
    volumes:
      - ./wordpress:/var/www/html
      - ./wp-content:/var/www/html/wp-content
    networks:
      - backend

  nginx:
    image: nginx:alpine
    restart: always
    depends_on:
      - wordpress
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./wordpress:/var/www/html
      - ./wp-content:/var/www/html/wp-content
      - ./nginx-prod.conf:/etc/nginx/conf.d/default.conf
      - ./ssl:/etc/nginx/ssl
    networks:
      - backend

volumes:
  db_data:
  redis_data:

networks:
  backend:
    driver: bridge
```

Deploy:
```bash
# Create .env file with production passwords
echo "DB_PASSWORD=your_secure_password" > .env
echo "DB_ROOT_PASSWORD=your_root_password" >> .env

# Deploy
docker-compose -f docker-compose-prod.yml up -d
```

## Post-Deployment Tasks

### Immediate Tasks (First Hour)
- [ ] Verify site is accessible
- [ ] Test all pages and navigation
- [ ] Test contact forms
- [ ] Verify SSL is working
- [ ] Check mobile responsiveness
- [ ] Test search functionality
- [ ] Verify images are loading
- [ ] Check admin panel access

### Configuration Tasks (First Day)
- [ ] Activate and configure Yoast SEO
- [ ] Enable and configure Redis Cache
- [ ] Enable and configure WP Super Cache
- [ ] Configure Wordfence settings
- [ ] Set up Google Analytics
- [ ] Set up Google Search Console
- [ ] Configure email (SMTP)
- [ ] Test email sending
- [ ] Set up automated backups
- [ ] Configure CDN (if applicable)

### Performance Optimization
1. **Enable Redis Object Cache**
   ```bash
   wp redis enable  # If using WP-CLI
   ```

2. **Test Performance**
   - Google PageSpeed Insights
   - GTmetrix
   - WebPageTest

3. **Optimize Images**
   - Install Smush or ShortPixel
   - Enable lazy loading (already in theme)

4. **Configure CDN** (Optional but recommended)
   - Set up Cloudflare
   - Update site URL to use CDN

### Security Hardening

1. **File Permissions**
   ```bash
   sudo find /var/www/optimed -type d -exec chmod 755 {} \;
   sudo find /var/www/optimed -type f -exec chmod 644 {} \;
   sudo chmod 600 /var/www/optimed/wp-config.php
   ```

2. **Wordfence Configuration**
   - Enable Web Application Firewall
   - Set to "Extended Protection"
   - Enable email alerts
   - Schedule regular scans

3. **Hide WordPress Version**
   Already implemented in theme

4. **Two-Factor Authentication**
   - Install "Two Factor Authentication" plugin
   - Enable for all admin users

### Monitoring Setup

1. **Uptime Monitoring**
   - UptimeRobot (free)
   - Pingdom
   - StatusCake

2. **Performance Monitoring**
   - Google Analytics
   - Jetpack Stats
   - MonsterInsights

3. **Error Monitoring**
   - Configure error logging
   - Set up email alerts

4. **Security Monitoring**
   - Wordfence alerts
   - File integrity monitoring

## Rollback Plan

In case something goes wrong:

1. **Restore from Backup**
   ```bash
   # Restore files
   cd /var/www
   sudo rm -rf optimed
   sudo tar -xzf /backups/wordpress/files_YYYYMMDD_HHMMSS.tar.gz
   
   # Restore database
   mysql -u optimed_user -p optimed_wp < /backups/wordpress/db_YYYYMMDD_HHMMSS.sql
   ```

2. **Use All-in-One WP Migration**
   - Import previous .wpress backup
   - Verify functionality

## Maintenance Schedule

### Daily
- Monitor uptime
- Check error logs
- Review security alerts

### Weekly
- Check for updates (WordPress, themes, plugins)
- Review analytics
- Test backup restoration

### Monthly
- Full security audit
- Performance review
- Database optimization
- Update documentation

## Support & Troubleshooting

### Common Issues

**White Screen of Death**
- Check PHP error logs: `/var/log/php-fpm/error.log`
- Enable WP_DEBUG temporarily
- Deactivate all plugins
- Switch to default theme

**Database Connection Error**
- Verify database credentials in wp-config.php
- Check MySQL is running: `sudo systemctl status mysql`
- Test database connection: `mysql -u optimed_user -p optimed_wp`

**Slow Performance**
- Enable Redis cache
- Enable WP Super Cache
- Check server resources: `top`, `htop`
- Review slow query log
- Check for plugin conflicts

### Getting Help
- Check logs: `/var/log/nginx/error.log`, `/var/log/php-fpm/error.log`
- WordPress debug log: `wp-content/debug.log`
- Contact hosting support
- WordPress support forums

## Conclusion

Following this guide should result in a secure, fast, and reliable WordPress deployment. Remember to:
- Keep everything updated
- Monitor regularly
- Test backups
- Document any customizations
- Follow security best practices

Good luck with your deployment!
