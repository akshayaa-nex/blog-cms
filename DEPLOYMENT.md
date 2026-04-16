# 📋 Blog CMS - Deployment & Production Checklist

This guide helps you prepare your Blog CMS for production deployment.

---

## ✅ Pre-Deployment Checklist

### 1. Environment Configuration
- [ ] Set `CI_ENVIRONMENT = production` in `.env`
- [ ] Update database credentials for production database
- [ ] Set `debug = false` in config
- [ ] Update baseURL to production domain
- [ ] Generate secure encryption key

### 2. Security Hardening
- [ ] Enable HTTPS/SSL certificate
- [ ] Set secure cookies in session config
- [ ] Update CSRF token settings
- [ ] Configure CORS if needed
- [ ] Set proper file permissions (644 for files, 755 for directories)
- [ ] Remove debug toolbar from production

### 3. Database
- [ ] Create production database
- [ ] Run migrations on production: `php spark migrate`
- [ ] Backup development database
- [ ] Set strong database password
- [ ] Configure database user with limited permissions
- [ ] Enable database backups

### 4. Files & Directories
- [ ] Set `writable/` directory permissions (755)
- [ ] Create `writable/uploads/` for file uploads
- [ ] Set `.env` file permissions (600)
- [ ] Exclude `.env` from version control
- [ ] Remove development files before deployment

### 5. Performance
- [ ] Enable query caching
- [ ] Configure Redis/Memcached (optional)
- [ ] Enable asset compression (CSS/JS minification)
- [ ] Configure CDN for static assets
- [ ] Set up logging on production server

### 6. Monitoring & Logging
- [ ] Configure error logging
- [ ] Set up log rotation
- [ ] Monitor disk space
- [ ] Set up uptime monitoring
- [ ] Configure backup notifications

---

## 🚀 Deployment Steps

### On Production Server

#### 1. Install Dependencies
```bash
cd /var/www/blog-cms
composer install --no-dev --optimize-autoloader
```

#### 2. Configure Environment
```bash
# Copy and edit .env for production
cp env .env
nano .env

# Set these values:
# CI_ENVIRONMENT = production
# database.default.hostname = prod_host
# database.default.database = prod_db
# database.default.username = prod_user
# database.default.password = prod_pass
```

#### 3. Generate Encryption Key
```bash
php spark key:generate
```

#### 4. Set Permissions
```bash
chmod 755 writable/
chmod 644 .env
chmod 755 writable/cache/
chmod 755 writable/logs/
chmod 755 writable/session/
chmod 755 writable/uploads/
```

#### 5. Database Setup
```bash
php spark migrate
# Optional: php spark db:seed InitialSeeder
```

#### 6. Configure Web Server

