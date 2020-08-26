<?php

declare(strict_types=1);

namespace JsonMapper\EloquentMiddleware\Tests\Implementation;

use Illuminate\Database\Eloquent\Model;

class EloquentModel extends Model
{
    protected $connection = 'testbench';
}
