<?php

namespace Oscarricardosan\PhpunitgLaravel\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Oscarricardosan\PhpunitgLaravel\PhpunitG;
use Oscarricardosan\PhpunitgLaravel\PhpunitG_method;

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

    public function runMethod(Request $request)
    {
        $this->validateToken($request);
        $method= str_replace('\\', '\\\\', $request->get('method'));
        $phpunitG_method= (new PhpunitG_method($method))->runInPhpunit();

        return [
            "success"=> $phpunitG_method->isSuccess(),
            "message"=> $phpunitG_method->getResponseOfPhpunit(),
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