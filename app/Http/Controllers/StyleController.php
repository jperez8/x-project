<?php

namespace App\Http\Controllers;

use App\Models\Style;
use Illuminate\Http\Request;

class StyleController extends Controller
{
    public function searchBy(string $payload = '')
    {
        $result = Style::where('name', 'like', "%$payload%")->get();
        return response($result);
    }
}
