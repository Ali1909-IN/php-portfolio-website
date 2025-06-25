-- Portfolio Database Schema for MySQL
-- Run this in your Hostinger MySQL database

CREATE TABLE IF NOT EXISTS portfolio_projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    header VARCHAR(255) NOT NULL,
    brief_info TEXT,
    tools_skills TEXT,
    banner_image_url VARCHAR(500),
    work_images JSON,
    challenge TEXT,
    start_date DATE,
    end_date DATE,
    learning TEXT,
    website_link VARCHAR(500),
    category ENUM('Development', 'Administration') DEFAULT 'Development',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS site_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    site_title VARCHAR(255) DEFAULT 'Your Portfolio',
    tagline VARCHAR(500) DEFAULT 'Professional Developer',
    about_text TEXT,
    contact_email VARCHAR(255),
    profile_image_url VARCHAR(500),
    logo_url VARCHAR(500),
    social_links JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default settings
INSERT INTO site_settings (site_title, tagline, about_text, contact_email, social_links) 
VALUES (
    'Your Portfolio',
    'Professional Developer & Designer',
    'Welcome to my portfolio website. I am a passionate developer with expertise in modern web technologies.',
    'contact@example.com',
    '{"linkedin": "", "github": "", "twitter": ""}'
) ON DUPLICATE KEY UPDATE id=id;

CREATE TABLE IF NOT EXISTS skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(100) NOT NULL,
    skill_name VARCHAR(100) NOT NULL,
    proficiency_level ENUM('Beginner', 'Intermediate', 'Advanced', 'Expert') DEFAULT 'Intermediate',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(200) NOT NULL,
    designation VARCHAR(150) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE,
    job_responsibility TEXT,
    location VARCHAR(100),
    employment_type ENUM('Full-time', 'Part-time', 'Contract', 'Freelance') DEFAULT 'Full-time',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample data
INSERT INTO skills (category, skill_name, proficiency_level) VALUES
('Programming', 'PHP', 'Advanced'),
('Programming', 'JavaScript', 'Advanced'),
('Database', 'MySQL', 'Advanced'),
('Frontend', 'HTML5', 'Expert'),
('Frontend', 'CSS3', 'Advanced'),
('Tools', 'Git', 'Advanced');

INSERT INTO services (company_name, designation, start_date, end_date, job_responsibility, location, employment_type) VALUES
('Tech Solutions Inc', 'Senior Developer', '2022-01-01', NULL, 'Led development of web applications, managed database architecture, mentored junior developers, implemented security best practices.', 'New York', 'Full-time'),
('Digital Agency', 'Web Developer', '2020-06-01', '2021-12-31', 'Developed responsive websites, collaborated with design team, optimized performance, maintained client relationships.', 'Remote', 'Full-time');

-- Sample projects
INSERT INTO portfolio_projects (header, brief_info, tools_skills, banner_image_url, category, challenge, learning) VALUES
('Modern Web Application', 'A responsive web application built with modern technologies', 'PHP, MySQL, JavaScript, HTML5, CSS3', 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=800', 'Development', 'Creating a scalable and maintainable codebase', 'Learned advanced PHP patterns and database optimization'),
('System Administration Project', 'Enterprise server management and automation', 'Linux, Docker, Nginx, MySQL', 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=800', 'Administration', 'Ensuring high availability and security', 'Mastered containerization and server orchestration');