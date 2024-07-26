<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use SendGrid\Mail\Mail;
use App\Models\User; // Ensure you have this model imported
use App\Mail\CustomPasswordReset;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->only('email')['email'];
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            // Send email using SendGrid
            $this->sendResetLinkEmail($user);
            return back()->with('status', __($status));
        } else {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
        }
    }

    /**
     * Send password reset link email using SendGrid.
     */
    protected function sendResetLinkEmail(User $user)
    {
        $token = Password::createToken($user);
        $resetLink = route('password.reset', ['token' => $token, 'email' => $user->email]);
        // Render the Blade template to a string
        $htmlContent = view('emails.custom_client_password-reset', ['resetUrl' => $resetLink,'name' => $user->first_name])->render();

        $emailContent = new Mail();
        $emailContent->setFrom("no-reply@yvoovmedia.com", "Voovmedia");
        $emailContent->setSubject("Password Reset Link");
        $emailContent->addTo($user->email);
        $emailContent->addContent("text/plain", "Here is your password reset link: " . $resetLink);
        $emailContent->addContent("text/html", $htmlContent);


        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));

        try {
            $response = $sendgrid->send($emailContent);
            if ($response->statusCode() >= 400) {
                // Log error or handle failure
            }
        } catch (\Exception $e) {
            // Log exception or handle failure
        }
    }
}
