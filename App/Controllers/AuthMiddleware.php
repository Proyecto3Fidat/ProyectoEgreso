<?php


namespace App\Controllers;
use App\Services\AuthService;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class AuthMiddleware implements IMiddleware
{

    public function handle(Request $request): void
    {
        $authService = new AuthService();
        $authService->comprobarSesion();
        $authService->comprobarToken();
    }

}