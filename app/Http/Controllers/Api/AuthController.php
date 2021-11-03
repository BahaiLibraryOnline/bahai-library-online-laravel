<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OpenApi\RequestBodies\LoginUserRequestBody;
use App\OpenApi\Responses\Login\ErrorValidationResponse;
use App\OpenApi\Responses\Login\SuccessfulLoginResponse;
use App\OpenApi\Responses\Login\ValidationLoginErrorsResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class AuthController extends Controller
{
    /**
     * Login user
     */
    #[OpenApi\Operation(tags: ['auth'])]
    #[OpenApi\RequestBody(factory: LoginUserRequestBody::class)]
    #[OpenApi\Response(factory: SuccessfulLoginResponse::class)]
    #[OpenApi\Response(factory: ErrorValidationResponse::class, statusCode: 422)]
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        $user = User::whereEmail($request->email)->firstOrFail();

        $token = $user->createToken('auth-token');

        return response()->json([
            'token' => $token->plainTextToken,
        ]);
    }
}
