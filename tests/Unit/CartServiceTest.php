<?php

namespace Tests\Unit\Services\User;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Client;
use App\Models\Dish;
use App\Services\User\CartService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CartServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = Client::factory()->create();
        Auth::guard('client')->login($this->client);

        $this->cartService = app(CartService::class);
    }

    /** @test */
    public function index_returns_cart_or_empty_cart()
    {
        // Сначала корзина пустая
        $cart = $this->cartService->index();
        $this->assertInstanceOf(Cart::class, $cart);
        $this->assertEmpty($cart->items);

        // Создаем корзину с элементом
        $cart = Cart::factory()->create(['client_id' => $this->client->id]);
        $dish = Dish::factory()->create();
        CartItem::factory()->create([
            'cart_id' => $cart->id,
            'dish_id' => $dish->id,
            'quantity' => 2
        ]);

        $cartFromService = $this->cartService->index();
        $this->assertEquals($cart->id, $cartFromService->id);
        $this->assertCount(1, $cartFromService->items);
    }

    /** @test */
    public function add_cart_calls_update_or_create()
    {
        $dish = Dish::factory()->create();


        $this->cartService->addCart($dish->id);

        $this->assertDatabaseHas('cart_items', [
            'dish_id' => $dish->id,
            'cart_id' => $this->client->cart->id,
        ]);
    }

    /** @test */
    public function update_cart_updates_quantity()
    {
        $cart = Cart::factory()->create(['client_id' => $this->client->id]);
        $dish = Dish::factory()->create();
        $cartItem = CartItem::factory()->create([
            'cart_id' => $cart->id,
            'dish_id' => $dish->id,
            'quantity' => 1
        ]);

        $request = new Request([
            'item_id' => $cartItem->id,
            'quantity' => 5
        ]);

        $this->cartService->updateCart($request);

        $this->assertDatabaseHas('cart_items', [
            'id' => $cartItem->id,
            'quantity' => 5
        ]);
    }

    /** @test */
    public function remove_cart_deletes_item()
    {
        $cart = Cart::factory()->create(['client_id' => $this->client->id]);
        $dish = Dish::factory()->create();
        $cartItem = CartItem::factory()->create([
            'cart_id' => $cart->id,
            'dish_id' => $dish->id,
        ]);

        $request = new Request(['item_id' => $cartItem->id]);

        $this->cartService->removeCart($request);

        $this->assertDatabaseMissing('cart_items', ['id' => $cartItem->id]);
    }
}
