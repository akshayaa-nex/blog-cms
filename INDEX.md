# 📖 Blog CMS - Complete Index & Getting Started

Welcome to your **comprehensive Blog CMS built with CodeIgniter 4**! 

This document will guide you through all the files and how to get started.

---

## 📚 Documentation Files (Read These First!)

### 1. **PROJECT_SUMMARY.md** ⭐ START HERE
   - Overview of what was created
   - Quick statistics
   - Feature highlights
   - Technology stack

### 2. **QUICKSTART.md** 
   - 5-minute setup guide
   - Installation steps
   - Running the application
   - Testing endpoints

### 3. **README.md**
   - Full API documentation
   - Database schema
   - Installation details
   - All 30+ API endpoints
   - Deployment guide

### 4. **API_TESTING.md**
   - Complete API testing guide
   - cURL examples
   - JavaScript Fetch examples
   - Response samples
   - Testing checklist

---

## 🎯 Quick Setup (Copy & Paste)

```bash
# 1. Install dependencies
composer install

# 2. Copy environment file
cp env .env

# 3. Configure database in .env
# Edit: database.default.database, username, password

# 4. Create database
mysql -u root -p
CREATE DATABASE blog_cms;

# 5. Run migrations and seed
php spark migrate
php spark db:seed InitialSeeder

# 6. Start server
php spark serve

# 7. Access application
# Homepage: http://localhost:8080
# Admin: admin@example.com / admin123
# User: john@example.com / password123
```

---

## 🗂️ File Organization

### Database & Models
```
app/Database/Migrations/
├── 2024_04_16_100000_create_users_table.php
├── 2024_04_16_200000_create_posts_table.php
├── 2024_04_16_300000_create_categories_table.php
├── 2024_04_16_400000_create_post_categories_table.php
└── 2024_04_16_500000_create_comments_table.php

app/Database/Seeds/
└── InitialSeeder.php

app/Models/
├── UserModel.php
├── PostModel.php
├── CategoryModel.php
└── CommentModel.php
```

### Controllers & Routes
```
app/Controllers/
├── Auth.php
├── Home.php
├── Dashboard.php
└── API/
    ├── Posts.php
    ├── Comments.php
    ├── Categories.php
    └── Users.php

app/Config/
├── Routes.php (configured with 30+ routes)
└── Database.php
```

### Views & Templates
```
app/Views/
├── layout.php (master template)
├── home.php
├── auth/
│   ├── login.php
│   └── register.php
├── dashboard/
│   ├── index.php
│   ├── posts.php
│   ├── create_post.php
│   └── edit_post.php
└── posts/
    └── detail.php
```

---

## 🚀 Features Overview

### User Authentication
- Register new account (form validation)
- Login with email/password
- Password hashing with bcrypt
- Session management
- User roles (user/admin)
- User profiles

### Blog Management
- Create, read, update, delete posts
- Draft and publish posts
- Featured posts
- Post slugs (SEO-friendly URLs)
- View counting
- Featured images
- By status (draft/published/archived)

### Comments System
- Post comments with moderation
- Anonymous + authenticated comments
- Admin approval system
- Comment listing per post

### Categories
- Organize posts by category
- Browse posts by category
- Category management

### REST API
- 30+ endpoints
- JSON responses
- Full documentation
- Example requests
- Testing guide

---

## 🔌 API Endpoints Quick Reference

### Authentication
```
POST   /auth/register         - Create account
POST   /auth/login            - Login user
GET    /auth/logout           - Logout
GET    /auth/current-user     - Get logged-in user
```

### Posts (REST)
```
GET    /api/posts                 - List all posts
GET    /api/posts/featured        - Get featured posts
GET    /api/posts/search?q=...    - Search posts
GET    /api/posts/{id}            - Get single post
POST   /api/posts                 - Create post (auth)
PATCH  /api/posts/{id}            - Update post (auth)
DELETE /api/posts/{id}            - Delete post (auth)
```

### Comments
```
GET    /api/posts/{id}/comments   - Get comments
POST   /api/comments              - Add comment
PATCH  /api/comments/{id}/approve - Approve (admin)
DELETE /api/comments/{id}         - Delete (auth)
```

### Categories
```
GET    /api/categories            - List all
GET    /api/categories/{id}       - Get category posts
POST   /api/categories            - Create (admin)
PATCH  /api/categories/{id}       - Update (admin)
DELETE /api/categories/{id}       - Delete (admin)
```

### Users
```
GET    /api/users                 - List all users
GET    /api/users/{id}            - Get user profile
PATCH  /api/users/{id}            - Update profile (auth)
```

