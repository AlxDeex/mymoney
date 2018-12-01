<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Transaction
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transaction query()
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    protected $fillable = [
        'type',
        'category_id',
        'date', 'sum_amount',
        'user_id',
        'account_id',
        'comment',
    ];

}
