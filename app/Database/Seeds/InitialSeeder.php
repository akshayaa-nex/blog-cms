<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSeeder extends Seeder
{
    public function run()
    {
        // Seed users
        $userData = [
            [
                'username'      => 'admin',
                'email'         => 'admin@example.com',
                'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
                'first_name'    => 'Admin',
                'last_name'     => 'User',
                'is_active'     => 1,
                'role'          => 'admin',
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'username'      => 'johndoe',
                'email'         => 'john@example.com',
                'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
                'first_name'    => 'John',
                'last_name'     => 'Doe',
                'bio'           => 'A passionate blogger',
                'is_active'     => 1,
                'role'          => 'user',
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'username'      => 'janedoe',
                'email'         => 'jane@example.com',
                'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
                'first_name'    => 'Jane',
                'last_name'     => 'Doe',
                'is_active'     => 1,
                'role'          => 'user',
                'created_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($userData);

        // Seed categories
        $categoryData = [
            ['name' => 'Technology', 'slug' => 'technology', 'description' => 'Tech-related posts and tutorials', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle', 'description' => 'Lifestyle tips and advice', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Business', 'slug' => 'business', 'description' => 'Business and entrepreneurship', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Travel', 'slug' => 'travel', 'description' => 'Travel guides and stories', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ];

        $this->db->table('categories')->insertBatch($categoryData);

        $postData = [
            [
                'user_id'        => 1,
                'title'          => 'Getting Started with CodeIgniter 4',
                'slug'           => 'getting-started-with-codeigniter-4',
                'excerpt'        => 'Learn the basics of CodeIgniter 4 and build your first application',
                'content'        => 'CodeIgniter is a powerful PHP framework for building web applications. This tutorial will guide you through the basics and help you create your first project. CodeIgniter provides a rich set of libraries and helpers to speed up development.',
                'featured_image' => null,
                'status'         => 'published',
                'views_count'    => 145,
                'is_featured'    => 1,
                'published_at'   => date('Y-m-d H:i:s', strtotime('-5 days')),
                'created_at'     => date('Y-m-d H:i:s', strtotime('-5 days')),
                'updated_at'     => date('Y-m-d H:i:s', strtotime('-5 days')),
            ],
            [
                'user_id'        => 2,
                'title'          => 'Top 10 Web Development Tips',
                'slug'           => 'top-10-web-development-tips',
                'excerpt'        => 'Essential tips to improve your web development skills and productivity',
                'content'        => 'Web development is an ever-evolving field. Here are 10 tips to help you improve your skills and productivity. 1. Stay updated with the latest technologies. 2. Write clean and maintainable code. 3. Test your applications thoroughly. 4. Use version control. 5. Optimize for performance. 6. Focus on user experience. 7. Document your code. 8. Learn security best practices. 9. Use development tools effectively. 10. Never stop learning.',
                'featured_image' => null,
                'status'         => 'published',
                'views_count'    => 298,
                'is_featured'    => 1,
                'published_at'   => date('Y-m-d H:i:s', strtotime('-3 days')),
                'created_at'     => date('Y-m-d H:i:s', strtotime('-3 days')),
                'updated_at'     => date('Y-m-d H:i:s', strtotime('-3 days')),
            ],
            [
                'user_id'        => 3,
                'title'          => 'The Future of Web Applications',
                'slug'           => 'the-future-of-web-applications',
                'excerpt'        => 'Exploring emerging technologies and trends in web development',
                'content'        => 'The web application landscape is constantly evolving. New technologies and frameworks emerge regularly, changing how we build and deploy applications. Some key trends include PWAs, Serverless architecture, AI integration, and GraphQL adoption. Stay tuned to learn more about these exciting developments.',
                'featured_image' => null,
                'status'         => 'published',
                'views_count'    => 87,
                'is_featured'    => 0,
                'published_at'   => date('Y-m-d H:i:s', strtotime('-1 day')),
                'created_at'     => date('Y-m-d H:i:s', strtotime('-1 day')),
                'updated_at'     => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
            [
                'user_id'        => 2,
                'title'          => 'Understanding RESTful APIs',
                'slug'           => 'understanding-restful-apis',
                'excerpt'        => 'A comprehensive guide to building and consuming REST APIs',
                'content'        => 'REST (Representational State Transfer) is an architectural style for building web services. Understanding the principles of REST is crucial for modern web development. This guide covers HTTP methods, status codes, authentication, and best practices for API design.',
                'featured_image' => null,
                'status'         => 'published',
                'views_count'    => 156,
                'is_featured'    => 0,
                'published_at'   => date('Y-m-d H:i:s'),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'        => 1,
                'title'          => 'Draft: Advanced PHP Concepts',
                'slug'           => 'draft-advanced-php-concepts',
                'excerpt'        => 'Exploring advanced features of PHP for experienced developers',
                'content'        => 'This is still a draft... More content coming soon.',
                'featured_image' => null,
                'status'         => 'draft',
                'views_count'    => 0,
                'is_featured'    => 0,
                'published_at'   => null,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('posts')->insertBatch($postData);

        // Seed post-category relationships
        $postCategoryData = [
            ['post_id' => 1, 'category_id' => 1],
            ['post_id' => 2, 'category_id' => 1],
            ['post_id' => 3, 'category_id' => 1],
            ['post_id' => 4, 'category_id' => 1],
            ['post_id' => 5, 'category_id' => 1],
        ];

        $this->db->table('post_categories')->insertBatch($postCategoryData);

        // Seed comments
        $commentData = [
            [
                'post_id'       => 1,
                'user_id'       => null,
                'name'          => 'Alice Smith',
                'email'         => 'alice@example.com',
                'content'       => 'Great tutorial! Very helpful for beginners.',
                'is_approved'   => 1,
                'created_at'    => date('Y-m-d H:i:s', strtotime('-4 days')),
                'updated_at'    => date('Y-m-d H:i:s', strtotime('-4 days')),
            ],
            [
                'post_id'       => 1,
                'user_id'       => null,
                'name'          => 'Bob Johnson',
                'email'         => 'bob@example.com',
                'content'       => 'Could you elaborate on the routing system?',
                'is_approved'   => 1,
                'created_at'    => date('Y-m-d H:i:s', strtotime('-3 days')),
                'updated_at'    => date('Y-m-d H:i:s', strtotime('-3 days')),
            ],
            [
                'post_id'       => 2,
                'user_id'       => null,
                'name'          => 'Charlie Brown',
                'email'         => 'charlie@example.com',
                'content'       => 'Excellent tips! I especially liked the performance optimization advice.',
                'is_approved'   => 1,
                'created_at'    => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at'    => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],
            [
                'post_id'       => 4,
                'user_id'       => 2,
                'name'          => 'John Doe',
                'email'         => 'john@example.com',
                'content'       => 'Looking forward to more API content!',
                'is_approved'   => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('comments')->insertBatch($commentData);

        echo "Database seeding completed successfully!";
    }
}
