<?= $this->extend('layouts/page_layout'); ?>

<?= $this->section("content") ?>
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <h3 class="text-xl font-bold">Category</h3>
    <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
        <!-- <input type="text" placeholder="Search..."
            class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-gray-400"> -->
        <button onclick="openModal('medium-modal')" class="w-full text-sm sm:w-auto bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Add
            New</button>


    </div>
</div>



<!-- Rest of the content remains the same -->
<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>

                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">#12345</td>
                <td class="px-6 py-4 whitespace-nowrap">John Doe</td>
                <td class="px-6 py-4 whitespace-nowrap">john@example.com</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">2024-01-01</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <button class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                    <button class="text-red-600 hover:text-red-900">Delete</button>
                </td>
            </tr>

        </tbody>
    </table>
</div>

<!-- Pagination -->
<!-- <div class="flex items-center justify-between mt-6">
    <div class="text-sm text-gray-500">
        Showing 1 to 2 of 2 entries
    </div>
    <div class="flex space-x-2">
        <button class="px-3 py-1 border border-gray-300 rounded-lg hover:bg-gray-50">Previous</button>
        <button class="px-3 py-1 bg-gray-800 text-white rounded-lg">1</button>
        <button class="px-3 py-1 border border-gray-300 rounded-lg hover:bg-gray-50">Next</button>
    </div>
</div> -->

<div id="medium-modal"
    class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg w-full max-w-md mx-4">
        <div class="p-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold">Tambah Category</h3>
                <button onclick="closeModal('medium-modal')" class="text-gray-400 hover:text-gray-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-4">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                </div>
            </div>
        </div>
        <div class="p-4 border-t border-gray-200 flex justify-end space-x-3">
            <button onclick="closeModal('medium-modal')"
                class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                Cancel
            </button>
            <button class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700">
                Save
            </button>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?php $this->section("js") ?>
<script src="<?= base_url("js/modal.js") ?>"></script>
<?php $this->endSection() ?>