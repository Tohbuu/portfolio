# ⚔️ Warriorfolio - Setup & Running Guide

Welcome to **Warriorfolio**! This guide will help you set up, run, and maintain your Laravel-powered portfolio and admin panel application.

---

### 📖 Complete Setup and Running Guide

---

### 1️⃣ System Requirements

Ensure your system meets the following requirements:

- 🐘 PHP **8.2** or higher
- 🧪 PHP Extensions: `BCMath`, `Ctype`, `Fileinfo`, `JSON`, `Mbstring`, `OpenSSL`, `PDO`, `Tokenizer`, `XML`
- 🤵🏻 Composer **2.0** or higher
- 🌱 Node.js & NPM **10.2** or higher
- 💾 Database (MySQL, PostgreSQL, or SQLite)

---

### 2️⃣ Initial Setup

#### 🔁 Clone the Repository

```bash
git clone https://github.com/mviniciusca/warriorfolio.git
cd warriorfolio
```

#### 📦 Install PHP Dependencies

```bash
composer install
```

#### 📦 Install JavaScript Dependencies

```bash
npm install
```

---

### 3️⃣ Environment Configuration

#### 📄 Create Environment File

```bash
cp .env.example .env
```

#### 🔑 Generate Application Key

```bash
php artisan key:generate
```

#### ⚙️ Configure Database

Edit `.env` with your DB connection details.

**For SQLite:**

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/your/project/database/database.sqlite
```

**For MySQL:**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=warriorfolio
DB_USERNAME=root
DB_PASSWORD=your_password
```

#### 📁 Create SQLite File (if using SQLite)

```bash
touch database/database.sqlite
```

---

### 4️⃣ Database Setup

#### 🧱 Run Migrations

```bash
php artisan migrate:fresh
```

#### 🌱 Seed the Database

```bash
php artisan db:seed
```

#### 🔗 Create Storage Link

```bash
php artisan storage:link
```

---

### 5️⃣ Running the Application

#### 🖥️ Start Development Server

```bash
php artisan serve
```

➡️ Visit: [http://localhost:8000](http://localhost:8000)

#### 🛠️ Compile Assets

Open a separate terminal:

```bash
npm run dev
```

---

### 6️⃣ Accessing the Application

- **Frontend:** [http://localhost:8000](http://localhost:8000)
- **Admin Panel:** [http://localhost:8000/admin](http://localhost:8000/admin)

🪪 **Default Admin Credentials:**

```text
Email: admin@example.com
Password: password
```

---

### 7️⃣ Key Features and Sections

#### 🏠 Landing Page

- Hero section
- Feature list
- Featured blog posts
- Courses
- Projects showcase
- Clients
- Newsletter signup
- Contact form

#### ✍️ Blog

- [http://localhost:8000/blog](http://localhost:8000/blog)
- Manage posts in admin panel

#### 🧰 Projects

- Showcase portfolio projects
- Manage in admin panel

#### 🛡️ Admin Panel Features

- Content & user management
- Settings configuration
- Media library
- Analytics & reporting

---

### 8️⃣ Customization

#### 🎨 Theme & Appearance

- Modify settings in **Admin Panel**
- Edit `tailwind.config.js` for Tailwind styles
- Customize Blade components in `resources/views/components`

#### 🧩 Adding New Sections

- Create new blocks: `app/Filament/Fabricator/PageBlocks`
- Register them in `FilamentServiceProvider`

#### ⚙️ Configuration Files

- App settings: `config/warriorfolio.php`
- DB config: `config/database.php`
- Filament admin panel: `config/filament.php`

---

### 9️⃣ Deployment

#### 🚀 Production Optimization

```bash
composer install --optimize-autoloader --no-dev
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### 📡 Server Requirements

- Apache/Nginx
- PHP 8.2+
- Database server
- SSL certificate (recommended)

---

### 🔟 Maintenance

#### 🔄 Regular Updates

```bash
composer update
npm update
php artisan migrate
```

#### 🧹 Clearing Cache

```bash
php artisan optimize:clear
```

#### 💾 Backup

- Backup your **database**
- Backup the `storage/` directory regularly

---

### ⚠️ Troubleshooting

#### ❗ Common Issues

1. **404 Not Found**
   - Ensure routes are registered
   - Check if database is seeded
   - Verify `.htaccess` (Apache)

2. **Database Connection Issues**
   - Confirm `.env` database credentials
   - Ensure DB server is running and accessible

3. **Permission Issues**
   - Make directories writable:
     ```bash
     chmod -R 775 storage bootstrap/cache
     ```

4. **Asset Loading Issues**
   - Run `npm run dev` or `npm run build`
   - Verify `php artisan storage:link` is done
   - Clear browser cache

#### 📜 Logs

```bash
tail -f storage/logs/laravel.log
```

---

Happy Coding! 🎉
