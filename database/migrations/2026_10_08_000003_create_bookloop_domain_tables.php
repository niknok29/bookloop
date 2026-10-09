<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {
  Schema::create('books', function(Blueprint $t){$t->id();$t->string('title');$t->string('author');$t->string('isbn')->nullable()->index();$t->string('category')->nullable()->index();$t->text('description')->nullable();$t->timestamps();});
  Schema::create('book_points', function(Blueprint $t){$t->id();$t->string('name');$t->text('description')->nullable();$t->string('address');$t->boolean('is_active')->default(true)->index();$t->timestamps();});
  Schema::create('book_copies', function(Blueprint $t){$t->id();$t->foreignId('book_id')->constrained()->cascadeOnDelete();$t->string('public_id')->unique();$t->string('status')->index();$t->foreignId('current_bookpoint_id')->nullable()->constrained('book_points')->nullOnDelete();$t->foreignId('current_reader_id')->nullable()->constrained('users')->nullOnDelete();$t->foreignId('added_by')->constrained('users')->restrictOnDelete();$t->timestamp('taken_at')->nullable();$t->timestamps();});
  Schema::create('stickers', function(Blueprint $t){$t->id();$t->string('code')->unique();$t->string('status')->index();$t->foreignId('book_copy_id')->nullable()->unique()->constrained('book_copies')->nullOnDelete();$t->timestamp('activated_at')->nullable();$t->timestamps();});
  Schema::create('book_movements', function(Blueprint $t){$t->id();$t->foreignId('book_copy_id')->constrained()->cascadeOnDelete();$t->foreignId('user_id')->nullable()->constrained()->nullOnDelete();$t->foreignId('from_bookpoint_id')->nullable()->constrained('book_points')->nullOnDelete();$t->foreignId('to_bookpoint_id')->nullable()->constrained('book_points')->nullOnDelete();$t->string('action');$t->text('notes')->nullable();$t->timestamps();$t->index(['book_copy_id','created_at']);});
  Schema::create('wishlists', function(Blueprint $t){$t->id();$t->foreignId('user_id')->constrained()->cascadeOnDelete();$t->foreignId('book_id')->constrained()->cascadeOnDelete();$t->timestamps();$t->unique(['user_id','book_id']);});
  foreach(['coin_transactions','xp_transactions'] as $table){Schema::create($table,function(Blueprint $t){$t->id();$t->foreignId('user_id')->constrained()->cascadeOnDelete();$t->integer('amount');$t->string('reason');$t->nullableMorphs('reference');$t->timestamps();$t->index(['user_id','created_at']);});}
 }
 public function down(): void { foreach(['xp_transactions','coin_transactions','wishlists','book_movements','stickers','book_copies','book_points','books'] as $table) Schema::dropIfExists($table); }
};
