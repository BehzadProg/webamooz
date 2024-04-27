<?php

namespace Beh7ad\User\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Beh7ad\User\Http\Requests\VerifyCodeRequest;
use Beh7ad\User\Mail\VerifyCodeMail;
use Beh7ad\User\Services\VerifyCodeService;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
    }

    public function verify(VerifyCodeRequest $request)
    {

        if (! VerifyCodeService::check(auth()->user()->id, $request->verify_code)) {
            return redirect()->back()->withErrors(['verify_code' => 'کد وارد شده معتبر نمی باشد!']);
        };

        auth()->user()->markEmailAsVerified();
        return redirect('/');

    }

    public function resend()
    {
        dd('hello');
    }
}
