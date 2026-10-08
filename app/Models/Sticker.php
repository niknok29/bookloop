<?php
namespace App\Models;
use App\Enums\StickerStatus; use Illuminate\Database\Eloquent\Factories\HasFactory; use Illuminate\Database\Eloquent\Model;
class Sticker extends Model { use HasFactory; protected $fillable=['code','status','book_copy_id','activated_at']; protected $casts=['status'=>StickerStatus::class,'activated_at'=>'datetime']; public function bookCopy(){return $this->belongsTo(BookCopy::class);}}
