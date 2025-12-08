<?php

namespace Tests\Feature;

use App\Enums\DeliveryTypeEnum;
use App\Enums\PaymentMethodEnum;
use App\Repositories\RestaurantRepository;
use Database\Factories\RestaurantFactory;
use Illuminate\Validation\Rule;
use Tests\TestCase;
use App\Models\Client;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Dish;
use App\Enums\OrderStatusEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdersControllerTest extends TestCase
{
//    use RefreshDatabase;

    private $client;
    private $restaurant;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = Client::factory()->create();
        $this->restaurant = Restaurant::factory()->create();

        Auth::guard('client')->login($this->client);
    }

    /** @test */
    public function authenticated_client_can_view_orders_list()
    {
        Order::factory()->count(3)->create([
            'client_id' => $this->client->id,
        ]);

        $response = $this->get(route('order.index'));

        $response->assertStatus(200);
        $response->assertViewIs('orders.ordersList');
        //$response->assertViewHas('orders');
    }

    /** @test */
    public function guest_cannot_access_orders_list()
    {
        Auth::guard('client')->logout();

        $response = $this->get(route('order.index'));

        $response->assertRedirect(route('client.login'));
    }

    /** @test */
    public function client_can_view_order_placing_form()
    {
        $dish = Dish::factory()->create([
            'price' => 150.00,
        ]);

        $cart = Cart::factory()->create([
            'client_id' => $this->client->id,
        ]);

        CartItem::factory()->create([
            'cart_id' => $cart->id,
            'dish_id' => $dish->id,
            'quantity' => 2,
        ]);

        Restaurant::factory()->count(2)->create();

        // Act
        $response = $this->get(route('orders.placingOrder'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('orders.orderForm');
        $response->assertViewHasAll(['restaurants', 'totalAmount']);
    }

    /** @test */
    public function client_can_view_specific_order()
    {
        $order = Order::factory()->create([
            'client_id' => $this->client->id,
            'delivery_type' => DeliveryTypeEnum::PICKUP,
            'adress' => $this->restaurant->id
        ]);

        $response = $this->get(route('orders.show', $order->id));

        $response->assertStatus(200);
        $response->assertViewIs('orders.order');
        $response->assertViewHas('order', $order);
    }

    /** @test */
    public function client_can_cancel_order()
    {
        // Arrange
        $order = Order::factory()->create([
            'client_id' => $this->client->id,
            'status' => OrderStatusEnum::NEW,
        ]);

        // Act
        $response = $this->delete(route('orders.remove', $order->id));

        // Assert
        $response->assertRedirect();

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => OrderStatusEnum::FAILED,
        ]);
    }

    /** @test */
    public function placing_order_form_shows_correct_total_amount()
    {
        // Arrange
        $dish1 = Dish::factory()->create(['price' => 100.00]);
        $dish2 = Dish::factory()->create(['price' => 200.00]);

        $cart = Cart::factory()->create(['client_id' => $this->client->id]);

        CartItem::factory()->create([
            'cart_id' => $cart->id,
            'dish_id' => $dish1->id,
            'quantity' => 2,
        ]);

        CartItem::factory()->create([
            'cart_id' => $cart->id,
            'dish_id' => $dish2->id,
            'quantity' => 1,
        ]);

        // Act
        $response = $this->get(route('orders.placingOrder'));

        // Assert
        $response->assertViewHas('totalAmount', 400.00); // (100 * 2) + (200 * 1)
    }

    /** @test */
    public function create_order_failed()
    {
        $OrderData = [
            'name' => 'Dasha',
            'phone' => '+375 (33) 333-33-33',
            'ready_time' => '18:35',
            'restaurant' => '3',
            'delivery_address' => 'wfsffs',
            'delivery_method' => DeliveryTypeEnum::DELIVERY->value,
            'payment_method' => PaymentMethodEnum::CARD->value,
        ];
        // Act
        $response = $this->post(route('orders.store'), $OrderData);

        $response->assertStatus(302);
    }


}
