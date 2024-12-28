<?php $this->extend("layouts/auth_layout") ?>

<?= $this->section("content") ?>
<div class="text-center mb-8">
    <h2 class="text-3xl font-bold">Reset Password</h2>
    <p class="text-gray-600">Please enter your current password and new password</p>
</div>
<?php $validation = \Config\Services::validation() ?>
<form action="<?= route_to("admin.reset-password.handler", $token) ?>" method="POST">
    <?= csrf_field() ?>
    <!-- alert sucess -->
    <?php if (!empty(session()->getFlashdata("success"))) : ?>
        <?php
        $alert = new \App\Views\Components\Alerts\AlertComponent();
        echo $alert->render('success', session()->getFlashdata("success"));
        ?>
    <?php endif ?>
    <!-- alert fail -->
    <?php if (!empty(session()->getFlashdata("fail"))) : ?>
        <?php
        $alert = new \App\Views\Components\Alerts\AlertComponent();
        echo $alert->render('fail', session()->getFlashdata("fail"));
        ?>
    <?php endif ?>
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">New Password</label>
            <input type="password"
                name="new_password"
                value="<?= set_value("new_password") ?>"
                class="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-1 focus:ring-gray-400">
            <?php if ($validation->getError("new_password")) : ?>
                <div class="bg-red-100 p-2 rounded-lg mt-1">
                    <?= $validation->getError("new_password"); ?>
                </div>
            <?php endif ?>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Confirm New Password</label>
            <input type="password"
                name="confirm_new_password"
                value="<?= set_value("confirm_new_password") ?>"
                class="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-1 focus:ring-gray-400">
            <?php if ($validation->getError("confirm_new_password")) : ?>
                <div class="bg-red-100 p-2 rounded-lg mt-1">
                    <?= $validation->getError("confirm_new_password"); ?>
                </div>
            <?php endif ?>
        </div>
        <button type="submit"
            class="w-full bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700">Update Password</button>
    </div>
</form>
<p class="text-center mt-4 text-sm text-gray-600">
    <a href="<?= route_to("admin.login") ?>" class="text-gray-800 hover:underline">Back to Login</a>
</p>
<?= $this->endSection(); ?>