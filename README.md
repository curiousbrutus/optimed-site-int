# Optimed Hospital - Modern WordPress Site

Modern, fast, and responsive WordPress site for Optimed Hospital with performance optimizations and contemporary design.

> 🇹🇷 **Türkçe dokümantasyon için [README.tr.md](README.tr.md) dosyasına bakın.**

> 📚 **Quick Start**: See [QUICKSTART.md](QUICKSTART.md) for a 5-minute setup guide!

## 🚀 Features

- **Modern Design**: Clean, professional healthcare-focused design
- **Fast Performance**: Optimized for speed with lazy loading, caching, and minification
- **Responsive**: Mobile-first design that works on all devices
- **SEO Optimized**: Built-in SEO best practices and WordPress SEO plugin
- **Secure**: Security headers, Wordfence, and security best practices
- **Docker Support**: Easy local development with Docker
- **Redis Caching**: Built-in Redis support for faster page loads
- **Modern Theme**: Custom-built theme with performance in mind
- **Accessibility**: WCAG compliant and keyboard-friendly

## 📋 Requirements

- Docker & Docker Compose (recommended)
- OR PHP 8.1+ with MySQL 8.0+ and Nginx/Apache

## 🛠️ Installation

### Using Docker (Recommended)

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd optimed-site-int
   ```

2. **Start Docker containers**
   ```bash
   docker-compose up -d
   ```

3. **Access the site**
   - Website: http://localhost:8080
   - phpMyAdmin: http://localhost:8081
   - Username: root / Password: root_password

4. **Complete WordPress installation**
   - Visit http://localhost:8080
   - Follow the WordPress installation wizard
   - Recommended settings:
     - Site Title: Optimed Hospital
     - Admin Username: admin (change this)
     - Admin Password: (use a strong password)
     - Admin Email: your-email@example.com

5. **Activate the theme**
   - Go to Appearance → Themes
   - Activate "Optimed Modern" theme

6. **Import existing content** (Optional)
   - Install "All-in-One WP Migration" plugin
   - Go to All-in-One WP Migration → Import
   - Upload the .wpress file from the repository
   - The import will restore all content, settings, and configurations

### Manual Installation

1. **Install WordPress**
   - Download WordPress 6.9 from wordpress.org
   - Extract to your web server directory
   - Create a MySQL database

2. **Copy theme files**
   ```bash
   cp -r wp-content/themes/optimed-modern /path/to/wordpress/wp-content/themes/
   ```

3. **Install Composer dependencies** (optional)
   ```bash
   composer install
   ```

4. **Configure WordPress**
   - Copy `wp-config-sample.php` to `wp-config.php`
   - Update database credentials
   - Add security keys from https://api.wordpress.org/secret-key/1.1/salt/

5. **Complete installation**
   - Visit your domain in a browser
   - Follow WordPress setup wizard

## 🎨 Theme Configuration

### Menus
1. Go to Appearance → Menus
2. Create a "Primary Menu" and assign to "Primary Menu" location
3. Create a "Footer Menu" and assign to "Footer Menu" location

### Widgets
The theme supports the following widget areas:
- Sidebar (right sidebar on posts/pages)
- Footer 1, Footer 2, Footer 3 (three footer columns)

### Customization
1. Go to Appearance → Customize
2. Configure:
   - Site Identity (logo, title, tagline)
   - Colors (if using color customizer)
   - Homepage Settings
   - Menus
   - Widgets

## 🔌 Recommended Plugins

The following plugins are included via Composer:

### Performance
- **Redis Cache**: For object caching
- **WP Super Cache**: For page caching

### SEO
- **Yoast SEO**: Comprehensive SEO optimization

### Security
- **Wordfence**: Web application firewall and security scanner

### Functionality
- **Contact Form 7**: Contact forms
- **Elementor**: Page builder (optional)
- **Query Monitor**: Development and debugging (dev only)

## ⚡ Performance Optimizations

### Built-in Optimizations
- Lazy loading images
- Gzip compression (Nginx)
- Browser caching
- Minified assets
- Disabled emoji scripts
- Removed jQuery migrate
- Redis object caching
- Security headers

### Additional Optimizations
1. **Enable Redis**
   - Ensure Redis container is running
   - Install Redis Cache plugin
   - Go to Settings → Redis and enable object cache

2. **Configure WP Super Cache**
   - Go to Settings → WP Super Cache
   - Enable caching
   - Recommended: "Use mod_rewrite to serve cache files" (if available)

3. **Image Optimization**
   - Install an image optimization plugin (Smush, ShortPixel, etc.)
   - Enable lazy loading (already built into theme)

4. **CDN Setup** (Production)
   - Use Cloudflare or another CDN
   - Update wp-config.php with CDN URL

## 🔒 Security

### Built-in Security Features
- Security headers (X-Frame-Options, X-XSS-Protection, etc.)
- Disabled XML-RPC
- Removed version numbers from scripts/styles
- File permissions best practices
- Wordfence web application firewall

### Additional Security Steps
1. **Change default admin username**
2. **Use strong passwords**
3. **Enable two-factor authentication**
4. **Keep WordPress, themes, and plugins updated**
5. **Regular backups** (use UpdraftPlus or similar)
6. **Configure Wordfence**
   - Go to Wordfence → Options
   - Enable firewall protection level: "Extended Protection"
   - Enable email alerts

## 🚢 Deployment

### Production Deployment Steps

1. **Prepare production server**
   - PHP 8.1+
   - MySQL 8.0+ / MariaDB 10.5+
   - Nginx (recommended) or Apache
   - SSL certificate (Let's Encrypt)

2. **Export from development**
   ```bash
   # Using All-in-One WP Migration plugin
   # Go to All-in-One WP Migration → Export
   # Download the .wpress file
   ```

3. **Upload to production**
   - Install fresh WordPress on production server
   - Install All-in-One WP Migration plugin
   - Import the .wpress file

4. **Post-deployment checklist**
   - [ ] Update site URL in Settings → General
   - [ ] Test all pages and forms
   - [ ] Enable Redis cache
   - [ ] Enable WP Super Cache
   - [ ] Configure Wordfence
   - [ ] Set up automated backups
   - [ ] Test on mobile devices
   - [ ] Run Google PageSpeed Insights
   - [ ] Set up monitoring (uptime, performance)

### Using Docker in Production

Update `docker-compose.yml` for production:
- Change default passwords
- Set WORDPRESS_DEBUG to false
- Use persistent volumes
- Add SSL certificate configuration
- Configure proper domain names

## 📊 Monitoring & Maintenance

### Regular Maintenance
- [ ] Weekly: Check for WordPress, theme, and plugin updates
- [ ] Weekly: Review Wordfence scan results
- [ ] Monthly: Test backups and restore process
- [ ] Monthly: Review site performance (PageSpeed, GTmetrix)
- [ ] Quarterly: Security audit

### Performance Monitoring
- Google PageSpeed Insights
- GTmetrix
- WebPageTest
- Google Analytics

## 🆘 Troubleshooting

### Site is slow
1. Enable Redis cache
2. Enable WP Super Cache
3. Optimize images
4. Check plugin conflicts (disable all, enable one by one)
5. Increase PHP memory limit in wp-config.php

### White screen / 500 error
1. Check PHP error logs
2. Enable WordPress debug mode in wp-config.php
3. Check file permissions (755 for directories, 644 for files)
4. Deactivate all plugins
5. Switch to default theme

### Database connection error
1. Check database credentials in wp-config.php
2. Verify MySQL/MariaDB is running
3. Check database server is accessible
4. Verify database user has correct permissions

## 📝 Development

### Local Development Setup
```bash
# Start containers
docker-compose up -d

# View logs
docker-compose logs -f wordpress

# Stop containers
docker-compose down

# Stop and remove volumes (clean slate)
docker-compose down -v
```

### Theme Development
- Theme files: `wp-content/themes/optimed-modern/`
- CSS: Edit `style.css`
- JavaScript: Edit `js/main.js`
- Templates: Edit PHP files (index.php, header.php, footer.php, etc.)

### Coding Standards
- Follow WordPress Coding Standards
- Use PHP_CodeSniffer for validation
- Test on multiple browsers and devices

## 📞 Support

For issues or questions:
1. Check the documentation above
2. Search existing issues on GitHub
3. Contact the development team

## 📄 License

GPL-2.0-or-later

## 🎯 Roadmap

- [ ] Multi-language support (WPML/Polylang)
- [ ] Advanced appointment booking system
- [ ] Patient portal integration
- [ ] Telemedicine features
- [ ] Advanced analytics dashboard
- [ ] Mobile app integration

## 🙏 Credits

- WordPress
- Font Awesome
- Modern CSS techniques
- Docker Community

---

**Version**: 1.0.0  
**Last Updated**: December 2024  
**Maintained by**: Optimed Hospital Development Team
