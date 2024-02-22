<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        // Retrieve user using id
        $user = $request->user();

        // Check if email is already verified
        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email already verified',
                'redirect_url' => config('app.frontend_url') . RouteServiceProvider::HOME,
            ], 400);
        }

        // Mark email as verified
        $user->markEmailAsVerified();
        event(new Verified($user));

        // Return success response with redirect URL (optional)
        return response()->json([
            'message' => 'Email verified successfully',
            'redirect_url' => config('app.frontend_url') . RouteServiceProvider::HOME . '?verified=1',
        ]);

    }
}
