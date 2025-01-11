<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## SECTION A
### MODEL, CONTROLLER AND MIGRATIONS

This section outlines the steps to create models, controllers, and migrations for a Laravel project.
 
### CREATE MODELS WITH CONTROLLERS AND MIGRATIONS

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
![DISTRICTS](https://github.com/user-attachments/assets/b9b8bae0-a474-42cb-9150-bb593728e3a0)

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
![REGIONS](https://github.com/user-attachments/assets/941936f1-c477-4ab8-b740-22c33068e679)

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
![CATEGORY](https://github.com/user-attachments/assets/57fb86cd-9258-4694-be30-82065b215021)

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
