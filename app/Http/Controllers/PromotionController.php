<?php

namespace App\Http\Controllers;

use App\Repositories\PromotionRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PromotionController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(private PromotionRepository $promotionRepository)
    {

    }

    public function readPromotions()
    {
        $promotions = $this->promotionRepository->getByActualDate();
        return view('main', compact('promotions'));
    }
}
