<x-layout>
    <button onclick="openCreateModal()" class="fixed bottom-5 right-5 z-20 md:hidden">
        <x-icons.floating-action-button class="drop-shadow-[0_4px_6px_rgba(0,0,0,0.4)]" />
    </button>

    <div class="mt-5 w-full lg:w-3/4 md:mt-10">
        <div class="hidden sticky top-0 z-10 py-5 bg-[#fff5ea] md:block">
            <button onclick="openCreateModal()" class="btn px-8 border-none bg-[#f0997d] hover:bg-[#ee8c6d]">{{ __('Plan') }}</button>
        </div>

        <div class="mt-5 rounded-md bg-[#fbfbfb] space-y-2 py-4 shadow md:px-4">
            @foreach($juntaPanelasList as $juntaPanelas)
                <div class="group flex justify-between items-center px-3 py-2 hover:bg-black/5">
                    <div class="min-w-0 md:max-w-[540px] min-[1140px]:max-w-[620px]">
                        <x-primary-link href="{{ route('junta-panelas.show', ['juntaPanelas' => $juntaPanelas]) }}" class="block truncate text-sm font-bold md:text-base">{{ $juntaPanelas->title }}</x-primary-link>
                        <x-date :date="$juntaPanelas->date" class="text-xs font-semibold md:text-sm" />
                    </div>

                    <div class="dropdown dropdown-left pl-3 md:pl-5 min-[870px]:hidden">
                        <button>
                            <x-icons.ellipsis-vertical />
                        </button>
                        <div tabindex="0" class="dropdown-content w-48 px-0 py-1.5 menu bg-[#fbfbfb] rounded shadow">
                            <a href="{{ route('participant.index', ['juntaPanelas' => $juntaPanelas]) }}" title="{{ __('Participants') }}" class="flex items-center gap-x-3 px-4 py-2 hover:bg-black/5">
                                <x-icons.people class="size-5" />
                                <span>{{ __('Participants') }}</span>
                            </a>
                            <button onclick="openUpdateModal({{ json_encode($juntaPanelas->id) }})" title="{{ __('Edit') }}" class="flex items-center gap-x-3 px-4 py-2 hover:bg-black/5">
                                <x-icons.pencil class="size-5" />
                                <span>{{ __('Edit') }}</span>
                            </button>
                            <button onclick="openDeleteModal({{ json_encode($juntaPanelas->id) }})" title="{{ __('Delete') }}" class="flex items-center gap-x-3 px-4 py-2 hover:bg-black/5">
                                <x-icons.trash class="size-5" />
                                <span>{{ __('Delete') }}</span>
                            </button>
                        </div>
                    </div>

                    <div class="hidden items-center gap-x-3 min-[870px]:hidden min-[870px]:group-hover:flex">
                        <a href="{{ route('participant.index', ['juntaPanelas' => $juntaPanelas]) }}" title="{{ __('Participants') }}" class="px-1.5 py-1.5 rounded-full hover:bg-black/5 active:bg-black/10">
                            <x-icons.people class="size-5" />
                        </a>
                        <button onclick="openUpdateModal({{ json_encode($juntaPanelas->id) }})" title="{{ __('Edit') }}" class="px-1.5 py-1.5 rounded-full hover:bg-black/5 active:bg-black/10">
                            <x-icons.pencil class="size-5" />
                        </button>
                        <button onclick="openDeleteModal({{ json_encode($juntaPanelas->id) }})" title="{{ __('Delete') }}" class="px-1.5 py-1.5 rounded-full hover:bg-black/5 active:bg-black/10">
                            <x-icons.trash class="size-5" />
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <dialog id="createModal" class="modal bg-black/40">
        <div class="modal-box px-10 bg-[#fbfbfb]">
            <h1 class="text-2xl text-center font-bold">{{ __('Planning') }}</h1>

            <form class="mt-10 flex flex-col gap-y-6">
                <div>
                    <x-form-field label="{{ __('Event Title') }}" name="title" placeholder="{{ __('Christmas Party') }}"/>
                    <ul data-title-errors="create" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                </div>

                <div>
                    <x-form-field label="{{ __('Date') }}" type="date" name="date" :min="now()->addDay()->format('Y-m-d')"/>
                    <ul data-date-errors="create" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                </div>

                <div>
                    <x-form-field label="{{ __('Time') }}" type="time" name="time"/>
                    <ul data-time-errors="create" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                </div>
            </form>

            <div class="mt-10 modal-action space-x-5">
                <button id="closeCreateModal"  class="btn border-transparent rounded-md font-semibold hover:border-[#f0997d] shadow-none">{{ __('Cancel') }}</button>
                <button id="createButton" class="btn px-5 border-none bg-[#f0997d] hover:bg-[#ee8c6d]">{{ __('Plan') }}</button>
            </div>
        </div>
    </dialog>

    <dialog id="updateModal" class="modal bg-black/40">
        <div class="modal-box px-10 bg-[#fbfbfb]">
            <h1 class="text-2xl text-center font-bold">{{ __('Update Planning') }}</h1>

            <form class="mt-10 flex flex-col gap-y-6">
                <div>
                    <x-form-field id="update_title" label="{{ __('Event Title') }}" name="title"/>
                    <ul data-title-errors="update" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                </div>

                <div>
                    <x-form-field id="update_date" label="{{ __('Date') }}" type="date" name="date" :min="now()->addDay()->format('Y-m-d')"/>
                    <ul data-date-errors="update" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                </div>

                <div>
                    <x-form-field id="update_time" label="{{ __('Time') }}" type="time" name="time"/>
                    <ul data-time-errors="update" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                </div>
            </form>

            <div class="mt-10 modal-action space-x-5">
                <button id="closeUpdateModal"  class="btn border-transparent rounded-md font-semibold hover:border-[#f0997d] shadow-none">{{ __('Cancel') }}</button>
                <button id="updateButton" class="btn px-5 border-none bg-[#f0997d] hover:bg-[#ee8c6d]">{{ __('Plan') }}</button>
            </div>
        </div>
    </dialog>

    <dialog id="deleteModal" class="modal bg-black/40">
        <div class="modal-box px-10 bg-[#fbfbfb]">
            <h1 class="text-2xl font-bold">{{ __('Delete Planning') }}</h1>
            <p class="mt-5 font-semibold">{{ __('Are you sure you want to delete this planning?') }}</p>
            <div class="mt-10 modal-action space-x-5">
                <button id="closeDeleteModal"  class="btn border-none bg-[#f0997d] hover:bg-[#ee8c6d]">{{ __('Cancel') }}</button>
                <button id="deleteButton" class="btn btn-outline px-5 hover:bg-[#ef4c53] hover:text-white">{{ __('Delete') }}</button>
            </div>
        </div>
    </dialog>

    <script>
        const createModal = document.getElementById("createModal");
        const updateModal = document.getElementById("updateModal");
        const deleteModal = document.getElementById("deleteModal");

        function openCreateModal() {
            createModal.show();
        }

        $("#closeCreateModal").on("click", () => {
            createModal.close();
        });

        async function openUpdateModal(id) {
            removeErrors("update");

            const {title, date} = await $.get(`http://localhost:8000/junta-panelas/${id}`, (data) => data);
            $("#update_title").val(title);
            $("#update_date").val(dayjs(date).format("YYYY-MM-DD"));
            $("#update_time").val(dayjs(date).format("HH:mm"));

            updateModal.setAttribute("data-id", id);
            updateModal.show();
        }

        $("#closeUpdateModal").on("click", () => {
            updateModal.close();
        });

        function openDeleteModal(id) {
            deleteModal.setAttribute("data-id", id);
            deleteModal.show();
        }

        $("#closeDeleteModal").on("click", () => {
            deleteModal.close();
        });

        $("#createButton").on("click", () => {
            removeErrors("create");

            $.post({
                url: "http://localhost:8000/junta-panelas",
                type: "post",
                data: {
                    title: $("#title").val(),
                    date: $("#date").val(),
                    time: $("#time").val()
                },
                success: function () {
                    createModal.close();
                    location.reload();
                },
                error: function (err) {
                    if (err.status === 422) {
                        showErrors(err.responseJSON.errors, "create");
                    } else {
                        console.log(err);
                    }
                }
            });
        })

        $("#updateButton").on("click", () => {
            removeErrors("update");

            const id = updateModal.getAttribute("data-id");

            $.ajax({
                url: "http://localhost:8000/junta-panelas/" + id,
                method: "put",
                data: {
                    title: $("#update_title").val(),
                    date: $("#update_date").val(),
                    time: $("#update_time").val()
                },
                success: function () {
                    updateModal.close();
                    location.reload();
                },
                error: function (err) {
                    if (err.status === 422) {
                        showErrors(err.responseJSON.errors, "update");
                    } else if (err.status === 405) { // To prevent the 'method not allowed' error. Probably a bug when accessing the put route
                        updateModal.close();
                        location.reload();
                    } else {
                        console.error(err);
                    }
                }
            });
        });

        $("#deleteButton").on("click", () => {
            const id = deleteModal.getAttribute("data-id");

            $.ajax({
                url: "http://localhost:8000/junta-panelas/" + id,
                method: "delete",
                success: function () {
                    deleteModal.close();
                    location.reload();
                },
                error: function (err) {
                    if (err.status === 405) {
                        deleteModal.close();
                        location.reload();
                    } else {
                        console.error(err);
                    }
                }
            });
        });

        function showErrors(errors, action) {
            for (const field in errors) {
                $(`[data-${field}-errors=${action}]`)
                    .html(addErrors(errors[field]))
                    .removeClass("hidden");
            }
        }

        function addErrors(fieldErrors) {
            let errors = "";

            for (const error of fieldErrors) {
                errors += `<li>${error}</li>`;
            }
            return errors;
        }

        function removeErrors(action) {
            $(`[data-title-errors=${action}]`).empty().addClass("hidden");
            $(`[data-date-errors=${action}]`).empty().addClass("hidden");
            $(`[data-time-errors=${action}]`).empty().addClass("hidden");
        }
    </script>
</x-layout>
