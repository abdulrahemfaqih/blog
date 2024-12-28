<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\CIAuth;
use App\Models\PasswordResetToken;
use App\Models\User;
use App\Request\LoginRequest;
use App\Request\EmailRequest;
use App\Service\AuthService;
use Carbon\Carbon;

use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $loginRequest;
    protected $authService;
    protected $emailRequest;
    protected $helpers = ["CIMail"];

    public function __construct()
    {
        $this->loginRequest = new LoginRequest(service("request"));
        $this->emailRequest = new EmailRequest(service("request"));
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

        $actionLink = route_to("admin.reset-password", $token);
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

        if(sendEmail($mailConfig)) {
            return redirect()->route("admin.forgot")->with("success", "Kami sudah mengirim link untuk reset password pada email anda");
        } else {
            return redirect()->route("admin.forgot")->with("fail", "Sepertinya ada yang salah");
        }
    }
}
