# 🚀 Modern PHP Portfolio Website

A complete, responsive portfolio website built with **PHP & MySQL**, designed for easy deployment on shared hosting platforms like Hostinger. Perfect for developers, designers, and professionals who want a dynamic portfolio with an admin panel.

![Portfolio Preview](https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=400&fit=crop)

## ✨ Features

### 🎨 Frontend
- **Modern Responsive Design** with Tailwind CSS
- **Dark/Light Mode** support
- **Smooth Animations** and hover effects
- **Mobile-First** approach
- **SEO Optimized** structure

### ⚙️ Backend
- **PHP 7.4+** with MySQL database
- **Admin Panel** for content management
- **Contact Form** with spam protection
- **Image Upload** functionality
- **Security Features** (SQL injection protection, XSS prevention)

### 📊 Content Management
- Dynamic project portfolio
- Skills & experience management
- Site settings configuration
- Social media integration
- Contact information management

## 🖼️ Screenshots

### Homepage
![Homepage](https://images.unsplash.com/photo-1551650975-87deedd944c3?w=800&h=500&fit=crop)

### Admin Panel
![Admin Panel](https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=500&fit=crop)

### Mobile Responsive
![Mobile View](https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=400&h=600&fit=crop)

## 🚀 Quick Start

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- cPanel or similar hosting control panel

### 📥 Installation

#### Step 1: Download & Upload
```bash
# Clone the repository
git clone https://github.com/yourusername/php-portfolio-website.git

# Or download ZIP and extract
```

Upload all files to your hosting directory (usually `public_html` or `www`)

#### Step 2: Database Setup
1. **Create MySQL Database** in your hosting control panel
2. **Import Database Schema**:
   ```sql
   # Import the database.sql file through phpMyAdmin or MySQL command line
   mysql -u username -p database_name < database.sql
   ```

#### Step 3: Configuration
1. **Update Database Credentials** in `config/database.php`:
   ```php
   $host = 'localhost';
   $dbname = 'your_database_name';
   $username = 'your_username';
   $password = 'your_password';
   ```

2. **Change Admin Credentials** in `admin/index.php`:
   ```php
   // Line 12: Change these credentials
   if ($username === 'admin' && $password === 'YOUR_SECURE_PASSWORD') {
   ```

3. **Set Directory Permissions**:
   ```bash
   chmod 755 uploads/
   chmod 644 *.php
   ```

#### Step 4: Access Your Site
- **Frontend**: `https://yourdomain.com`
- **Admin Panel**: `https://yourdomain.com/admin`

## 🛠️ File Structure

```
php-portfolio/
├── 📁 admin/
│   └── index.php              # Admin panel
├── 📁 api/
│   └── contact.php            # Contact form handler
├── 📁 assets/
│   ├── 📁 css/               # Custom styles
│   └── 📁 js/
│       └── main.js           # JavaScript functionality
├── 📁 config/
│   └── database.php          # Database configuration
├── 📁 includes/
│   └── functions.php         # PHP functions
├── 📁 uploads/               # Image uploads (755 permissions)
├── .htaccess                 # Apache configuration
├── database.sql              # Database schema
├── index.php                 # Main homepage
└── README.md                 # This file
```

## 🔧 Configuration Guide

### Admin Panel Features
Access at `/admin` with your credentials:

- ✅ **Site Settings**: Title, tagline, about text, contact info
- ✅ **Portfolio Projects**: Add/edit/delete projects with images
- ✅ **Skills Management**: Organize skills by category
- ✅ **Experience**: Add work history and achievements
- ✅ **Social Links**: LinkedIn, GitHub, Twitter integration

### Database Tables
| Table | Purpose |
|-------|---------|
| `site_settings` | Website configuration and content |
| `portfolio_projects` | Project portfolio data |
| `skills` | Skills organized by category |
| `services` | Work experience and history |
| `admin_users` | Admin authentication (future use) |

## 🔒 Security Features

- **SQL Injection Protection** using PDO prepared statements
- **XSS Prevention** with `htmlspecialchars()`
- **CSRF Protection** for admin forms
- **File Upload Validation** for images
- **Session-based Authentication** for admin panel
- **Rate Limiting** for contact form

## 🎨 Customization

### Styling
- Built with **Tailwind CSS** via CDN
- Modify `tailwind.config` in `index.php`
- Add custom CSS in `assets/css/`

### Content
- Update default content in `database.sql`
- Modify sections in `index.php`
- Customize email templates in `includes/functions.php`

### Colors & Branding
```javascript
// In index.php, modify the Tailwind config:
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: '#your-color',
                secondary: '#your-color'
            }
        }
    }
}
```

## 📱 Responsive Design

The website is fully responsive and tested on:
- 📱 Mobile devices (320px+)
- 📱 Tablets (768px+)
- 💻 Desktops (1024px+)
- 🖥️ Large screens (1440px+)

## 🌐 Hosting Compatibility

Tested and optimized for:
- ✅ **Hostinger** (recommended)
- ✅ **cPanel** hosting
- ✅ **Shared hosting** environments
- ✅ **VPS** and dedicated servers

## 📧 Contact Form Setup

The contact form requires email configuration:

1. **Update SMTP settings** in `includes/functions.php`
2. **Configure mail server** in your hosting panel
3. **Test email delivery** through the contact form

## 🚀 Performance Optimization

- **Optimized Images**: Use WebP format when possible
- **CDN Integration**: Tailwind CSS and Font Awesome via CDN
- **Minified Assets**: Compress CSS/JS for production
- **Database Indexing**: Optimized queries for fast loading

## 🔄 Updates & Maintenance

### Regular Tasks
- Update PHP version as needed
- Backup database regularly
- Monitor security updates
- Check contact form functionality

### Version Control
```bash
# Keep your repository updated
git add .
git commit -m "Update portfolio content"
git push origin main
```

## 🤝 Contributing

Contributions are welcome! Please:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

## 🆘 Support

If you encounter any issues:

1. Check the [Issues](https://github.com/yourusername/php-portfolio-website/issues) page
2. Create a new issue with detailed information
3. Include your PHP version and hosting environment

## 🌟 Show Your Support

If this project helped you, please:
- ⭐ Star the repository
- 🍴 Fork it for your own use
- 📢 Share it with others
- 💝 Consider sponsoring the project

## 📞 Contact

**Your Name** - [@yourhandle](https://twitter.com/yourhandle) - your.email@example.com

Project Link: [https://github.com/yourusername/php-portfolio-website](https://github.com/yourusername/php-portfolio-website)

---

<div align="center">
  <strong>Built with ❤️ using PHP & MySQL</strong>
  <br>
  <sub>Perfect for developers who want a professional portfolio without the complexity</sub>
</div>