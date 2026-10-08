<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; use Illuminate\Database\Eloquent\Model;
class CoinTransaction extends Model { use HasFactory; protected $fillable=['user_id','amount','reason','reference_type','reference_id']; public function user(){return $this->belongsTo(User::class);}}
