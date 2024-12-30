<header class="bg-white border-b border-gray-200 fixed w-full top-0 z-50">
    <div class="flex justify-between items-center px-6 py-3">
        <div class="flex items-center">
            <span class="text-xl font-bold">Logo</span>
        </div>
        <!-- Mobile Menu Button dengan z-index yang sesuai -->
        <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg hover:bg-gray-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div class="hidden md:flex items-center space-x-4">
            <div class="relative">
                <button id="profile-button" class="flex items-center space-x-2">
                    <?php $user = getUser(); ?>
                    <img src="<?= $user->picture  ? base_url($user->picture) : 'https://via.placeholder.com/40'  ?>" alt="Profile" class="w-8 h-8 rounded-full profile_picture">
                    <span><?= getUser()->name ?></span>
                </button>
                <div id=" profile-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                    <a href="<?= route_to("admin.profile") ?>" class="block px-4 py-2 text-sm hover:bg-gray-100">Profile</a>
                    <a href="<?= route_to("admin.logout") ?>" class="block px-4 py-2 text-sm hover:bg-gray-100">Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>