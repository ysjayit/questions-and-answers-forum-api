### Q&A Forum API

This REST API is to a Q&A forum for community to ask questions and answer or comment on them. 

**Technologies**
- Laravel Framework 8.83.23
- MySQL Database

**Packages and Libraries**
- Laravel Passport 10.4.1

**Features**
- User registration
- User / Administrator login
- View all posts
- View user's posts
- View post
- Create post
- Delete post
- Approve / Reject post
- Comment on posts
- Search posts

**Implementation and Concepts**
- Laravel Passport package is used to implement authentication in this REST API since it provides an easy and secure way to implement token authorization on an OAuth 2.0 server. 
- API response methods are implemented in a dedicated trait for them in order to achieve reusability of methods freely in several independent classes living in different class hierarchies.
- Laravel repository pattern is used achieve abstraction and make the code robust to changes.

**Installation**
- Clone the repository
- Composer install `composer install`
- Copy `.env.example` and change the to `.env`
- Configure the environment settings of database in `.env` file.
- Set the application key `php artisan key:generate`
- Run migration `php artisan migrate`
- Change the database insert query values (name, email, password) in `database\seeders\UserSeeder.php` file as required to create System Administrator.
- Run database seed `php artisan db:seed --class=UserSeeder`
- Run `php artisan passport:install` or `php artisan passport:keys`
- Run application `php artisan serve`