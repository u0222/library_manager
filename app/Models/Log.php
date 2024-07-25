<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    // created_atとupdated_atの自動挿入を無効化
    public $timestamps = false;

    // INSERT、UPDATEで許可するカラムを指定
    protected $fillable = [
        "library_id",
        "user_id",
        "rent_date",
        "return_date",
        "return_due_date",
    ];

    public function library():belongsTo
    {
        return $this->belongsTo(Library::class,"library_id","id");
    }
}
