## Features

- User authentication (login/logout)
- Manage Leads (Create, Read, Update, Delete)
- Manage Services (Products)
- Manage Projects with Approval/Reject
- Manage Subscriptions
- Responsive UI using Tailwind CSS
- Role-based access (via middleware)

---

## Requirements

- PHP >= 8.2
- Composer
- Laravel 11
- PostgreSQL
- Node.js & npm (for frontend assets, optional)

---

## Installation & Setup

1. **Clone the repository**

```bash
git clone https://github.com/Zuka-Nakirigumi/jason_crm.git
cd jason_crm

2. **Install PHP Dependencies**

composer install

3. **Configure the .env file**
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=crm_db
DB_USERNAME=postgres
DB_PASSWORD=your_password

4. **Generate Application Key**
php artisan key:generate

5. **Run Migrations and Seed**
php artisan migrate
php artisan db:seed

6. **Install frontend dependencies**
npm install
npm run dev

7. **Run the website**
php artisan serve
