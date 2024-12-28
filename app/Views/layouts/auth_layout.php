<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Free Tailwind CSS Dashboard Template - Modern, Responsive, and Customizable Admin Panel Template ">
    <meta name="keywords"
        content="tailwind css dashboard, admin template, free dashboard, responsive dashboard, tailwind template, admin panel, dashboard template">
    <meta name="author" content="Abdul Rahem Faqih">
    <meta name="robots" content="index, follow">
    <title><?= $title ?? "blog" ?></title>
    <script src="<?= base_url("js/main.js") ?>"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-lg w-full mx-4">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <?= $this->renderSection("content") ?>
        </div>
    </div>
    <?= $this->renderSection("js") ?>
</body>

</html>