<?php
$isSubmenuActive = is_active("category") || is_active("sub-category")
?>

<aside id="sidebar"
    class="fixed left-0 top-0 h-screen w-64 bg-white border-r border-gray-200 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out z-40">
    <!-- Tambahan padding top agar tidak tertutup header -->
    <div class="pt-16">
        <nav class="mt-6">
            <div class="px-4 space-y-2">
                <!-- Dashboard Menu -->
                <a href="<?= route_to('admin.dashboard') ?>" class="flex items-center px-4 py-2 text-gray-700 rounded-lg <?= is_active('dashboard') ?>">
                    <svg class="w-5 h-5 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- Components Menu -->
                <div class="space-y-2">
                    <button
                        class="submenu-button flex items-center justify-between w-full px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <span>Category</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200  <?= $isSubmenuActive ? 'rotate-180' : '' ?>" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="submenu pl-8 space-y-1 <?= $isSubmenuActive ? '' : 'hidden' ?> overflow-y-auto max-h-48">
                        <a href="<?= route_to("admin.category") ?>"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg <?= is_active('category') ?>">Category</a>
                        <a href="<?= route_to("admin.sub-category") ?>"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg <?= is_active('sub-category') ?>">Sub Category</a>
                    </div>
                </div>

                <!-- Pages Menu -->
                <div class="space-y-2">
                    <button
                        class="submenu-button flex items-center justify-between w-full px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <span>Pages</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="submenu pl-8 space-y-1 overflow-y-auto max-h-48 md:max-h-full hidden">
                        <a href="blank.html"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">Blank
                            Page</a>

                    </div>
                </div>
                <!-- Repository Info Menu -->
                <div class="mt-4">
                    <hr>
                    <a href="https://github.com/abdulrahemfaqih/template-dashboard-tailwindcss" target="_blank"
                        class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <svg class="w-5 h-5 mr-4" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                        </svg>
                        <span>GitHub Repository</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</aside>