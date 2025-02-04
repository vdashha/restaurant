<?php

namespace App\Http\Controllers;

use App\Http\Requests\Courier\LoginRequest;
use App\Http\Requests\Courier\RegistrationRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\DeliveryResource;
use App\Models\Courier;
use App\Models\User;
use App\Repositories\CourierRepository;
use App\Repositories\DeliveryRepository;
use App\Services\User\AuthService;
use App\Services\User\ProfileService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CourierController extends BaseController
{
    public function __construct(private DeliveryRepository $deliveryRepository, private readonly CourierRepository $repository)
    {

    }

    public function registration(RegistrationRequest $request)
    {
        /** @var Courier $courier */
        $courier = $this->repository->create($request->validated());

        return response()->json(['token' => $courier->createToken('api_token', expiresAt: now()->addMonth())->plainTextToken]);
    }

    public function login(LoginRequest $request)
    {
        /** @var Courier $courier */
        $courier = $this->repository->findByPhoneNumber($request->get('phone'));

        if (Hash::check($request->get('password'), $courier->password)) {
            return response()->json(['token' => $courier->createToken('api_token', expiresAt: now()->addMonth())->plainTextToken]);
        }

        return response()->json(['error' => 'Неверный пароль']);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        Auth::guard('client')->logout();
        return response()->json(['Info' => 'Успех']);
    }

    public function getDeliveries(Request $request)
    {
        $deliveries = $request->user()->deliveries;
        return DeliveryResource::collection($deliveries);
    }

    public function changeStatus(Request $request)
    {
        $this->deliveryRepository->update($request->id, ['status' => $request->status]);
        $delivery = $this->deliveryRepository->find($request->id);
        return DeliveryResource::make($delivery);
    }

}
