<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; use Illuminate\Database\Eloquent\Model;
class BookPoint extends Model { use HasFactory; protected $fillable=['name','description','address','is_active']; protected $casts=['is_active'=>'boolean']; public function copies(){return $this->hasMany(BookCopy::class,'current_bookpoint_id');} public function movements(){return $this->hasMany(BookMovement::class);}}
