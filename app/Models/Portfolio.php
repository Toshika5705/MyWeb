<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        "MemberId",
        "CreateTime",
        "Title",
        "Subtitle",
        "MyUrl",
        "UpdateTime",
    ] ;

    // 預設的屬性值
    protected $attributes = [
        'CreateTime' => 'datetimeoffset',
        'UpdateTime' => 'datetimeoffset',
    ];
}
