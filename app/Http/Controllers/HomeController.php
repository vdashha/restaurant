<?php

namespace App\Http\Controllers;

use App\Repositories\PromotionRepository;
use App\Repositories\RestaurantRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(private PromotionRepository $promotionRepository, private RestaurantRepository $restaurantRepository)
    {

    }

    public function getInformationForHomePage()
    {
        $promotions = $this->promotionRepository->getByActualDate();
        $restaurants = $this->restaurantRepository->all();
        return view('main', compact('promotions', 'restaurants'));
    }
}
