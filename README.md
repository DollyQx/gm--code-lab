# GM Code Lab — Enterprise Business Platform

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-%5E8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Database](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![License](https://img.shields.io/badge/License-Proprietary-blue?style=for-the-badge)](LICENSE)

## Overview

**GM Code Lab** is an all-in-one enterprise business platform and digital agency management system built for high-performance software solution delivery. The application unifies public agency showcase, client onboarding, requirement gathering, CRM lead pipelines, quotation engine, project management, online invoicing, support ticketing, dynamic CMS, and executive analytics.

---

## 🚀 Business Scope & Solutions Delivered

GM Code Lab powers end-to-end digital transformation across 14 key solution domains:

* **Web Development**: Custom web applications, enterprise portals, progressive web apps.
* **App Development**: Native iOS/Android and cross-platform mobile solutions.
* **Custom Software**: Tailored enterprise management systems and automated business workflows.
* **LMS & Teaching Platforms**: E-learning environments, course delivery, video streaming, student progress tracking.
* **Online Test & Examination Systems**: Proctored testing engines, timed exams, automated evaluation, result analytics.
* **Notes & Digital Library Platforms**: Digital content distribution, secure PDF streaming, subscription access.
* **Institute & Education Management**: Administration portals, fee management, attendance, academic records.
* **Hostel Management**: Room allocation, student onboarding, fee logs, complaint tracking.
* **Mess & Canteen Management**: Meal planning, coupon/card tracking, billing systems.
* **Hospital & Healthcare Management**: Patient records, appointments, digital prescriptions, billing.
* **Shop & Retail Systems**: Inventory control, POS terminals, order tracking, sales analytics.
* **E-Commerce Solutions**: Digital storefronts, payment gateway integration, order fulfillment.
* **Business Management Software**: ERP/CRM automation, inventory, payroll, workflow automation.
* **Cybersecurity Services**: Security audits, vulnerability assessments, penetration testing, compliance.

---

## 🏗️ Architecture & Technology Stack

* **Backend Framework**: Laravel 12 (PHP ^8.2)
* **Database**: MySQL 8.0 / MariaDB
* **UI & Frontend**: Vite, Blade, Modern Responsive Styling
* **Hosting Compatibility**: Hostinger Shared Hosting (Standard Apache/Nginx `public` entrypoint)
* **Security & Auth**: Role-Based Access Control (RBAC), CSRF protection, Eloquent SQL parameterization, Password hashing

### Documentation Links
* 📘 [Functional Requirements Blueprint](docs/requirements.md)
* 🏛️ [System Architecture & Schema Design](docs/architecture.md)

---

## 📂 Project Structure

```
gm--code-lab/
├── app/
│   ├── Enums/                 # Application enums & state definitions
│   ├── Http/                  # Controllers, Middleware, Form Requests
│   ├── Models/                # Eloquent ORM models & relationships
│   ├── Policies/              # Access Control Policies (RBAC)
│   ├── Repositories/          # Data access abstraction layer
│   └── Services/              # Domain business logic processing layer
├── bootstrap/                 # Application bootstrap & configuration
├── config/                    # Framework configuration files
├── database/                  # Migrations, Seeders, Factories
├── docs/                      # System Architecture & Requirements documentation
│   ├── architecture.md
│   └── requirements.md
├── public/                    # Web root entrypoint
├── resources/                 # Blade templates, JS assets, CSS styles
├── routes/                    # Application web and console routes
├── storage/                   # Logs, cached templates, user uploads
├── tests/                     # Automated test suites
├── .env.example               # Environment variables configuration template
├── composer.json              # PHP dependencies
├── package.json               # Frontend dependencies & build scripts
└── README.md                  # Project documentation
```

---

## 🛠️ Quickstart Development Guide

### Prerequisites
* PHP >= 8.2 with PDO, OpenSSL, Mbstring, Fileinfo extensions
* Composer >= 2.x
* Node.js & npm (for asset compilation)
* MySQL >= 8.0

### Setup Steps
1. **Clone the repository**:
   ```bash
   git clone https://github.com/DollyQx/gm--code-lab.git
   cd gm--code-lab
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Configure Environment Variables**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure Database**:
   Update `.env` with your local MySQL credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=gm_code_lab
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run Database Migrations**:
   ```bash
   php artisan migrate
   ```

6. **Start Local Development Server**:
   ```bash
   php artisan serve
   ```

---

## 🌿 Git Branching & Version Control Guidelines

* `main`: Production-ready branch. Must remain stable at all times.
* `develop`: Integration branch for ongoing development.
* **Commits**: Feature-based, meaningful commit messages adhering to standard conventions (`feat:`, `fix:`, `docs:`, `chore:`).
