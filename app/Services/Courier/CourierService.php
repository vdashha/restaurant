<?php

namespace App\Services\Courier;

use App\Repositories\DeliveryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourierService
{
    public function __construct(private DeliveryRepository $deliveryRepository)
    {

    }

    public function registration(Request $request)
    {
        $request->user()->tokens()->delete();
        Auth::guard('client')->logout();
    }

    public function changeStatus(Request $request)
    {
        $delivery = $this->deliveryRepository->find($request->id);
        $delivery->update(['status' => $request->status]);
        return $delivery;
    }

}
