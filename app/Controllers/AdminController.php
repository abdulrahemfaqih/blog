<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\CIAuth;
use CodeIgniter\HTTP\ResponseInterface;
use App\Request\ProfileRequest;
use App\Models\User;

class AdminController extends BaseController
{
    protected $profileRequest;
    public function __construct()
    {
        $this->profileRequest = new ProfileRequest(service("request"));
    }

    protected $helpers = ["url", "form", "CIMail", "CIFunctions"];
    public function index()
    {
        $data = [
            "title" => "Dashboard",
            "validation" => null
        ];
        return view("pages/dashboard", $data);
    }

    public function profile()
    {
        return view("pages/profile", [
            "title" => "Profile",
            "validation" => null
        ]);
    }

    public function updateProfile()
    {
        $request = service("request");
        $validation = service("validation");
        $userId = CIAuth::id();

        if ($request->isAJAX()) {
            $validation->setRules($this->profileRequest->rules($userId));


            if (!$validation->withRequest($request)->run()) {
                return $this->response->setJSON([
                    'status' => 0,
                    'error' => $validation->getErrors()
                ]);
            }

            $userData = [
                'name' => $request->getPost('name'),
                'username' => $request->getPost('username'),
                'email' => $request->getPost('email'),
                'bio' => $request->getPost('bio')
            ];

            try {
                $userModel = new User();
                $userModel->update($userId, $userData);

                return $this->response->setJSON([
                    'status' => 1,
                    'msg' => 'Profile berhasil diupdate'
                ]);
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'status' => 0,
                    'msg' => 'Gagal mengupdate profile'
                ]);
            }
        }

        return $this->response->setJSON([
            'status' => 0,
            'msg' => 'Invalid request'
        ]);
    }

    public function updateProfilePicture()
    {
        $request = service("request");
        $userId = CIAuth::id();
        $user = new User();
        $userDetail = $user->asObject()->where("id", $userId)->first();

        $path = FCPATH . "images/users/";
        $file = $request->getFile("photo_upload");

        if (!$file->isValid() || $file->hasMoved()) {
            echo json_encode([
                "status" => 0,
                "msg" => "Invalid file upload"
            ]);
        }

        $oldPicture = $userDetail->picture;
        $oldPicturePath = str_replace('images/users/', '', $oldPicture);
        $newFileName = "UIMG_" . $userId . "_" . $file->getRandomName();

        try {
            $uploadImage = service("image")
                ->withFile($file)
                ->resize(450, 450, true, 'height')
                ->save($path . $newFileName);

            if ($uploadImage) {
                if ($oldPicturePath && file_exists($path . $oldPicturePath)) {
                    unlink($path . $oldPicturePath);
                }

                $user->update($userId, [
                    "picture" => "images/users/" . $newFileName
                ]);

                echo json_encode([
                    "status" => 1,
                    "msg" => "Profile picture updated",

                ]);
            }
        } catch (\Throwable $th) {
            echo json_encode([
                "status" => 0,
                "msg" => "Gagal mengupload file"
            ]);
        }

    }
}
