<x-layout>
    <div class="max-w-2xl flex flex-col basis-full items-center gap-y-20">
        <section class="w-full flex flex-col items-center gap-y-5 px-8 py-5 bg-[#fbfbfb] rounded-xl shadow-md md:gap-y-8 md:px-12 md:py-10">
            <h2 class="font-bold self-start md:text-xl">{{ __('Change Email') }}</h2>
            <form method="POST" action="{{ route('email.update') }}" class="w-full flex flex-col gap-y-6 text-sm">
                @method('put')
                @csrf
                <x-form-field label="{{ __('Current Email') }}" type="email" name="current_email" :value="old('current_email')" required/>
                <x-form-field label="{{ __('New Email') }}" type="email" name="new_email" :value="old('new_email')" required/>
                <x-form-field label="{{ __('Confirm New Email') }}" type="email" name="new_email_confirmation" required/>
                <x-primary-button class="self-start px-5 py-2.5 text-sm md:text-base">{{ __('Change Email') }}</x-primary-button>
            </form>
        </section>

        <section class="w-full flex flex-col items-center gap-y-5 px-8 py-5 bg-[#fbfbfb] rounded-xl shadow-md md:gap-y-8 md:px-12 md:py-10">
            <h2 class="font-bold self-start md:text-xl">{{ __('Change Password') }}</h2>
            <form method="POST" action="{{ route('password.update') }}" class="w-full flex flex-col gap-y-6 text-sm">
                @method('put')
                @csrf
                <x-form-field label="{{ __('Current Password') }}" type="password" name="current_password" required/>
                <x-form-field label="{{ __('New Password') }}" type="password" name="new_password" required/>
                <x-form-field label="{{ __('Confirm New Password') }}" type="password" name="new_password_confirmation" required/>
                <x-primary-button class="self-start px-5 py-2.5 text-sm md:text-base">{{ __('Change Password') }}</x-primary-button>
            </form>
        </section>

        <section class="w-full px-6 py-4 bg-[#fbfbfb] rounded-xl shadow-md md:px-12">
            <button id="openDeleteModal" class="flex items-center gap-x-1.5 px-2 py-1 text-sm text-[#c82333] rounded hover:bg-black/5">
                <x-icons.trash />
                <span>{{ __('Delete Account') }}</span>
            </button>
        </section>
    </div>

    <dialog id="deleteModal" class="modal bg-black/40">
        <div class="modal-box px-10 bg-[#fbfbfb]">
            <h1 class="text-2xl font-bold">{{ __('Delete Account') }}</h1>
            <p class="mt-5 font-semibold">{{ __('Are you sure you want to delete this account?') }}</p>
            <div class="mt-5">
                <x-form-field type="password" id="delete_password" name="delete_password" placeholder="{{ __('Password') }}" />
                <ul id="password-errors" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
            </div>

            <div class="mt-10 modal-action space-x-5">
                <button id="closeDeleteModal"  class="btn border-none bg-[#f0997d] hover:bg-[#ee8c6d]">{{ __('Cancel') }}</button>
                <button onclick="deleteUser()" class="btn btn-outline px-5 hover:bg-[#ef4c53] hover:text-white">{{ __('Delete') }}</button>
            </div>
        </div>
    </dialog>

    <script>
        const deleteModal = document.getElementById("deleteModal");

        $("#openDeleteModal").on("click", () => {
            removeErrors();
            deleteModal.show();
        });

        $("#closeDeleteModal").on("click", () => {
            deleteModal.close();
        });

        function deleteUser() {
            removeErrors();

            $.ajax({
                url: `http://localhost:8000/user-delete`,
                method: "delete",
                data: {
                    password: $("#delete_password").val(),
                },
                success: function () {
                    deleteModal.close();
                    location.reload();
                },
                error: function (err) {
                    if (err.status === 405) {
                        deleteModal.close();
                        location.reload();
                    } else if (err.status === 422) {
                        showErrors(err.responseJSON.errors.password);
                    } else {
                        console.error(err);
                    }
                }
            });
        }

        function showErrors(passwordErrors) {
            let errors = "";

            for (const error of passwordErrors) {
                errors += `<li>${error}</li>`;
            }
            $("#password-errors").html(errors).removeClass("hidden");
        }

        function removeErrors() {
            $("#password-errors").empty().addClass("hidden");
        }
    </script>
</x-layout>
