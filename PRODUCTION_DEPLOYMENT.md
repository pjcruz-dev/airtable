# Production Deployment Guide

## Pre-deployment Checklist

### 1. Environment Configuration
Create a `.env` file with production settings:

```env
APP_NAME="FormBuilder"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=https://your-domain.com

DB_CONNECTION=sqlite
DB_DATABASE=/path/to/your/database.sqlite

SESSION_DRIVER=database
SESSION_LIFETIME=120

CACHE_STORE=database
QUEUE_CONNECTION=database

LOG_CHANNEL=stack
LOG_LEVEL=error

MAIL_MAILER=log
```

### 2. Generate Application Key
```bash
php artisan key:generate
```

### 3. Database Setup
```bash
# Run migrations
php artisan migrate --force

# Seed form templates
php artisan db:seed --class=FormTemplateSeeder
```

### 4. Storage Setup
```bash
# Create storage link
php artisan storage:link

# Set proper permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### 5. Optimization Commands
```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize application
php artisan optimize

# Build assets
npm run build
```

### 6. Web Server Configuration

#### Apache (.htaccess)
Ensure the following is in your `.htaccess` file in the `public` directory:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

#### Nginx
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/your/app/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### 7. Security Considerations

1. **Set proper file permissions:**
   ```bash
   chmod -R 755 storage
   chmod -R 755 bootstrap/cache
   chmod 644 database/database.sqlite
   ```

2. **Hide sensitive files:**
   - Ensure `.env` is not accessible via web
   - Hide `composer.json`, `package.json` from web access
   - Protect database files

3. **Enable HTTPS:**
   - Use SSL certificates
   - Force HTTPS redirects
   - Update `APP_URL` to use `https://`

### 8. Performance Optimization

1. **Enable OPcache** in PHP configuration
2. **Use a CDN** for static assets
3. **Set up database indexing** if needed
4. **Configure proper caching** strategies

### 9. Monitoring & Logging

1. **Set up log rotation**
2. **Monitor application performance**
3. **Set up error tracking** (Sentry, Bugsnag, etc.)
4. **Monitor database performance**

### 10. Backup Strategy

1. **Database backups:**
   ```bash
   # Backup SQLite database
   cp database/database.sqlite backups/database-$(date +%Y%m%d).sqlite
   ```

2. **File uploads backup:**
   ```bash
   # Backup storage directory
   tar -czf backups/storage-$(date +%Y%m%d).tar.gz storage/
   ```

### 11. Deployment Commands Summary

```bash
# Complete deployment script
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate --force
php artisan db:seed --class=FormTemplateSeeder
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
npm run build
```

### 12. Post-deployment Verification

1. Test all form functionality
2. Verify file uploads work
3. Check form submissions
4. Test form builder
5. Verify templates work
6. Check activity logs

## Production Features Included

✅ **Form Builder** - Drag & drop form creation
✅ **Form Templates** - Pre-built form templates
✅ **Live Preview** - Real-time form preview
✅ **Activity Logs** - Track all form activities
✅ **File Uploads** - Secure file handling
✅ **Modern UI/UX** - Professional design
✅ **Responsive Design** - Mobile-friendly
✅ **Optimized Performance** - Cached and optimized
✅ **Security** - CSRF protection, validation
✅ **Database** - SQLite for easy deployment

Your FormBuilder application is now ready for production deployment!

