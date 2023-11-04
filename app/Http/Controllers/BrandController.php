<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function searchBy(string $payload = '')
    {
        $result = Brand::where('name', 'like', "%$payload%")->get();
        return response($result);
    }
}
