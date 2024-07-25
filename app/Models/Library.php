<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    // created_atとupdated_atの自動挿入を無効化
    public $timestamps = false;

    // INSERT、UPDATEで許可するカラムを指定
    protected $fillable = [
        "name",
    ];

    public function logs():hasmany
    {
        return $this->hasmany(Log::class,"library_id","id");
    }
}
