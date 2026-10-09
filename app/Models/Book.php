<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Book extends Model { use HasFactory; protected $fillable=['title','author','isbn','category','description']; public function copies(){return $this->hasMany(BookCopy::class);} public function wishlists(){return $this->hasMany(Wishlist::class);} }
