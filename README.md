# Sistem Informasi Klinik (SIK)

## Introduction

The Sistem Informasi Klinik (SIK) is a web-based application designed for clinic management. It provides various functionalities to manage clinic operations such as user management, patient registration, medical treatments, and billing reports. The application is built using the Yii 1 Framework and PostgreSQL database.

## Features

- **User Authentication with SRBAC**: Secure user authentication based on roles and permissions using the Simple Role Based Access Control (SRBAC) system.
- **Master Data Management**:
  - **Role**: Create and manage roles and their access permissions.
  - **Wilayah**: Create and manage clinic regions.
  - **User**: Manage users with roles and permissions.
  - **Pegawai**: Manage clinic staff (employees, doctors, nurses, etc.).
  - **Tindakan**: Manage available medical actions/treatments.
  - **Obat**: Manage medications available in the clinic.
- **Transaction Management**:
  - **Data Pasien**: Register new patients with essential details.
  - **Pelayanan Pasien**: Administer treatments and medications to patients. Track payments for patient services and generate printable records.
  - **Laporan**: Generate and view graphical reports of patient registration counts, broken down by daily, weekly, and monthly data.

## Installing & Running the Application

### 1. Clone the Repository

Clone the repository to your local machine:

```bash
git clone https://github.com/mukhlish32/clinic-system
```

Move the cloned folder to your `htdocs` (or equivalent) directory:

```
/xampp/htdocs/clinic-system
```

### 2. Install Yii 1 Framework

To use the Yii 1 Framework, download it from the official Yii releases page:

[Download Yii 1 Framework](https://github.com/yiisoft/yii/releases/download/1.1.30/yii-1.1.30.5f760e.zip)

Place the Yii framework in your `htdocs` directory if you're using XAMPP or a similar setup, and rename the folder to `yii1` (or any other name as you prefer). If you change the folder name, make sure to update the `index.php` file as follows:

```php
// change the following paths if necessary
$yii = dirname(__FILE__) . '/../yii1/framework/yii.php';
```

### 3. Database Setup

To set up the database, follow these steps:

- Copy the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```

- Update the `.env` file with your database connection details.


### 4. Install Dependencies

Navigate to the `protected` folder and install the necessary PHP dependencies using Composer:

```bash
cd protected
composer install
```

### 5. Run Migrations & Seed Database

In the `protected` folder, run the following commands to apply migrations and seed the database:

```bash
php yiic migrate
php yiic seed
```

This will set up your database tables and seed initial data (including default user and roles).

### 6. Access the Application

Once everything is set up and the server is running, you can access the application at:

```
http://localhost/ (or your domain name if deployed)
```

You can check the default username and password in the `UserSeederCommand.php` file.

## Author

- Muhammad Mukhlish Syarif

<p align="center"><b> ~ THANK YOU ~ </b></p>
