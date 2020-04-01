## Knowledge Sharing - Laravel Session Two

#### 1) Configuration .env file
For this section we will use Sqlite as a database.
We need to change the DB_CONNECTION into .env and create a file to save this database file. (Absolute Path)

```sh
touch /Users/YOURNAME/Code/oxygen/storage/database/posts.sqlite
```

###### Change the DB_CONNECTION and DB_DATABASE values ​​in the .env file.

```sh
DB_CONNECTION=sqlite
DB_DATABASE=/Users/YOURNAME/Code/oxygen/storage/database/posts.sqlite
```

#### 2) Create a migration file

```sh
artisan make:migration create_posts_table
```

###### Add this scheme to the up method
```sh
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->mediumText('excerpt')->nullable();
    $table->longText('description')->nullable();
    $table->timestamps();
    $table->softDeletes();
});
```

###### Check other types of columns available
https://laravel.com/docs/7.x/migrations#introduction

```sh
artisan migrate:install
artisan migrate:fresh
```

###### Sqllite Client
https://sqlitebrowser.org/dl/

#### 3) Create a Model with Factory
```sh
artisan make:model Post -f
```
* -f - Factory
 
```sh
class Post extends Model {
    use SoftDeletes;
    protected $table = 'posts';
    protected $fillable = ['title', 'excerpt', 'description', 'status'];
}
```

###### Read more about types of factory formatters
https://github.com/fzaninotto/Faker

Add the return of the PostFactory file
```sh
$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->paragraph(1),
        'excerpt' => $faker->text,
        'description' => $faker->paragraph(10),
        'status' => 1
    ];
});
```

#### 4) Create a seed file
```sh
artisan make:seeder PostSeeder
```

This command is used to update new classes in a class map package. 
```sh
composer dump-autoload 
```

We will use the factory to fill some content in the development environment. Edit file database/factories/PostFactory.php
```sh
factory(Post::class, 50)->create();
```

This command run the seed to database
```sh
artisan db:seed   
```

#### 5) Create a Route /posts
```sh
Route::get('/posts', function () {
    return \App\Post::all();
});
```

#### 6) create a controller PostController
```sh
artisan make:controller PostController 
```

Now we should adjust the route to call the controller
```sh
Route::get('/posts', 'PostController@index');	
```

#### 7) Create a view to list our posts
```sh
touch resources/views/posts.blade.php
```

This is a simple example of content and code using blade functions and html to list our posts
```sh
<html lang="en">
<header>
    <link href="{!! asset('css/app.css') !!}" rel="stylesheet">
</header>
<body>
<div class="container">
    <h1>Posts</h1>
    @foreach($posts as $post)
        <div class="row">
            <div class="col-sm-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5>{{ $post->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $post->created_at->format('d/m/Y H:i') }}</h6>
                        <p>{{ $post->excerpt }}</p>
                        <a href="#" class="card-link">read more</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
</body>
</html>
```

#### 8) bonus -> install ui bootstrap
```sh
composer require laravel/ui
artisan ui bootstrap
npm install && npm run dev
```

