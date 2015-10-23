# Laravel Reportable

## Installation

First, pull in the package through Composer.

```js
composer require ghanem/reportable
```

And then include the service provider within `app/config/app.php`.

```php
'providers' => [
    Ghanem\Reportable\ServiceProvider::class
];
```

At last you need to publish and run the migration.

```
php artisan vendor:publish --provider="Ghanem\Reportable\ServiceProvider" && php artisan migrate
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
$post->report([
    'reason' => str_random(10),
    'meta' => ['some more optional data, can be notes or something'],
], $user);
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
