<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Dish;
use App\Models\Client;
use App\Services\User\CartService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Create a client and authenticate
        $this->client = Client::factory()->create();
        Auth::guard('client')->login($this->client);
    }

    /** @test */
    public function it_shows_the_cart_page()
    {
        // Given: A client has a cart with items
        $cart = Cart::factory()->create(['client_id' => $this->client->id]);
        $dish = Dish::factory()->create();
        $cartItem = CartItem::factory()->create(['cart_id' => $cart->id, 'dish_id' => $dish->id, 'quantity' => 2]);

        // When: The client views the cart
        $response = $this->get(route('cart.index'));

        // Then: The cart page is displayed correctly
        $response->assertStatus(200);
        $response->assertSee($dish->title);
        $response->assertSee(number_format($cartItem->dish->price * $cartItem->quantity, 2));
    }

    /** @test */
    public function it_adds_a_dish_to_the_cart()
    {
        // Given: A client is logged in
        $dish = Dish::factory()->create();

        // When: The client adds a dish to the cart
        $response = $this->get(route('cart.add', ['dish_id' => $dish->id]));

        // Then: The dish is added to the cart
        $this->assertDatabaseHas('cart_items', ['dish_id' => $dish->id, 'cart_id' => $this->client->cart->id]);
    }

    /** @test */
    public function it_updates_the_quantity_of_a_cart_item()
    {
        // Given: A client has a cart with a dish
        $dish = Dish::factory()->create();
        $cart = Cart::factory()->create(['client_id' => $this->client->id]);
        $cartItem = CartItem::factory()->create(['cart_id' => $cart->id, 'dish_id' => $dish->id, 'quantity' => 2]);

        // When: The client updates the quantity
        $response = $this->post(route('cart.update'), [
            'item_id' => $cartItem->id,
            'quantity' => 5
        ]);

        // Then: The quantity is updated in the database
        $this->assertDatabaseHas('cart_items', ['id' => $cartItem->id, 'quantity' => 5]);
    }

    /** @test */
    public function it_removes_a_item_from_the_cart()
    {
        // Given: A client has a cart with a dish
        $dish = Dish::factory()->create();
        $cart = Cart::factory()->create(['client_id' => $this->client->id]);
        $cartItem = CartItem::factory()->create(['cart_id' => $cart->id, 'dish_id' => $dish->id, 'quantity' => 2]);

        // When: The client removes the item from the cart
        $this->delete(route('cart.remove'), ['item_id' => $cartItem->id]);
        $this->assertDatabaseMissing('cart_items', ['id' => $cartItem->id]);
    }
}
