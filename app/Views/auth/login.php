<?php $this->extend("layouts/auth_layout") ?>

<?= $this->section("content") ?>
<div class="text-center mb-8">
    <h2 class="text-3xl font-bold">Login</h2>
    <p class="text-gray-600">Welcome back! Please login to your account.</p>
</div>
<?php $validation = \Config\Services::validation() ?>
<form action="<?= route_to("admin.login.handler") ?>" method="POST">
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
            <label class="block text-sm font-medium text-gray-700">Username or Email</label>
            <input type="text"
                name="login_id"
                value="<?= set_value("login_id") ?>"
                class="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-1 focus:ring-gray-400">
        </div>
        <?php if ($validation->getError("login_id")) : ?>
            <div class="bg-red-100 p-2 rounded-lg">
                <?= $validation->getError("login_id"); ?>
            </div>
        <?php endif ?>
        <div>
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password"
                name="password"
                value="<?= set_value("password") ?>"
                class="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-1 focus:ring-gray-400">
        </div>
        <?php if ($validation->getError("password")) : ?>
            <div class="bg-red-100 p-2 rounded-lg">
                <?= $validation->getError("password"); ?>
            </div>
        <?php endif ?>
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input type="checkbox" class="rounded border-gray-300">
                <label class="ml-2 text-sm text-gray-600">Remember me</label>
            </div>
            <a href="<?= route_to("admin.forgot") ?>" class="text-sm text-gray-600 hover:text-gray-800">Forgot password?</a>
        </div>
        <button type="submit"
            class="w-full bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700">Login</button>
    </div>

</form>

<?= $this->endSection(); ?>


<?= $this->section("js") ?>
<script>
    document.querySelectorAll('.dismissible-alert button').forEach(button => {
        button.addEventListener('click', () => {
            button.closest('.dismissible-alert').remove();
        });
    });
</script>
<?= $this->endSection(); ?>