# Blog CMS - CodeIgniter 4

## Features
- User Authentication (Register/Login/Logout)
- CRUD Operations for Blog Posts
- Form Validation
- REST API for Posts

## Routes

### Web
- / → View Posts
- /login → Login
- /register → Register
- /posts/create → Create Post

### API
- GET /api/posts
- GET /api/posts/{id}
- POST /api/posts
- DELETE /api/posts/{id}

## How to Run
1. Clone project
2. Setup database (blog_cms)
3. Run migrations:
   php spark migrate
4. Start server:
   php spark serve
5. Open:
   http://localhost:8080

## Tech Stack
- PHP
- CodeIgniter 4
- MySQL
- Bootstrap