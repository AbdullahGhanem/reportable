[![Latest Version](https://img.shields.io/github/release/abdullahghanem/reportable.svg?style=flat-square)](https://github.com/abdullahghanem/reportable/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/ghanem/reportable.svg?style=flat-square)](https://packagist.org/packages/ghanem/reportable)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
# Laravel Reportable
This package will allow you to add a full report system into your Laravel application.

## Installation

First, pull in the package through Composer.

```js
composer require ghanem/reportable
```

And then include the service provider within `app/config/app.php`.

```php
'providers' => [
    Ghanem\Reportable\ReportableServiceProvider::class
];
```

At last you need to publish and run the migration.

```bash
php artisan vendor:publish
```
and
```bash
php artisan migrate
```

## Setup a Model
```php
<?php

namespace App;

use Ghanem\Reportable\Contracts\Reportable;
use Ghanem\Reportable\Traits\Reportable as ReportableTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements Reportable
{
    use ReportableTrait;
}

```

## Examples

#### The User Model reports the Post Model
```php
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Post;
use Auth;

class PostController extends Controller
{
    public function makeReport()
    {
        $post = Post::find(1);
        $user = Auth::user();
        
        $post->report([
            'reason' => str_random(10),
            'meta' => ['some more optional data, can be notes or something'],
        ], $user);
    }
```

#### Create a conclusion for a Report and add the User Model as "judge" (useful to later see who or what came to this conclusion)
```php
$report->conclude([
    'conclusion' => 'Your report was valid. Thanks! We\'ve taken action and removed the entry.',
    'action_taken' => 'Record has been deleted.' // This is optional but can be useful to see what happend to the record
    'meta' => ['some more optional data, can be notes or something'],
], $user);
```

#### Get the conclusion for the Report Model
```php
$report->conclusion;
```

#### Get the judge for the Report Model (only available if there is a conclusion)
```php
$report->judge(); // Just a shortcut for $report->conclusion->judge
```

#### Get an array with all Judges that have ever "judged" something
```php
Report::allJudges();
```