---

## 🧪 Test the Application

### Option 1: Web Interface
1. Go to http://localhost:8080
2. Click "Register" to create account
3. Login
4. Go to Dashboard
5. Create a post
6. View posts on homepage

### Option 2: API with cURL
```bash
# Get all posts
curl http://localhost:8080/api/posts

# Login (save cookies)
curl -c cookies.txt -X POST http://localhost:8080/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@example.com","password":"admin123"}'

# Create post (using saved cookies)
curl -b cookies.txt -X POST http://localhost:8080/api/posts \
  -H "Content-Type: application/json" \
  -d '{
    "title":"My Post",
    "excerpt":"Short desc",
    "content":"Full content...",
    "status":"published"
  }'
```

### Option 3: Postman
1. Import the API endpoints from API_TESTING.md
2. Test each endpoint
3. Check responses

---

## ⚙️ Configuration Files

### Database Config (.env)
```
database.default.hostname = localhost
database.default.username = root
database.default.password = 
database.default.database = blog_cms
```

### App Config (app/Config/App.php)
- Base URL
- Security settings
- Session configuration

### Routes (app/Config/Routes.php)
- All frontend routes
- All API routes
- Authentication routes

---

## 🔒 Security Features

- ✅ CSRF token protection (all forms)
- ✅ Password hashing (bcrypt)
- ✅ Input validation (server-side)
- ✅ Authorization checks
- ✅ Role-based access control
- ✅ Session security
- ✅ Soft deletes (data privacy)
- ✅ SQL injection prevention

---

## 📊 Database Tables

### users
- id, username, email, password_hash, first_name, last_name, bio, avatar_url, is_active, role, timestamps

### posts
- id, user_id, title, slug, excerpt, content, featured_image, status, views_count, is_featured, published_at, timestamps

### categories
- id, name, slug, description, timestamps

### post_categories
- id, post_id, category_id (many-to-many)

### comments
- id, post_id, user_id, name, email, content, is_approved, timestamps

---

## 🎨 Default Credentials (After Seeding)

| Role | Username | Email | Password |
|------|----------|-------|----------|
| Admin | admin | admin@example.com | admin123 |
| User | johndoe | john@example.com | password123 |
| User | janedoe | jane@example.com | password123 |

---

## 🆘 Troubleshooting

### Database Connection Error
```bash
# Check MySQL is running
# Check .env credentials
# Verify database exists: CREATE DATABASE blog_cms;
```

### Migration Fails
```bash
# Reset migrations
php spark migrate:refresh

# Reseed data
php spark db:seed InitialSeeder
```

### Can't Access Application
```bash
# Clear cache
php spark cache:clear

# Check error logs
tail writable/logs/*
```

### API Returns 401
```bash
# Login first and save cookies
curl -c cookies.txt -X POST http://localhost:8080/auth/login ...

# Use cookies in requests
curl -b cookies.txt http://localhost:8080/api/posts
```

---

## 📚 Learn More

- [CodeIgniter 4 Docs](https://codeigniter.com/docs)
- [Bootstrap 5 Docs](https://getbootstrap.com/docs/5.0)
- [REST API Best Practices](https://restfulapi.net)
- [MySQL Documentation](https://dev.mysql.com/doc)

---

## 📝 What's Included

✅ 5 migrations (database tables)  
✅ 4 models (with relationships)  
✅ 7 controllers (web + API)  
✅ 9 views (templates)  
✅ 30+ API routes  
✅ Authentication system  
✅ Dashboard interface  
✅ Sample data (seeder)  
✅ Complete documentation  
✅ Setup scripts (Windows/Linux)  

---

## 🚀 Next Steps

1. **Read PROJECT_SUMMARY.md** - Get overview
2. **Follow QUICKSTART.md** - Set up locally
3. **Test API with API_TESTING.md** - Try endpoints
4. **Read full README.md** - Learn all details
5. **Customize & Deploy** - Make it your own

---

## 💡 Tips

- Use `php spark` to see all available commands
- Check `writable/logs/` for error logs
- Use `php spark db:seed InitialSeeder` to add test data
- Update CSS in `public/css/` (or modify layout.php)
- Add features by creating new controllers/models

---

## 📞 Support

- Check documentation files (README.md, QUICKSTART.md, API_TESTING.md)
- Review error messages in logs
- Refer to CodeIgniter documentation
- Check API responses for validation errors

---

## 🎉 You're Ready!

Your comprehensive Blog CMS is installed and ready to use.

**Start with:** QUICKSTART.md → README.md → API_TESTING.md

**Happy blogging!** 🚀
