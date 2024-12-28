<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\CIAuth;
use App\Libraries\Hash;
use App\Models\PasswordResetToken;
use App\Models\User;
use App\Request\LoginRequest;
use App\Request\EmailRequest;
use App\Request\ResetPasswordRequest;
use App\Service\AuthService;
use Carbon\Carbon;

use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $loginRequest;
    protected $authService;
    protected $emailRequest;
    protected $resetPasswordRequest;

    protected $helpers = ["CIMail"];

    public function __construct()
    {
        $this->loginRequest = new LoginRequest(service("request"));
        $this->emailRequest = new EmailRequest(service("request"));
        $this->resetPasswordRequest = new ResetPasswordRequest(service("request"));
        $this->authService = new AuthService();
    }

    public function loginForm()
    {
        $data = [
            "title" => "Login"
        ];
        return view("auth/login", $data);
    }


    public function loginHandler()
    {
        if (!$this->validate($this->loginRequest->rules())) {
            return view("auth/login", [
                "title" => "Login",
                "validator" => $this->validator
            ]);
        }

        $loginId = $this->request->getVar("login_id");
        $password = $this->request->getVar("password");

        $user = $this->authService->attempLogin($loginId, $password);

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('fail', 'Password atau email/username tidak cocok');
        }
        CIAuth::setCIAuth($user);
        return redirect()->route('admin.dashboard');
    }


    public function logoutHandler()
    {
        CIAuth::forget();
        return redirect()->route("admin.login")->with("fail", "Anda telah logout");
    }

    public function forgotForm()
    {
        $data = [
            "title" => "Forgot Password",
            "validator" => null
        ];
        return view("auth/forgot", $data);
    }

    public function sendPasswordResetLink()
    {
        if (!$this->validate($this->emailRequest->rules())) {
            return view("auth/forgot", [
                "title" => "Forgot Password",
                "validator" => $this->validator
            ]);
        }

        $user = new User();
        $userDetails = $user->asObject()->where("email", $this->request->getVar("email"))->first();
        // generate token
        $token = bin2hex(openssl_random_pseudo_bytes(65));

        $passwordResetToken = new PasswordResetToken();
        $isOldTokenExists = $passwordResetToken->asObject()->where("email", $userDetails->email)->first();

        if ($isOldTokenExists) {
            // update token
            $passwordResetToken->where("email", $userDetails->email)
                ->set([
                    "token" => $token,
                    "created_at" => Carbon::now()
                ])->update();
        } else {
            $passwordResetToken->insert([
                "email" => $userDetails->email,
                "token" => $token,
                "created_at" => Carbon::now()
            ]);
        }

        // baut action link

        $actionLink = base_url(route_to("admin.reset-password", $token));
        $mailData = [
            "actionLink" => $actionLink,
            "user" => $userDetails
        ];

        $view = \Config\Services::renderer();
        $emailBody = $view->setVar('mailData', $mailData,)->render("email_template/forgot_email_template");
        $mailConfig = [
            "mailFromEmail" => env("email.fromEmail"),
            "mailFromName" => env("email.fromName"),
            "mailRecepientEmail" => $userDetails->email,
            "mailRacepientName" => $userDetails->name,
            "mailSubject" => "Reset Password",
            "mailBody" => $emailBody
        ];

        if (sendEmail($mailConfig)) {
            return redirect()->route("admin.forgot")->with("success", "Kami sudah mengirim link untuk reset password pada email anda");
        } else {
            return redirect()->route("admin.forgot")->with("fail", "Sepertinya ada yang salah");
        }
    }


    public function resetPassword($token)
    {
        $passwordResetPassword = new PasswordResetToken();
        $checkToken = $passwordResetPassword->asObject()->where("token", $token)->first();
        if (!$checkToken) {
            return redirect()->route("admin.forgot")->with("fail", "Token tidak valid, silahkan request reset password link");
        }
        // cek apakah token sudah expired atau belum
        $diffMins = Carbon::createFromFormat("Y-m-d H:i:s", $checkToken->created_at)->diffInMinutes(Carbon::now());

        if ($diffMins > 15) {
            return redirect()->route("admin.forgot")->with("fail", "Token telah expired, silahkan kirim reset token lagi");
        }

        // jika aman
        return view("auth/reset", [
            "title" => "Reset Password",
            "validation" => null,
            "token" => $token
        ]);
    }


    public function resetPasswordHandler($token)
    {
        if (!$this->validate($this->resetPasswordRequest->rules())) {
            return view("auth/reset", [
                "title" => "Reset Password",
                "validator" => $this->validator,
                "token" => $token
            ]);
        }

        $passwordResetPassword = new PasswordResetToken();
        $getToken = $passwordResetPassword->asObject()->where("token", $token)->first();

        // get detail user
        $user = new User();
        $userDetails = $user->asObject()->where("email", $getToken->email)->first();

        if (!$getToken) {
            return redirect()->back()->with("fail", "Invalid token");
        }
        $user->where("email", $getToken->email)
            ->set([
                "password" => Hash::make($this->request->getVar("new_password"))
            ])->update();

        // kirim notifikasi
        $mailData = [
            "user" => $userDetails,
            "new_password" => $this->request->getVar("new_password")
        ];

        $view = \Config\Services::renderer();
        $emailBody = $view->setVar('mailData', $mailData,)->render("email_template/password_changed_email_template");
        $mailConfig = [
            "mailFromEmail" => env("email.fromEmail"),
            "mailFromName" => env("email.fromName"),
            "mailRecepientEmail" => $userDetails->email,
            "mailRacepientName" => $userDetails->name,
            "mailSubject" => "Reset Password",
            "mailBody" => $emailBody
        ];

        if (sendEmail($mailConfig)) {
            $passwordResetPassword->where("email", $getToken->email)->delete();
            return redirect()->route("admin.login")->with("success", "Password anda telah di diperbarui");
        } else {
            return redirect()->back()->with("fail", "Sepertinya ada yang salah");
        }
    }
}
