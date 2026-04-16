# Blog CMS - API Testing Guide

## 🧪 Complete API Testing Reference

This guide provides examples for testing all API endpoints using cURL, Postman, or JavaScript Fetch.

---

## 📋 Test Credentials

After running seeders:
```
Admin User:
  Username: admin
  Email: admin@example.com
  Password: admin123

Regular User:
  Username: johndoe
  Email: john@example.com
  Password: password123
```

---

## 🚀 Quick Test Commands

### Get All Posts
```bash
curl http://localhost:8080/api/posts
```

### Get Featured Posts
```bash
curl http://localhost:8080/api/posts/featured
```

### Search Posts
```bash
curl "http://localhost:8080/api/posts/search?q=CodeIgniter"
```

### Get Single Post by ID
```bash
curl http://localhost:8080/api/posts/1
```

### Get Post by Slug
```bash
curl http://localhost:8080/api/posts/slug/getting-started-with-codeigniter-4
```

---

## 👤 Authentication Endpoints

### Register New User
```bash
curl -X POST http://localhost:8080/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "username": "newuser",
    "email": "newuser@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "first_name": "New",
    "last_name": "User"
  }'
```

### Login
```bash
curl -X POST http://localhost:8080/auth/login \
  -H "Content-Type: application/json" \
  -c cookies.txt \
  -d '{
    "email": "admin@example.com",
    "password": "admin123"
  }'
```

**Note:** Save cookies with `-c cookies.txt` and use with `-b cookies.txt` for authenticated requests.

### Get Current User (requires auth)
```bash
curl -b cookies.txt http://localhost:8080/auth/current-user
```

### Logout
```bash
curl -b cookies.txt http://localhost:8080/auth/logout
```

---

## 📝 Post Endpoints

### Create New Post (requires authentication)
```bash
curl -X POST http://localhost:8080/api/posts \
  -H "Content-Type: application/json" \
  -b cookies.txt \
  -d '{
    "title": "My Awesome Post",
    "excerpt": "This is an exciting new post about web development",
    "content": "Here is the full content of my post. It can contain as much text as needed. Lorem ipsum dolor sit amet...",
    "featured_image": "https://example.com/image.jpg",
    "status": "published"
  }'
```

### Update Post (requires authentication)
```bash
curl -X PATCH http://localhost:8080/api/posts/1 \
  -H "Content-Type: application/json" \
  -b cookies.txt \
  -d '{
    "title": "Updated Title",
    "excerpt": "Updated excerpt",
    "status": "published",
    "is_featured": true
  }'
```

### Delete Post (requires authentication)
```bash
curl -X DELETE http://localhost:8080/api/posts/1 \
  -H "Content-Type: application/json" \
  -b cookies.txt
```

### Get User Posts
```bash
curl http://localhost:8080/api/posts/user/1
```

### Get Posts with Pagination
```bash
curl "http://localhost:8080/api/posts?page=1&per_page=5"
```

---

## 💬 Comment Endpoints

### Get Comments for Post
```bash
curl http://localhost:8080/api/posts/1/comments
```

### Create Comment (no auth required)
```bash
curl -X POST http://localhost:8080/api/comments \
  -H "Content-Type: application/json" \
  -d '{
    "post_id": 1,
    "name": "Your Name",
    "email": "your@email.com",
    "content": "This is a great post! Very informative."
  }'
```

### Approve Comment (admin only)
```bash
curl -X PATCH http://localhost:8080/api/comments/1/approve \
  -b cookies.txt \
  -H "Content-Type: application/json"
```

### Delete Comment (requires authentication)
```bash
curl -X DELETE http://localhost:8080/api/comments/1 \
  -b cookies.txt \
  -H "Content-Type: application/json"
```

---

## 📂 Category Endpoints

### Get All Categories
```bash
curl http://localhost:8080/api/categories
```

### Get Category with Posts
```bash
curl http://localhost:8080/api/categories/1
```

### Create Category (admin only)
```bash
curl -X POST http://localhost:8080/api/categories \
  -H "Content-Type: application/json" \
  -b cookies.txt \
  -d '{
    "name": "New Category",
    "slug": "new-category",
    "description": "Description of the category"
  }'
```

### Update Category (admin only)
```bash
curl -X PATCH http://localhost:8080/api/categories/1 \
  -H "Content-Type: application/json" \
  -b cookies.txt \
  -d '{
    "name": "Updated Category Name",
    "description": "Updated description"
  }'
```

### Delete Category (admin only)
```bash
curl -X DELETE http://localhost:8080/api/categories/1 \
  -b cookies.txt
```

---

## 👥 User Endpoints

### Get All Users
```bash
curl http://localhost:8080/api/users
```

