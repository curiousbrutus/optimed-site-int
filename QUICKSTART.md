# Quick Start Guide - Optimed Hospital WordPress Site

Get your modern WordPress site up and running in minutes!

## 🚀 Quick Start (5 Minutes)

### Prerequisites
- Docker Desktop installed ([Download here](https://www.docker.com/products/docker-desktop))
- Git installed
- 10GB free disk space

### Step 1: Clone the Repository
```bash
git clone <your-repo-url>
cd optimed-site-int
```

### Step 2: Run Setup Script
```bash
chmod +x setup.sh
./setup.sh
```

The setup script will:
- ✅ Check if Docker is installed
- ✅ Create environment configuration
- ✅ Create necessary directories
- ✅ Start all Docker containers
- ✅ Set up WordPress, MySQL, Redis, Nginx, and phpMyAdmin

### Step 3: Access Your Site
Wait about 30 seconds for services to start, then open:
- **Website**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081 (username: `root`, password: `root_password`)

### Step 4: Complete WordPress Installation
1. Visit http://localhost:8080
2. Select your language
3. Click "Let's go!"
4. Database details are already configured (click "Submit" then "Run the installation")
5. Fill in:
   - **Site Title**: Optimed Hospital
   - **Username**: (choose your admin username)
   - **Password**: (choose a strong password)
   - **Email**: your-email@example.com
6. Click "Install WordPress"

### Step 5: Activate the Theme
1. Log in to WordPress admin (http://localhost:8080/wp-admin)
2. Go to **Appearance → Themes**
3. Find "Optimed Modern" and click **Activate**

### Step 6: Import Existing Content (Optional)
If you have the .wpress backup file:

1. Go to **Plugins → Add New**
2. Search for "All-in-One WP Migration"
3. Install and activate it
4. Go to **All-in-One WP Migration → Import**
5. Click "Import From → File"
6. Select your .wpress file
7. Wait for import to complete
8. The site will automatically use the imported content and settings

## 🎨 Customize Your Site

### Add Your Logo
1. Go to **Appearance → Customize**
2. Click **Site Identity**
3. Click **Select Logo** and upload your logo
4. Click **Publish**

### Create Navigation Menu
1. Go to **Appearance → Menus**
2. Create a new menu called "Main Menu"
3. Add pages (Home, About, Services, Contact, etc.)
4. Assign to "Primary Menu" location
5. Click "Save Menu"

### Edit Homepage Content
1. Go to **Pages → All Pages**
2. Edit the "Home" page
3. Update the content as needed
4. Click "Update"

## 🔌 Recommended First Plugins to Configure

### 1. Redis Cache (Already included)
```
Settings → Redis
Click "Enable Object Cache"
```

### 2. WP Super Cache
```
Settings → WP Super Cache
Select "Caching On"
Click "Update Status"
```

### 3. Yoast SEO
```
SEO → General → Configuration Wizard
Follow the wizard to configure SEO settings
```

### 4. Wordfence Security
```
Wordfence → Dashboard
Click "Get Wordfence"
Follow setup wizard
```

### 5. Contact Form 7
```
Contact → Add New
Create your contact form
Use shortcode in pages: [contact-form-7 id="1" title="Contact form 1"]
```

## 📱 Testing Your Site

### Test Responsiveness
Open in different browsers and devices:
- Desktop (Chrome, Firefox, Safari, Edge)
- Tablet (iPad, Android tablet)
- Mobile (iPhone, Android phone)

Or use browser dev tools (F12) and toggle device toolbar.

### Test Performance
1. Visit [Google PageSpeed Insights](https://pagespeed.web.dev/)
2. Enter http://localhost:8080 (won't work for localhost, test after deployment)
3. Check performance scores and recommendations

## 🛠️ Common Tasks

### View Logs
```bash
docker compose logs -f wordpress
docker compose logs -f nginx
```

### Stop the Site
```bash
docker compose down
```

### Restart the Site
```bash
docker compose restart
```

### Start Fresh (Delete all data)
```bash
docker compose down -v
docker compose up -d
```

### Backup Your Site
```bash
# From WordPress admin
All-in-One WP Migration → Export → Export to File
```

### Access MySQL Database Directly
```bash
docker compose exec db mysql -u wordpress -pwordpress_password wordpress
```

### Access WordPress Container
```bash
docker compose exec wordpress bash
```

## ⚡ Performance Tips

1. **Enable Caching**: Enable Redis and WP Super Cache (see above)
2. **Optimize Images**: Install Smush or ShortPixel plugin
3. **Use CDN**: For production, use Cloudflare (free tier available)
4. **Minimize Plugins**: Only install what you need
5. **Keep Updated**: Regularly update WordPress, themes, and plugins

## 🔒 Security Tips

1. **Strong Passwords**: Use unique, complex passwords
2. **Limit Login Attempts**: Install "Limit Login Attempts Reloaded"
3. **Two-Factor Auth**: Install "Two Factor Authentication" plugin
4. **Regular Backups**: Schedule automatic backups
5. **Hide Login Page**: Use "WPS Hide Login" to change wp-admin URL
6. **SSL Certificate**: Use HTTPS in production (Let's Encrypt is free)

## 📊 Analytics Setup

### Google Analytics
1. Create account at [Google Analytics](https://analytics.google.com/)
2. Get tracking ID
3. Install "MonsterInsights" or "GA Google Analytics" plugin
4. Add tracking ID in plugin settings

### Google Search Console
1. Visit [Google Search Console](https://search.google.com/search-console)
2. Add your domain
3. Verify ownership (use Yoast SEO verification method)
4. Submit sitemap (use Yoast SEO sitemap URL)

## 🆘 Troubleshooting

### Site won't load
```bash
# Check if containers are running
docker compose ps

# Restart containers
docker compose restart

# Check logs for errors
docker compose logs wordpress
```

### Can't log in to WordPress
```bash
# Reset password from database
docker compose exec db mysql -u root -proot_password wordpress
# Then run: UPDATE wp_users SET user_pass=MD5('newpassword') WHERE ID=1;
```

### Changes not showing
1. Clear WordPress cache (WP Super Cache → Delete Cache)
2. Clear Redis cache (Settings → Redis → Flush Cache)
3. Clear browser cache (Ctrl+Shift+Delete)
4. Hard refresh page (Ctrl+F5)

### Docker errors
```bash
# Stop all containers
docker compose down

# Remove unused Docker data
docker system prune

# Start again
docker compose up -d
```

## 📚 Next Steps

1. ✅ Site is running
2. ⬜ Customize design and colors
3. ⬜ Add your content (pages, posts, images)
4. ⬜ Set up contact forms
5. ⬜ Configure SEO settings
6. ⬜ Test on mobile devices
7. ⬜ Set up backups
8. ⬜ Deploy to production server

## 🎯 Production Deployment

When ready to go live, see [DEPLOYMENT.md](DEPLOYMENT.md) for detailed deployment instructions.

Quick checklist:
- [ ] Get a domain name
- [ ] Get web hosting (VPS recommended)
- [ ] Set up SSL certificate
- [ ] Export site with All-in-One WP Migration
- [ ] Import to production server
- [ ] Update URLs in Settings → General
- [ ] Test everything thoroughly
- [ ] Set up monitoring and backups

## 📞 Getting Help

- Check [README.md](README.md) for detailed documentation
- Check [DEPLOYMENT.md](DEPLOYMENT.md) for deployment help
- Search [WordPress Support Forums](https://wordpress.org/support/)
- Check [Stack Overflow](https://stackoverflow.com/questions/tagged/wordpress)

## 🎉 Congratulations!

You now have a modern, fast, and secure WordPress site running!

Enjoy building your Optimed Hospital website! 🏥
