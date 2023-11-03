<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AdminService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(public AdminService $adminService)
    {
    }
    public function __invoke(LoginRequest $request)
    {
        $result = $this->adminService->login($request);
        return response()->json($result);
    }
}
