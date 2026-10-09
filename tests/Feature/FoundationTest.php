<?php
namespace Tests\Feature;
use Tests\TestCase; use Illuminate\Foundation\Testing\RefreshDatabase;
class FoundationTest extends TestCase { use RefreshDatabase;
 public function test_guest_can_view_home_and_register(): void { $this->get('/')->assertOk(); $this->get('/register')->assertOk(); }
 public function test_user_can_register_and_reach_dashboard(): void { $this->post('/register',['name'=>'Demo Student','email'=>'demo@example.test','password'=>'password123','password_confirmation'=>'password123'])->assertRedirect('/dashboard'); $this->assertAuthenticated(); $this->get('/dashboard')->assertOk()->assertSee('Demo Student'); }
}