### Get User Profile
```bash
curl http://localhost:8080/api/users/1
```

### Update User Profile (requires authentication)
```bash
curl -X PATCH http://localhost:8080/api/users/1 \
  -H "Content-Type: application/json" \
  -b cookies.txt \
  -d '{
    "first_name": "Updated Name",
    "bio": "My updated bio",
    "avatar_url": "https://example.com/avatar.jpg"
  }'
```

---

## 🧪 JavaScript Fetch Examples

### Login and Save Session
```javascript
async function login() {
    const response = await fetch('/auth/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include', // Important for sessions
        body: JSON.stringify({
            email: 'admin@example.com',
            password: 'admin123'
        })
    });
    
    return await response.json();
}

login().then(data => console.log('Logged in:', data));
```

### Create Post
```javascript
async function createPost() {
    const response = await fetch('/api/posts', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include',
        body: JSON.stringify({
            title: 'My New Post',
            excerpt: 'A brief overview',
            content: 'Full post content here',
            status: 'published'
        })
    });
    
    return await response.json();
}

createPost().then(result => console.log('Post created:', result));
```

### Get All Posts with Pagination
```javascript
async function getPosts(page = 1, perPage = 10) {
    const response = await fetch(`/api/posts?page=${page}&per_page=${perPage}`);
    const data = await response.json();
    
    console.log('Posts:', data.data);
    console.log('Total pages:', data.pagination.total_pages);
    
    return data;
}

getPosts(1, 5);
```

### Search Posts
```javascript
async function searchPosts(keyword) {
    const response = await fetch(`/api/posts/search?q=${encodeURIComponent(keyword)}`);
    const data = await response.json();
    
    return data.data;
}

searchPosts('CodeIgniter').then(results => console.log('Search results:', results));
```

### Submit Comment
```javascript
async function submitComment(postId, name, email, content) {
    const response = await fetch('/api/comments', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            post_id: postId,
            name: name,
            email: email,
            content: content
        })
    });
    
    return await response.json();
}

submitComment(1, 'John Doe', 'john@example.com', 'Great post!')
    .then(result => console.log('Comment submitted:', result));
```

---

## 🔧 Response Examples

### Successful Post Creation (201)
```json
{
    "message": "Post created successfully",
    "post_id": 42
}
```

### Post List Response
```json
{
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "title": "Getting Started with CodeIgniter 4",
            "slug": "getting-started-with-codeigniter-4",
            "excerpt": "Learn the basics of CodeIgniter 4...",
            "status": "published",
            "views_count": 145,
            "created_at": "2024-04-16 10:30:00"
        }
    ],
    "pagination": {
        "current_page": 1,
        "per_page": 10,
        "total": 25,
        "total_pages": 3
    }
}
```

### Error Response (422)
```json
{
    "messages": {
        "title": "The title field is required.",
        "content": "The content field must be at least 50 characters."
    }
}
```

### Unauthorized Response (401)
```json
{
    "error": "Not authenticated"
}
```

---

## 📊 Testing Checklist

- [ ] Register new user
- [ ] Login with valid credentials
- [ ] Login with invalid credentials
- [ ] Get all posts
- [ ] Get featured posts
- [ ] Search posts
- [ ] Get single post by ID
- [ ] Get post by slug
- [ ] Create new post (logged in)
- [ ] Update own post
- [ ] Delete own post
- [ ] Try to update another user's post (should fail)
- [ ] Get comments for post
- [ ] Submit new comment
- [ ] Approve comment (admin only)
- [ ] Get all categories
- [ ] Get posts in category
- [ ] Create category (admin only)
- [ ] Update category (admin only)
- [ ] Delete category (admin only)
- [ ] Get user profile
- [ ] Update user profile

---

## 🐛 Common Issues and Solutions

### Issue: 401 Unauthorized on authenticated endpoint
**Solution:** Ensure you're sending cookies with `-b cookies.txt` in curl or `credentials: 'include'` in fetch

### Issue: 422 Validation Error
**Solution:** Check the error messages and ensure all required fields are provided with correct format

### Issue: 403 Forbidden
**Solution:** You don't have permission. Check user role or ownership of resource

### Issue: CORS errors
**Solution:** Use same-origin requests or ensure CORS is properly configured in CI4

---

## 💡 Pro Tips

1. **Save Sessions**: Use `-c cookies.txt` when logging in, then use `-b cookies.txt` for authenticated requests
2. **Format JSON**: Use `jq` to pretty-print responses: `curl ... | jq`
3. **Debug Mode**: Set `CI_ENVIRONMENT = development` in `.env` for detailed errors
4. **Test Order**: Test unauthenticated endpoints first, then authenticated, then admin-only

---

**Happy testing! 🎉**
