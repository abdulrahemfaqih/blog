<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : "Blog" ?></title>
    <script src="<?= base_url("js/main.js") ?>"></script>
    <script src="<?= base_url("js/jquery.js") ?>"></script>
    <script src="<?= base_url("js/toast.js") ?>"></script>
    <script src="<?= base_url("ijaboCroptool/ijaboCropTool.min.js") ?>"></script>
    <!-- css for crop image -->
    <link rel="stylesheet" href="<?= base_url("ijaboCroptool/ijaboCropTool.min.css") ?>">
    <style>
        rotate-180 {
            transform: rotate(180deg);
        }

        /* Tambahan CSS untuk mobile menu */
        @media (max-width: 768px) {
            .mobile-menu-open {
                transform: translateX(0) !important;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- header -->
    <?php include_once("inc/header.php") ?>

    <!-- sidebar -->
    <?php include_once("inc/sidebar.php") ?>

    <!-- content -->
    <main class="ml-0 md:ml-64 pt-20 p-6">
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <?= $this->renderSection('content'); ?>
        </div>
    </main>

    <!-- js -->
    <?= $this->renderSection('js'); ?>

    <!-- default js -->
    <script>
        // Mobile menu toggle dengan perbaikan
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');

        mobileMenuButton.addEventListener('click', (e) => {
            e.stopPropagation();
            sidebar.classList.toggle('-translate-x-full');
            sidebar.classList.toggle('mobile-menu-open');
        });

        // Close sidebar when clicking outside
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 768) {
                if (!sidebar.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                    sidebar.classList.add('-translate-x-full');
                    sidebar.classList.remove('mobile-menu-open');
                }
            }
        });

        // Submenu toggles
        const submenuButtons = document.querySelectorAll('.submenu-button');

        submenuButtons.forEach(button => {
            button.addEventListener('click', () => {
                const submenu = button.nextElementSibling;
                const arrow = button.querySelector('svg:last-child');

                submenu.classList.toggle('hidden');
                arrow.classList.toggle('rotate-180');
            });
        });

        // Profile dropdown
        const profileButton = document.getElementById('profile-button');
        const profileDropdown = document.getElementById('profile-dropdown');

        if (profileButton && profileDropdown) {
            profileButton.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', (e) => {
                if (!profileButton.contains(e.target)) {
                    profileDropdown.classList.add('hidden');
                }
            });
        }
    </script>
</body>

</html>