<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## INVENTORY MIS PROJECT  DOCUMENTATION
### SYSTEM DEVELOPMENT & TECHNOLOGIES
### OPEN-SOURCE PROJECTS & TUTORIAL SERIES
![analytics](https://github.com/user-attachments/assets/ebb83eb9-ac7d-47d2-9285-728bcc00dc6b)
![re](https://github.com/user-attachments/assets/9136ff94-b661-4502-8f0f-54a6413fc805)
![www](https://github.com/user-attachments/assets/ef247b44-20a9-4e65-a217-be04595542fb)
![productss](https://github.com/user-attachments/assets/2b40f099-de8f-4e97-b015-3b2d37fae1fd)
![productss](https://github.com/user-attachments/assets/53b22a43-bf50-41ac-bc60-dce422b63b1f)

# Laravel for Beginners

Welcome to the **Laravel for Beginners** documentation. This guide will help you get started with creating Laravel projects from scratch. My name is Sameer, a Data Scientist and Information System Analyst. I am providing free source codes, detailed documentation, and video tutorials to teach you important steps in developing Laravel applications.

---

## Introduction
This documentation aims to teach and demonstrate how to create Laravel applications with practical, real-world examples. Unlike many online tutorials that provide incomplete guidance, this guide offers in-depth explanations and solutions to real-world problems using programming.

### Target Audience
This tutorial is designed for:
- Academic students working on their final year projects.
- Private individuals aspiring to become experts in web development.

---

## Problem Statement
The main purpose of this tutorial is to bridge the gap between theoretical tutorials and practical application. Many online resources fail to provide applicable knowledge for real-life scenarios. This guide focuses on solving problems using programming in the real world.

---

## Main Objective
The main objective of this tutorial is to provide comprehensive, step-by-step guidance for:
- Academic students completing their final year projects.
- Individuals enhancing their web development skills.

---

## Topics Covered
Here are the important topics we will cover:
- PHP Artisan installation
- XAMPP installation
- Visual Studio Code installation
- Laravel Framework installation
- Database settings
- Model definition and migrations
- Controller operations & business logic
- Routing and authentication
- Template and CDN installation
- Descriptive analytics

---

## Technologies Used
This tutorial will cover the following technologies:
- **Frontend:** HTML, CSS, JavaScript, AJAX, jQuery
- **Backend:** PHP, SQL, MySQL
- **Libraries and Tools:** Google Fonts, Font Awesome, DataTables, Bootstrap Watch, Sweet Alert dialogs

---

## Development Software Installation
Before proceeding, download and install the following development tools:

1. **PHP Artisan**
2. **XAMPP**
3. **Visual Studio Code**

---

## Laravel Framework Installation
### Install Laravel Framework
Open your terminal and run:
```bash
composer global require laravel/installer
```

### Create a New Laravel Project
To create a new Laravel project, run:
```bash
laravel new project
```

---

## Model, Controller, and Migration Creation
To create models, controllers, and migrations for the project, open your terminal and run:
```bash
php artisan make:model Category -mcr
php artisan make:model Department -mcr
php artisan make:model District -mcr
php artisan make:model Product -mcr
php artisan make:model Region -mcr
php artisan make:model Role -mcr
```

---

## Project Features
The following features will be implemented in this project:

| Feature               | Description                                      |
|-----------------------|--------------------------------------------------|
| **Product Management** | Insert, Update, Delete, View                     |
| **User Management**    | Insert, Update, Delete, View                     |
| **Category Management**| Insert, Update, Delete, View                     |
| **Region Management**  | Insert, Update, Delete, View                     |
| **Role Management**    | Insert, Update, Delete, View                     |
| **District Management**| Insert, Update, Delete, View                     |
| **Department Management**| Insert, Update, Delete, View                   |
| **Analytics**          | Displaying business trends for decision-making  |

---

**1. Navigate to the ```database/migrations``` directory. Open each migration file and add the following code to the up method.**

- Role migration file 
![ROLES](https://github.com/user-attachments/assets/8bdcc85e-3312-4b87-b778-a647db1b357e)

```php

 public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

```
- Department migration file 
![DEPARTMENTS](https://github.com/user-attachments/assets/27ff51a9-30a1-4415-8097-3a60938c08d6)

```php

  public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
    }
    

```
- District migration file
 ![DISTRICTS](https://github.com/user-attachments/assets/ee1a0b6d-e6cf-4ca6-b14b-db60f9f8b20d)


```php

    public function up()
{
    Schema::create('districts', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->timestamps();
    });
}

```

- Region migration file 
 ![REGIONS](https://github.com/user-attachments/assets/047eb67e-8ed7-4902-8074-35a3d9f2e629)


```php
public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
    }
    
```

- Category migration file
 ![CATEGORY](https://github.com/user-attachments/assets/fef8d729-5da3-461f-9524-963033a4177b)


```php
    public function up()
{
    Schema::create('categories', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->timestamps();
    });
}

```

- Product migration file
![PRODUCTS](https://github.com/user-attachments/assets/2d14edff-5fcc-43c7-8b1d-8fc8960ab72f)

```php
    public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('product_name');
        $table->date('registered_date');
        $table->decimal('purchasing_price', 10, 2);
        $table->decimal('selling_price', 10, 2);
        $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
        $table->string('status');
        $table->foreignId('region_id')->constrained('regions')->onDelete('cascade');
        $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
        $table->date('expiry_date');
        $table->timestamps();
    });
}

```
**2. Update the Users Table to add additional fields to the users table** 
![USERS](https://github.com/user-attachments/assets/7ed4fc35-8964-4166-9301-849f7dd165f7)

- Run the following command to create a migration file:

```bash
php artisan make:migration add_field_to_users_table --table=users
```
- Open the newly created migration file and add the following code

```php

  public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->unique()->nullable();
            $table->foreignId('department_id')->nullable()->constrained('departments');
            $table->foreignId('role_id')->nullable()->constrained('roles');
        });
    }
    

```

## SECTION B
### MODELS

This section outlines the steps to define model fields  and constraints like relation ships for a Laravel project.

###  MODEL DEFINITION

```Category Model```
```php
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

```

```Department Model```
```php
class Department extends Model
{
    protected $fillable = ['name'];
}
```

```District Model```
```php
class District extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
```


```Product Model```
```php
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'registered_date',
        'purchasing_price',
        'selling_price',
        'category_id',
        'status',
        'region_id',
        'district_id',
        'expiry_date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
```


```Region Model```
```php
class Region extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

```


```Role Model```
```php
class Role extends Model
{
    protected $fillable = ['name'];
}
```


```User Model```
```php
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'department_id',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function department()
{
    return $this->belongsTo(Department::class);
}

public function role()
{
    return $this->belongsTo(Role::class);
}

}
```
