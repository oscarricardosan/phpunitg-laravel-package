<?php

namespace Oscarricardosan\PhpunitgLaravel\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Oscarricardosan\PhpunitgLaravel\PhpunitG;

class PhpunitgController extends Controller
{
    public function getTests(Request $request)
    {
        $this->validateToken($request);
        $phpunitG= new PhpunitG();
        return [
            "tests"=> $phpunitG->getTests()
        ];
    }

    protected function validateToken(Request $request)
    {
        if(is_null(env('PHPUNITG_TOKEN')))
            abort(403, 'Token is not configured');
        if(env('PHPUNITG_TOKEN') !== $request->token)
            abort(403, 'Token is invalid');
    }
}