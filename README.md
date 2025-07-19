# CMS Open Source CodeIgniter 4 - Based on Lokomedia

A modern Content Management System built with CodeIgniter 4, inspired by Lokomedia CMS. This project has been upgraded and enhanced for better compatibility with the latest CodeIgniter 4 framework.

## 🚀 About This Project

This CMS combines the simplicity and features of Lokomedia with the power of CodeIgniter 4. It's designed to be a complete web content management solution with modern architecture and enhanced security features.

### Key Features
- **Modern Framework**: Built on CodeIgniter 4.6.1
- **Responsive Design**: Mobile-friendly interface
- **Content Management**: Pages, news, categories, and media management
- **User Management**: Role-based access control
- **SEO Friendly**: Clean URLs and meta tag management
- **Multi-language Support**: Internationalization ready

## 🔧 Recent Improvements & Fixes

This repository includes several critical upgrades and fixes for CodeIgniter 4.6.1 compatibility:

### Framework Upgrades
- ✅ **Bootstrap Migration**: Updated from deprecated `bootstrap.php` to new `Boot` class
- ✅ **Configuration Updates**: Added missing config properties for CI4 v4.6.1
- ✅ **Session Management**: Created new `Session.php` configuration file
- ✅ **Routing Enhancement**: Added `Routing.php` config with URL parameter handling

### Bug Fixes
- ✅ **Entity Constructor**: Fixed Entity initialization issues
- ✅ **URL Routing**: Resolved `/page/` and `/kategori/` route conflicts
- ✅ **Port Configuration**: Using port 8080 (default CodeIgniter port)
- ✅ **Environment Setup**: Proper ENVIRONMENT constant handling
- ✅ **Database Connectivity**: Enhanced database configuration

### Security Enhancements
- ✅ **CSRF Protection**: Updated security configurations
- ✅ **Exception Handling**: Improved error logging and reporting
- ✅ **Service Configuration**: Enhanced dependency injection setup

## 📋 Requirements

- **PHP**: 8.0 or higher (tested with PHP 8.4.10)
- **Database**: MySQL 5.7+ or MariaDB
- **Web Server**: Apache/Nginx or PHP built-in server
- **Composer**: For dependency management

## 🚀 Quick Start

### 1. Clone Repository
```bash
git clone https://github.com/ilham-fedev/cmsopensourceci4.git
cd cmsopensourceci4
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Database Setup
1. Create a MySQL database named `cms_opensource`
2. Import the SQL file (included in project)
3. Configure database credentials in `.env` file:
```env
database.default.hostname = localhost
database.default.database = cms_opensource
database.default.username = your_username
database.default.password = your_password
```

### 4. Environment Configuration
Copy and configure the environment file:
```bash
cp env .env
```

Update the base URL in `.env`:
```env
app.baseURL = 'http://localhost:8080'
```

### 5. Run the Application
```bash
php spark serve
```

Visit: `http://localhost:8080`

## 🔐 Admin Access

- **Admin URL**: `http://localhost:8080/cms-login`
- **Username**: `@cmsopensurce`
- **Password**: `cmsopensurce`

## 📁 Project Structure

```
app/
├── Config/          # Configuration files
│   ├── App.php      # Application settings
│   ├── Database.php # Database configuration
│   ├── Routes.php   # URL routing
│   ├── Session.php  # Session management
│   └── Routing.php  # Route handling settings
├── Controllers/     # Application controllers
├── Models/          # Database models
├── Views/           # Template files
└── Entities/        # Data entities

public/              # Web root directory
themes/              # Frontend themes
```

## 🛠️ Development Notes

### Custom Configurations Added
- `app/Config/Session.php` - Session handling configuration
- `app/Config/Routing.php` - Enhanced routing with multi-segment parameter support

### Modified Files
- Updated bootstrap mechanism in `public/index.php` and `spark`
- Enhanced configuration classes for CI4 v4.6.1 compatibility
- Fixed Entity constructors and data casting

### Testing URLs
- Home: `http://localhost:8080/`
- Admin: `http://localhost:8080/cms-login`

### Admin Login Credentials
- **Username**: `@cmsopensurce`
- **Password**: `cmsopensurce`

## 🤝 Contributing

Feel free to submit issues, feature requests, or pull requests to improve this CMS.

## 📄 License

This project is open source. You can download, modify, and use it for your own web projects.

## 🙏 Credits

- **Original Concept**: Based on Lokomedia CMS
- **Framework**: CodeIgniter 4
- **Upgrades & Fixes**: Enhanced for modern compatibility

---

**Note**: This version has been thoroughly tested and upgraded to work seamlessly with CodeIgniter 4.6.1 and modern PHP versions.