**Nginx Configuration:**
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/blog-cms/public;
    index index.php;

    # SSL redirect
    if ($scheme != "https") {
        return 301 https://$server_name$request_uri;
    }

    location / {
        try_files $uri $uri/ /index.php?/$request_uri;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

**Apache Configuration:**
```apache
<VirtualHost *:443>
    ServerName yourdomain.com
    DocumentRoot /var/www/blog-cms/public

    <Directory /var/www/blog-cms/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    SSLEngine on
    SSLCertificateFile /path/to/certificate.crt
    SSLCertificateKeyFile /path/to/private.key
</VirtualHost>
```

#### 7. Enable HTTPS
```bash
# Using Let's Encrypt with Certbot
sudo certbot certonly --webroot -w /var/www/blog-cms/public -d yourdomain.com
```

#### 8. Configure Firewall
```bash
# UFW (Ubuntu)
sudo ufw allow 22
sudo ufw allow 80
sudo ufw allow 443
sudo ufw enable
```

---

## 🔍 Post-Deployment Verification

### Test Application
```bash
# Check homepage
curl https://yourdomain.com

# Test API endpoint
curl https://yourdomain.com/api/posts

# Check error logs
tail -f /var/log/nginx/error.log
```

### Verify Security
- [ ] HTTPS is working (green padlock)
- [ ] CSRF tokens are generated
- [ ] Cookies are secure and HTTP-only
- [ ] Database credentials are not exposed
- [ ] Error messages don't reveal system info

### Performance Check
- [ ] Page load time < 2 seconds
- [ ] Database queries are optimized
- [ ] CSS/JS are minified
- [ ] Images are optimized
- [ ] Cache headers are set

---

## 📊 Production Monitoring

### Set Up Monitoring
```bash
# Monitor application logs
tail -f writable/logs/log-*.log

# Monitor system resources
htop

# Check disk usage
df -h

# Monitor PHP-FPM
ps aux | grep php-fpm
```

### Configure Logging

Create `app/Config/Logger.php` configuration:
```php
public array $handlers = [
    'CodeIgniter\Log\Handlers\FileHandler' => [
        'handles' => ['error', 'warning'],
        'path' => WRITEPATH . 'logs/',
    ],
];
```

### Set Up Log Rotation
```bash
# Create /etc/logrotate.d/blog-cms
/var/www/blog-cms/writable/logs/*.log {
    daily
    rotate 14
    compress
    delaycompress
    notifempty
    create 0644 www-data www-data
    sharedscripts
}
```

---

## 🔄 Database Backup Strategy

### Automated Daily Backups
```bash
# Create backup script: /usr/local/bin/backup-blog-cms.sh
#!/bin/bash
BACKUP_DIR="/backups/blog-cms"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)

mkdir -p $BACKUP_DIR
mysqldump -u db_user -p'db_pass' blog_cms > $BACKUP_DIR/blog_cms_$TIMESTAMP.sql
gzip $BACKUP_DIR/blog_cms_$TIMESTAMP.sql

# Keep only 30 days of backups
find $BACKUP_DIR -name "*.sql.gz" -mtime +30 -delete

echo "Backup completed: $BACKUP_DIR/blog_cms_$TIMESTAMP.sql.gz"

# Add to crontab: 0 2 * * * /usr/local/bin/backup-blog-cms.sh
```

### Backup Application Files
```bash
# Create backup script: /usr/local/bin/backup-app.sh
#!/bin/bash
BACKUP_DIR="/backups/blog-cms-app"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)

tar -czf $BACKUP_DIR/blog-cms_$TIMESTAMP.tar.gz /var/www/blog-cms

# Keep only 30 days of backups
find $BACKUP_DIR -name "*.tar.gz" -mtime +30 -delete

echo "App backup completed: $BACKUP_DIR/blog-cms_$TIMESTAMP.tar.gz"

# Add to crontab: 0 3 * * * /usr/local/bin/backup-app.sh
```

---

## 🆘 Troubleshooting Production Issues

### High CPU Usage
```bash
# Check running processes
top

# Check database slow queries
mysql> SET GLOBAL slow_query_log = 'ON';
mysql> SHOW VARIABLES LIKE '%slow%';
```

### Database Connection Errors
```bash
# Test database connection
mysql -h prod_host -u prod_user -p prod_db

# Check MySQL logs
tail -f /var/log/mysql/error.log
```

### File Permission Issues
```bash
# Reset permissions
sudo chown -R www-data:www-data /var/www/blog-cms
sudo chmod -R 755 /var/www/blog-cms
sudo chmod 644 /var/www/blog-cms/.env
```

### SSL Certificate Issues
```bash
# Check certificate expiration
openssl x509 -in /path/to/cert.crt -noout -dates

# Renew Let's Encrypt certificate
sudo certbot renew
```

---

## 🔐 Security Best Practices

### Regular Updates
```bash
# Update PHP packages
sudo apt-get install --only-upgrade php8.2*

# Update CodeIgniter
composer update codeigniter4/framework

# Update all dependencies
composer update
```

### SQL Injection Prevention
- ✅ All queries use parameterized queries
- ✅ Input validation is enabled
- ✅ Never use raw user input in queries

### XSS Prevention
- ✅ All output is escaped with htmlspecialchars()
- ✅ CSP headers are configured
- ✅ Script tags are stripped from user input

### CSRF Protection
- ✅ CSRF tokens on all forms
- ✅ Token validation on POST requests
- ✅ SameSite cookie attribute set

---

## 📈 Scaling Considerations

### For High Traffic

1. **Database Optimization**
   - Add indexes on frequently queried columns
   - Implement query caching
   - Consider read replicas

2. **Application Caching**
   - Enable Redis for sessions
   - Cache expensive queries
   - Use file-based caching for static content

3. **Load Balancing**
   - Use multiple app servers
   - Implement session sharing (Redis)
   - Use sticky sessions if needed

4. **CDN**
   - Serve static assets from CDN
   - Cache images and CSS/JS
   - Reduce server load

---

## 📞 Emergency Contacts & Procedures

### If Application Goes Down

1. Check logs: `tail -f writable/logs/*.log`
2. Verify database connection
3. Check disk space: `df -h`
4. Check PHP-FPM status: `systemctl status php8.2-fpm`
5. Restart services if needed: `systemctl restart nginx php8.2-fpm`

### Emergency Rollback

```bash
# Restore from backup
tar -xzf /backups/blog-cms-app/blog-cms_YYYYMMDD.tar.gz -C /var/www/

# Restore database
mysql blog_cms < /backups/blog-cms/blog_cms_YYYYMMDD.sql
```

---

## ✨ Post-Deployment Enhancements

### Recommended Additions
- [ ] Email notifications (comments, posts)
- [ ] User subscriptions
- [ ] Advanced analytics
- [ ] Social media integration
- [ ] Full-text search (Elasticsearch)
- [ ] API rate limiting
- [ ] Two-factor authentication

---

**Your Blog CMS is now production-ready! 🎉**
