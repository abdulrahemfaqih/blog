<?php $this->extend("layouts/page_layout") ?>

<?php $this->section("content") ?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">User Profile</h1>
    <button id="edit-profile" class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700">
        Edit Profile
    </button>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Profile Picture Section -->
    <div class="md:col-span-1 flex flex-col items-center relative">
        <?php $user = getUser(); ?>
        <div class="relative">
            <img src="<?= $user->picture == null ? 'https://via.placeholder.com/40' : base_url($user->picture) ?>" alt="Profile Picture"
                class="w-44 h-44 rounded-full mb-4 profile_picture">
            <label for="photo-upload" class="absolute bottom-6 right-0 bg-gray-800 hover:bg-gray-700 text-white p-2 rounded-full cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                <input type="file" name="photo_upload" id="photo-upload" class="hidden" accept="image/*">
            </label>
        </div>
        <h2 class="text-xl font-semibold mb-2"><?= $user->name ?></h2>
    </div>

    <!-- Profile Details Section -->
    <div class="md:col-span-2">
        <!-- Replace the content with form wrapper -->
        <form id="profile_form" method="POST" action="<?= route_to('admin.update.profile') ?>" class="space-y-4">
            <?= csrf_field(); ?>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <div class="flex items-start gap-x-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <p class="email_error text-red-500 text-sm error_text"></p>
                    </div>
                    <input type="email" name="email" value="<?= $user->email ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400"
                        disabled>
                </div>

                <div>
                    <div class="flex items-start gap-x-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <p class="username_error text-red-500 text-sm error_text"></p>
                    </div>
                    <input type="text" name="username" value="<?= $user->username ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400"
                        disabled>

                </div>

                <div>
                    <div class="flex items-start gap-x-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <p class="name_error text-red-500 text-sm error_text"></p>
                    </div>
                    <input type="text" name="name" value="<?= $user->name ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400"
                        disabled>
                </div>
            </div>
            <!-- Bio Section -->
            <div class="mt-4">
                <div class="flex items-start gap-x-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                    <p class="bio_error text-red-500 text-sm error_text"></p>
                </div>
                <textarea name="bio" disabled
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400"
                    rows="4"><?= $user->bio ?></textarea>
            </div>

            <!-- Submit Button -->
            <div class="mt-4 hidden" id="saveChangesBtn">
                <button type="submit"
                    class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-white">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<?php $this->endSection(); ?>


<?php $this->section("js") ?>

<script>
    const editProfileBtn = document.getElementById('edit-profile');
    const inputs = document.querySelectorAll('input, textarea');
    const saveChangesBtn = document.getElementById('saveChangesBtn');

    editProfileBtn.addEventListener('click', () => {
        const isEditing = editProfileBtn.textContent.trim() === 'Edit Profile';

        if (isEditing) {
            editProfileBtn.textContent = 'Cancel';
            editProfileBtn.classList.remove('bg-gray-800', 'hover:bg-gray-700');
            editProfileBtn.classList.add('bg-red-600', 'hover:bg-red-700');
            inputs.forEach(input => input.disabled = false);
            saveChangesBtn.classList.remove('hidden'); // Show save button
        } else {
            editProfileBtn.textContent = 'Edit Profile';
            editProfileBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
            editProfileBtn.classList.add('bg-gray-800', 'hover:bg-gray-700');
            inputs.forEach(input => input.disabled = true);
            saveChangesBtn.classList.add('hidden'); // Hide save button

            form.reset();
            document.querySelectorAll('.error_text').forEach(error => error.textContent = '');
        }
    });
</script>

<script>
    $("#profile_form").on("submit", function(e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);
        const submitBtn = $(form).find('button[type="submit"]');
        const originalBtnText = submitBtn.text();

        $.ajax({
            url: $(form).attr("action"),
            method: $(form).attr("method"),
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function() {
                $(form).find("p.error_text").text("");
                submitBtn.prop('disabled', true)
                    .text('Saving...')
                    .addClass('opacity-75');
            },
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    if (response.status == 1) {
                        toast.success(response.msg, 5000);
                        $('#edit-profile').click();
                    } else {
                        toast.error(response.msg, 5000);
                    }
                } else {
                    $.each(response.error, function(prefix, val) {
                        $(form).find("p." + prefix + "_error").text(val);
                    });
                }
            },
            error: function(xhr, status, error) {
                toast.error('Terjadi kesalahan. Silakan coba lagi.', 5000);
            },
            complete: function() {
                submitBtn.prop('disabled', false)
                    .text(originalBtnText)
                    .removeClass('opacity-75');
            }
        });
    });
</script>

<script>
    $("#photo-upload").ijaboCropTool({
        preview: '.profile_picture',
        setRatio: 1,
        allowedExtensions: ['jpg', 'jpeg', 'png'],
        processUrl: '<?= route_to("admin.update-profile-picture") ?>',
        withCSRF: ['<?= csrf_token() ?>', '<?= csrf_hash() ?>'],
        onSuccess: function(message, element, status) {
            if (status == 1) {
                toast.success(message, 5000);

            } else {
                toast.error(message, 5000);
            }
        },
        onError: function(error, element, status) {
            console.error('Crop Error:', error);
            toast.error('Gagal mengupload gambar: ' + error, 5000);
        }
    });
</script>
<?php $this->endSection(); ?>