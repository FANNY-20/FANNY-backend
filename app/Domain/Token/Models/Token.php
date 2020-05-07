<?php

namespace Domain\Token\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $value
 * @property string $random_value
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Token extends Model
{
}
