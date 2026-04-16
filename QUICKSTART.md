# Blog CMS - Quick Start Guide

## 🚀 Getting Started

### Prerequisites
- PHP 8.2+
- MySQL/MariaDB
- Composer
- Git (optional)

---

## ⚡ Quick Installation

### 1. Install Dependencies
```bash
composer install
```

### 2. Setup Environment
```bash
# Copy environment file
cp env .env
```

Edit `.env` and configure your database:
```
database.default.hostname = localhost
database.default.database = blog_cms
database.default.username = root
database.default.password = your_password
```

### 3. Create Database
```bash
mysql -u root -p
CREATE DATABASE blog_cms;
EXIT;
```

### 4. Run Migrations
```bash
php spark migrate
```

### 5. Start Server
```bash
php spark serve
```

Access at: **http://localhost:8080**

---

## 📚 What's Included

### Database Tables
- ✅ Users (with roles and profiles)
- ✅ Posts (with status and featured)
- ✅ Categories
- ✅ Comments (with moderation)
- ✅ Post-Categories (many-to-many)

### Controllers
- ✅ Auth (Login/Register/Logout)
- ✅ Home (Frontend posts view)
- ✅ Dashboard (User CRUD)
- ✅ API (RESTful endpoints)

### Features
- ✅ User authentication
- ✅ Post CRUD operations
- ✅ Comment moderation
- ✅ Featured posts
- ✅ Search functionality
- ✅ Pagination
- ✅ Role-based access control

---

## 🔌 API Endpoints

All endpoints accessible at `/api` prefix.

### Posts
- `GET /api/posts` - Get all posts
- `GET /api/posts/{id}` - Get single post
- `POST /api/posts` - Create post (auth required)
- `PATCH /api/posts/{id}` - Update post (auth required)
- `DELETE /api/posts/{id}` - Delete post (auth required)

### Comments
- `GET /api/posts/{postId}/comments` - Get comments
- `POST /api/comments` - Create comment
- `DELETE /api/comments/{id}` - Delete comment (auth required)

### Categories
- `GET /api/categories` - Get all categories
- `POST /api/categories` - Create category (admin only)

### Users
- `GET /api/users` - Get all users
- `GET /api/users/{id}` - Get user profile
- `PATCH /api/users/{id}` - Update profile (auth required)

### Authentication
- `GET /auth/login` - Login form
- `POST /auth/login` - Process login
- `GET /auth/register` - Register form
- `POST /auth/register` - Process registration
- `GET /auth/logout` - Logout user

---

## 🧪 Testing the API

### Using cURL

Register a user:
```bash
curl -X POST http://localhost:8080/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "username": "testuser",
    "email": "test@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

Get all posts:
```bash
curl http://localhost:8080/api/posts
```

Create a post (with session):
```bash
curl -X POST http://localhost:8080/api/posts \
  -H "Content-Type: application/json" \
  -d '{
    "title": "My First Post",
    "excerpt": "Brief description",
    "content": "Full post content here",
    "status": "published"
  }'
```

---

## 📂 Project Structure

```
BlogCMS/
├── app/
│   ├── Controllers/
│   │   ├── Auth.php
│   │   ├── Home.php
│   │   ├── Dashboard.php
│   │   └── API/
│   ├── Models/
│   │   ├── UserModel.php
│   │   ├── PostModel.php
│   │   ├── CategoryModel.php
│   │   └── CommentModel.php
│   ├── Views/
│   │   ├── layout.php
│   │   ├── home.php
│   │   ├── auth/
│   │   ├── dashboard/
│   │   └── posts/
│   ├── Database/
│   │   └── Migrations/
│   └── Config/
│       ├── Database.php
│       └── Routes.php
├── public/
│   └── index.php
├── README.md
└── composer.json
```

---

## 🔒 Default Security Features

- CSRF token protection
- Password hashing (bcrypt)
- Session-based authentication
- Role-based access control
- Input validation
- Soft delete support

---

## 📝 Common Tasks

### Create Admin User (via Migration/Seeder)
```php
// Add to a migration or seed file
$data = [
    'username'      => 'admin',
    'email'         => 'admin@example.com',
    'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
    'first_name'    => 'Admin',
    'role'          => 'admin',
    'is_active'     => 1
];
$this->userModel->save($data);
```

### Enable Query Logging
In `.env`:
```
CI_ENVIRONMENT = development
database.default.DBDebug = true
```

### Change Database
Edit `app/Config/Database.php` and update connection details.

---

## 🆘 Troubleshooting

### Database Connection Error
- Verify MySQL is running
- Check database credentials in `.env`
- Ensure database exists

### Migration Fails
```bash
# Reset migrations
php spark migrate:refresh

# Recreate from scratch
php spark migrate:refresh --seed
```

### 404 Errors
- Check routes in `app/Config/Routes.php`
- Verify controller methods exist
- Clear cache: `php spark cache:clear`

### Session Issues
- Ensure `writable/session/` directory exists
- Check PHP session configuration

---

## 📚 Additional Resources

- **CodeIgniter 4 Docs**: https://codeigniter.com/docs
- **MySQL Docs**: https://dev.mysql.com/doc
- **PHP Documentation**: https://www.php.net/docs.php

---

## 🎯 Next Steps

1. Create your first user via registration
2. Login to dashboard
3. Create a post
4. Test API endpoints
5. Customize views and add features

---

**Happy blogging! 🎉**
