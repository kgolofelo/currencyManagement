<?php

namespace App;

use Marquine\ActivityLog\ActivityLog;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use ActivityLog;
}
