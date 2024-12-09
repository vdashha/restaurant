<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PromotionController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public static function readPromtions()
    {
        $promotions=Promotion::all();
        return view('main', compact('promotions'));
    }
}
