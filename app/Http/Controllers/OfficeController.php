<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OfficeService;

class OfficeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCode(Request $request)
    {
        $code = $request->query('code');
        
        if (!$code) {
            return response()->json(['error' => 'Authorization code not found'], 400);
        }

        $servicoOffice = new OfficeService();

        $tokenAccess = $servicoOffice->requestToken($code);

        dd($tokenAccess);
    }
}
