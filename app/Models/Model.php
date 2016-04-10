<?php

namespace Mapil\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Mapil\Traits\ValidatableModel;

class Model extends BaseModel
{
    use ValidatableModel;
}
