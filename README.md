<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Section A: Model, Controller, and Migrations

This section outlines the steps to create models, controllers, and migrations for a Laravel project.

### 1. Create Models with Controllers and Migrations

Run the following commands in your terminal to create the models, controllers, and migrations:

```bash
php artisan make:model Category -mcr
php artisan make:model Department -mcr
php artisan make:model District -mcr
php artisan make:model Product -mcr
php artisan make:model Region -mcr
php artisan make:model Role -mcr
```

**1. Navigate to the ```database/migrations``` directory. Open each migration file and add the following code to the up method.**

```Role migration file```

```php

 public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

```

```Department migration file```

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

```District migration file```

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

```Region migration file```

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

```Category migration file```

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

```Product migration file```

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