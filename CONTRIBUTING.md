# Contributing to PHP Portfolio Website

Thank you for considering contributing to this project! 🎉

## How to Contribute

### 🐛 Reporting Bugs
1. Check if the bug has already been reported in [Issues](https://github.com/yourusername/php-portfolio-website/issues)
2. Create a new issue with:
   - Clear description of the bug
   - Steps to reproduce
   - Expected vs actual behavior
   - Your environment (PHP version, hosting provider, browser)
   - Screenshots if applicable

### 💡 Suggesting Features
1. Check existing [Issues](https://github.com/yourusername/php-portfolio-website/issues) for similar suggestions
2. Create a new issue with:
   - Clear description of the feature
   - Use case and benefits
   - Possible implementation approach

### 🔧 Code Contributions

#### Getting Started
1. Fork the repository
2. Clone your fork:
   ```bash
   git clone https://github.com/yourusername/php-portfolio-website.git
   cd php-portfolio-website
   ```
3. Create a new branch:
   ```bash
   git checkout -b feature/your-feature-name
   ```

#### Development Setup
1. Set up local environment:
   - PHP 7.4+ with MySQL
   - Web server (Apache/Nginx)
   - Copy `config/database.example.php` to `config/database.php`
   - Import `database.sql` to your local MySQL

2. Make your changes
3. Test thoroughly:
   - Test on different screen sizes
   - Verify admin panel functionality
   - Check database operations
   - Test contact form

#### Code Standards
- Follow PSR-12 coding standards for PHP
- Use meaningful variable and function names
- Add comments for complex logic
- Ensure security best practices (prepared statements, input validation)
- Keep functions small and focused

#### Commit Guidelines
- Use clear, descriptive commit messages
- Start with a verb (Add, Fix, Update, Remove)
- Keep first line under 50 characters
- Add detailed description if needed

Example:
```
Add dark mode toggle functionality

- Implement theme switching in main.js
- Add CSS classes for dark mode
- Store user preference in localStorage
- Update admin panel styling
```

#### Pull Request Process
1. Update documentation if needed
2. Add/update tests if applicable
3. Ensure your code follows the project's coding standards
4. Create a pull request with:
   - Clear title and description
   - Reference any related issues
   - Screenshots for UI changes
   - Testing instructions

## 📋 Development Guidelines

### Security
- Always use prepared statements for database queries
- Sanitize user inputs with `htmlspecialchars()`
- Validate file uploads properly
- Use CSRF tokens for forms
- Never commit sensitive data (passwords, API keys)

### Performance
- Optimize database queries
- Compress images before upload
- Minimize HTTP requests
- Use appropriate caching strategies

### Compatibility
- Test on PHP 7.4, 8.0, 8.1+
- Ensure compatibility with shared hosting
- Test on different browsers
- Verify mobile responsiveness

## 🎯 Areas for Contribution

### High Priority
- [ ] Email template system
- [ ] Image optimization/compression
- [ ] Multi-language support
- [ ] SEO improvements
- [ ] Performance optimizations

### Medium Priority
- [ ] Theme customization options
- [ ] Social media integration
- [ ] Analytics integration
- [ ] Backup/restore functionality
- [ ] Advanced admin features

### Low Priority
- [ ] Plugin system
- [ ] API endpoints
- [ ] Advanced animations
- [ ] PWA features

## 🧪 Testing

### Manual Testing Checklist
- [ ] Homepage loads correctly
- [ ] Admin login works
- [ ] All CRUD operations in admin panel
- [ ] Contact form sends emails
- [ ] Responsive design on mobile/tablet
- [ ] Cross-browser compatibility
- [ ] Image uploads work
- [ ] Database operations are secure

### Test Environment
- Test on a clean installation
- Use sample data from `database.sql`
- Test with different PHP versions if possible

## 📝 Documentation

When contributing, please update:
- README.md if adding new features
- Code comments for complex functions
- Database schema documentation if changing tables
- Installation instructions if needed

## 🤝 Community Guidelines

- Be respectful and inclusive
- Help others learn and grow
- Provide constructive feedback
- Follow the project's code of conduct
- Ask questions if you're unsure

## 🆘 Getting Help

- Check existing [Issues](https://github.com/yourusername/php-portfolio-website/issues)
- Create a new issue with the "question" label
- Join discussions in existing issues
- Be patient and respectful when asking for help

## 📞 Contact

If you have questions about contributing, feel free to:
- Open an issue
- Contact the maintainers
- Join our community discussions

Thank you for contributing! 🙏