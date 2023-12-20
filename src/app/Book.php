<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Book extends Model
{
    use Sortable;

    protected $fillable = ['title', 'author'];
    public $sortable = ['title', 'author'];
}
