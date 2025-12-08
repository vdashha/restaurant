<?php

namespace Tests\Unit;

use Illuminate\Http\RedirectResponse;
use Tests\TestCase;
use App\Http\Controllers\OrderController;
use App\Repositories\OrderRepository;
use App\Repositories\CartRepository;
use App\Repositories\RestaurantRepository;
use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Mockery;

class OrderControllerTest extends TestCase
{
    private $orderRepository;
    private $cartRepository;
    private $restaurantRepository;
    private $orderService;
    private $controller;

    protected function setUp(): void
    {
        parent::setUp();

        $this->orderRepository = Mockery::mock(OrderRepository::class);
        $this->cartRepository = Mockery::mock(CartRepository::class);
        $this->restaurantRepository = Mockery::mock(RestaurantRepository::class);
        $this->orderService = Mockery::mock(OrderService::class);

        $this->controller = new OrderController(
            $this->orderRepository,
            $this->cartRepository,
            $this->restaurantRepository
        );
    }

    public function test_index_returns_view_with_orders()
    {
        // Arrange
        $clientId = 1;
        $orders = collect([new Order(), new Order()]);

        Auth::shouldReceive('guard')->with('client')->andReturnSelf();
        Auth::shouldReceive('id')->andReturn($clientId);

        $this->orderRepository
            ->shouldReceive('getByClientId')
            ->with($clientId)
            ->once()
            ->andReturn($orders);

        // Act
        $response = $this->controller->index();

        // Assert
        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
        $this->assertEquals('orders.ordersList', $response->name());
        $this->assertArrayHasKey('orders', $response->getData());
    }

    public function test_store_handles_exception()
    {
        // Arrange
        $orderRequest = Mockery::mock(OrderRequest::class);
        $exceptionMessage = 'Order creation failed';

        $this->orderService
            ->shouldReceive('addOrder')
            ->with($orderRequest)
            ->once()
            ->andThrow(new \Exception($exceptionMessage));

        // Act
        $response = $this->controller->store($orderRequest, $this->orderService);

        // Assert
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertTrue($response->isRedirect());
        $this->assertTrue(session()->has('error'));
        $this->assertEquals($exceptionMessage, session('error'));
    }

    public function test_show_returns_view_with_order()
    {
        // Arrange
        $orderId = 1;
        $order = new Order(['id' => $orderId]);

        $this->orderRepository
            ->shouldReceive('find')
            ->with($orderId)
            ->once()
            ->andReturn($order);

        // Act
        $response = $this->controller->show($orderId);

        // Assert
        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
        $this->assertEquals('orders.order', $response->name());
        $this->assertArrayHasKey('order', $response->getData());
        $this->assertEquals($order, $response->getData()['order']);
    }

    public function test_remove_updates_order_status_and_redirects()
    {
        // Arrange
        $orderId = 1;

        $this->orderRepository
            ->shouldReceive('update')
            ->with($orderId, ['status' => OrderStatusEnum::FAILED])
            ->once();

        // Act
        $response = $this->controller->remove($orderId);

        // Assert
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertTrue($response->isRedirect());
    }

    public function test_placingOrder_returns_view_with_data()
    {
        // Arrange
        $clientId = 1;
        $cart = Mockery::mock(Cart::class);
        $cartItem = Mockery::mock(CartItem::class);
        $dish = Mockery::mock(Dish::class);
        $restaurants = collect([new Restaurant(), new Restaurant()]);

        Auth::shouldReceive('guard')->with('client')->andReturnSelf();
        Auth::shouldReceive('id')->andReturn($clientId);

        $cart->shouldReceive('getAttribute')->with('items')->andReturn(collect([$cartItem]));

        $cartItem->shouldReceive('getAttribute')->with('dish')->andReturn($dish);
        $cartItem->shouldReceive('getAttribute')->with('quantity')->andReturn(2);

        $dish->shouldReceive('getAttribute')->with('price')->andReturn(100.00);

        $cart->shouldReceive('getRelation')->with('items')->andReturn(collect([$cartItem]));

        $this->cartRepository
            ->shouldReceive('setWith')
            ->with(['items.dish'])
            ->once()
            ->andReturnSelf();

        $this->cartRepository
            ->shouldReceive('findByClientId')
            ->with($clientId)
            ->once()
            ->andReturn($cart);

        $this->restaurantRepository
            ->shouldReceive('all')
            ->once()
            ->andReturn($restaurants);

        // Act
        $response = $this->controller->placingOrder();

        // Assert
        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
        $this->assertEquals('orders.orderForm', $response->name());
        $data = $response->getData();
        $this->assertArrayHasKey('restaurants', $data);
        $this->assertArrayHasKey('totalAmount', $data);
        $this->assertEquals($restaurants, $data['restaurants']);
        $this->assertEquals(200.00, $data['totalAmount']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @test */
    public function show_aborts_when_client_id_mismatch()
    {
        $orderId = 1;
        $order = new Order([
            'id' => $orderId,
            'client_id' => 999, // Другой клиент
        ]);

        $this->orderRepository
            ->shouldReceive('find')
            ->with($orderId)
            ->once()
            ->andReturn($order);

        Auth::shouldReceive('id')->andReturn(8); // Текущий клиент

        // Act & Assert
        $this->expectExceptionCode(403);

        $this->controller->show($orderId);
    }
}
