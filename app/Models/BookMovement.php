<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; use Illuminate\Database\Eloquent\Model;
class BookMovement extends Model { use HasFactory; protected $fillable=['book_copy_id','user_id','from_bookpoint_id','to_bookpoint_id','action','notes']; public function bookCopy(){return $this->belongsTo(BookCopy::class);} public function user(){return $this->belongsTo(User::class);} public function fromBookPoint(){return $this->belongsTo(BookPoint::class,'from_bookpoint_id');} public function toBookPoint(){return $this->belongsTo(BookPoint::class,'to_bookpoint_id');}}
