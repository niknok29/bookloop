<?php
namespace Database\Seeders;
use App\Models\Book; use App\Models\BookPoint; use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder { public function run(): void { Book::firstOrCreate(['title'=>'The Design of Everyday Things','author'=>'Don Norman'],['category'=>'Design','description'=>'Deterministic demo seed data.']); BookPoint::firstOrCreate(['name'=>'Central Student Centre'],['address'=>'Campus main hall','is_active'=>true]); } }
