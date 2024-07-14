<x-layout>
    <button onclick="openCreateModal()" class="fixed bottom-5 right-5 z-20 md:hidden">
        <x-icons.floating-action-button class="drop-shadow-[0_4px_6px_rgba(0,0,0,0.4)]" />
    </button>

    <div class="max-w-3xl flex flex-col basis-full gap-y-8">
        <section class="flex flex-col gap-y-10">
            <div class="text-center space-y-3">
                <h1 class="text-xl font-bold md:text-2xl">{{ $juntaPanelas->title }}</h1>
                <x-date :date="$juntaPanelas->date" class="block text-xs font-bold md:text-sm" />
            </div>

            <div class="hidden sticky top-0 z-10 py-5 bg-[#fff5ea] md:block">
                <button onclick="openCreateModal()" class="btn px-8 border-none bg-[#f0997d] hover:bg-[#ee8c6d]">{{ __('Add') }}</button>
            </div>

            <div class="rounded-md bg-[#fbfbfb] space-y-2 py-4 shadow md:px-4 @if(!count($juntaPanelas->participants)) hidden @endif">
                @foreach($juntaPanelas->participants->sortBy('name') as $participant)

                    <div class="group flex justify-between items-center px-3 py-2 hover:bg-black/5">
                        <div class="min-w-0 md:max-w-[540px] min-[1140px]:max-w-[620px]">
                            <h2 class="text-sm font-bold md:text-base">{{ $participant->name }}</h2>
                            <p class="text-xs font-semibold text-black/50 md:text-sm">{{ implode(' · ', $participant->items) }}</p>
                        </div>

                        <div class="dropdown dropdown-left pl-3 md:pl-5 md:hidden">
                            <button>
                                <x-icons.ellipsis-vertical />
                            </button>
                            <div tabindex="0" class="dropdown-content w-48 px-0 py-1.5 menu bg-[#fbfbfb] rounded shadow">
                                <button onclick="openUpdateModal({{ json_encode($juntaPanelas->id) }}, {{ json_encode($participant->id) }})" title="{{ __('Edit') }}" class="flex items-center gap-x-3 px-4 py-2 hover:bg-black/5">
                                    <x-icons.pencil class="size-5" />
                                    <span>{{ __('Edit') }}</span>
                                </button>
                                <button onclick="openDeleteModal({{ json_encode($juntaPanelas->id) }}, {{ json_encode($participant->id) }})" title="{{ __('Delete') }}" class="flex items-center gap-x-3 px-4 py-2 hover:bg-black/5">
                                    <x-icons.trash class="size-5" />
                                    <span>{{ __('Delete') }}</span>
                                </button>
                            </div>
                        </div>

                        <div class="hidden items-center gap-x-2 md:block lg:hidden lg:group-hover:flex">
                            <button onclick="openUpdateModal({{ json_encode($juntaPanelas->id) }}, {{ json_encode($participant->id) }})" title="{{ __('Edit') }}" class="px-1.5 py-1.5 rounded-full hover:bg-black/5 active:bg-black/10">
                                <x-icons.pencil class="size-5" />
                            </button>
                            <button onclick="openDeleteModal({{ json_encode($juntaPanelas->id) }}, {{ json_encode($participant->id) }})" title="{{ __('Delete') }}" class="px-1.5 py-1.5 rounded-full hover:bg-black/5 active:bg-black/10">
                                <x-icons.trash class="size-5" />
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <dialog id="createModal" class="modal bg-black/40">
        <div class="modal-box px-6 bg-[#fbfbfb] md:px-12">

            <form class="flex flex-col gap-y-6">
                <div>
                    <x-form-field label="{{ __('Name') }}" name="name" id="name" placeholder="{{ __('John') }}" :value="old('name')" required/>
                    <ul data-name-errors="create" class="hidden mt-2 text-xs text-red-600 space-y-1 md:text-sm"></ul>
                </div>

                <div class="flex flex-col gap-y-4">
                    <p class="text-sm font-semibold md:text-base">Item(s)</p>
                    <div>
                        <x-form-field name="item_1" placeholder="{{ __('Cake') }}" />
                        <ul data-item_1-errors="create" class="hidden mt-2 text-xs text-red-600 space-y-1 md:text-sm"></ul>
                    </div>

                    <div>
                        <x-form-field name="item_2" />
                        <ul data-item_2-errors="create" class="hidden mt-2 text-xs text-red-600 space-y-1 md:text-sm"></ul>
                    </div>

                    <div>
                        <x-form-field name="item_3" />
                        <ul data-item_3-errors="create" class="hidden mt-2 text-xs text-red-600 space-y-1 md:text-sm"></ul>
                    </div>

                    <div>
                        <x-form-field name="item_4" />
                        <ul data-item_4-errors="create" class="hidden mt-2 text-xs text-red-600 space-y-1 md:text-sm"></ul>
                    </div>

                    <div>
                        <x-form-field name="item_5" />
                        <ul data-item_5-errors="create" class="hidden mt-2 text-xs text-red-600 space-y-1 md:text-sm"></ul>
                    </div>
                </div>
            </form>

            <div class="mt-10 modal-action space-x-5">
                <button id="closeCreateModal" class="btn border-transparent rounded-md font-semibold hover:border-[#f0997d] shadow-none">{{ __('Cancel') }}</button>
                <button onclick="createParticipant({{ json_encode($juntaPanelas->id) }})" class="btn px-5 border-none bg-[#f0997d] hover:bg-[#ee8c6d]">{{ __('Add') }}</button>
            </div>
        </div>
    </dialog>

    <dialog id="updateModal" class="modal bg-black/40">
        <div class="modal-box px-6 bg-[#fbfbfb] md:px-12">

            <form class="flex flex-col gap-y-6">
                <div>
                    <x-form-field label="{{ __('Name') }}" name="update_name" placeholder="{{ __('John') }}" :value="old('name')" required/>
                    <ul data-name-errors="create" class="hidden mt-2 text-xs text-red-600 space-y-1 md:text-sm"></ul>
                </div>

                <div class="flex flex-col gap-y-4">
                    <p class="text-sm font-semibold md:text-base">Item(s)</p>
                    <div>
                        <x-form-field name="update_item_1" placeholder="{{ __('Cake') }}" />
                        <ul data-item_1-errors="update" class="hidden mt-2 text-xs text-red-600 space-y-1 md:text-sm"></ul>
                    </div>

                    <div>
                        <x-form-field name="update_item_2" />
                        <ul data-item_2-errors="update" class="hidden mt-2 text-xs text-red-600 space-y-1 md:text-sm"></ul>
                    </div>

                    <div>
                        <x-form-field name="update_item_3" />
                        <ul data-item_3-errors="update" class="hidden mt-2 text-xs text-red-600 space-y-1 md:text-sm"></ul>
                    </div>

                    <div>
                        <x-form-field name="update_item_4" />
                        <ul data-item_4-errors="update" class="hidden mt-2 text-xs text-red-600 space-y-1 md:text-sm"></ul>
                    </div>

                    <div>
                        <x-form-field name="update_item_5" />
                        <ul data-item_5-errors="update" class="hidden mt-2 text-xs text-red-600 space-y-1 md:text-sm"></ul>
                    </div>
                </div>
            </form>

            <div class="mt-10 modal-action space-x-5">
                <button id="closeUpdateModal"  class="btn border-transparent rounded-md font-semibold hover:border-[#f0997d] shadow-none">{{ __('Cancel') }}</button>
                <button onclick="updateParticipant()" class="btn px-5 border-none bg-[#f0997d] hover:bg-[#ee8c6d]">{{ __('Update') }}</button>
            </div>
        </div>
    </dialog>

    <dialog id="deleteModal" class="modal bg-black/40">
        <div class="modal-box px-10 bg-[#fbfbfb]">
            <h1 class="text-2xl font-bold">{{ __('Delete Participant') }}</h1>
            <p class="mt-5 font-semibold">{{ __('Are you sure you want to delete this participant?') }}</p>
            <div class="mt-10 modal-action space-x-5">
                <button id="closeDeleteModal"  class="btn border-none bg-[#f0997d] hover:bg-[#ee8c6d]">{{ __('Cancel') }}</button>
                <button onclick="deleteParticipant()" class="btn btn-outline px-5 hover:bg-[#ef4c53] hover:text-white">{{ __('Delete') }}</button>
            </div>
        </div>
    </dialog>

    <script>
        const createModal = document.getElementById("createModal");

        function openCreateModal() {
            createModal.show();
        }

        $("#closeCreateModal").on("click", () => {
            createModal.close();
        });

        function createParticipant(juntaPanelasId) {
            removeErrors("create");

            $.post({
                url: `http://localhost:8000/junta-panelas/${juntaPanelasId}/participants`,
                type: "post",
                data: {
                    name: $("#name").val(),
                    item_1: $("#item_1").val(),
                    item_2: $("#item_2").val(),
                    item_3: $("#item_3").val(),
                    item_4: $("#item_4").val(),
                    item_5: $("#item_5").val()
                },
                success: function () {
                    createModal.close();
                    location.reload();
                },
                error: function (err) {
                    if (err.status === 422) {
                        showErrors(err.responseJSON.errors, "create");
                    } else {
                        console.error(err);
                    }
                }
            });
        }

        const updateModal = document.getElementById("updateModal");

        async function openUpdateModal(juntaPanelasId, participantId) {
            removeErrors("update");

            const {name, items} = await $.get(`http://localhost:8000/junta-panelas/${juntaPanelasId}/participants/${participantId}`, (data) => data);
            $("#update_name").val(name);
            $("#update_item_1").val(items[0]);
            $("#update_item_2").val(items[1]);
            $("#update_item_3").val(items[2]);
            $("#update_item_4").val(items[3]);
            $("#update_item_5").val(items[4]);

            updateModal.setAttribute("data-junta-panelas-id", juntaPanelasId);
            updateModal.setAttribute("data-participant-id", participantId);
            updateModal.show();
        }

        $("#closeUpdateModal").on("click", () => {
            updateModal.close();
        });

        function updateParticipant() {
            removeErrors("update");

            const juntaPanelasId = updateModal.getAttribute("data-junta-panelas-id");
            const participantId = updateModal.getAttribute("data-participant-id");

            $.post({
                url: `http://localhost:8000/junta-panelas/${juntaPanelasId}/participants/${participantId}`,
                type: "put",
                data: {
                    name: $("#update_name").val(),
                    item_1: $("#update_item_1").val(),
                    item_2: $("#update_item_2").val(),
                    item_3: $("#update_item_3").val(),
                    item_4: $("#update_item_4").val(),
                    item_5: $("#update_item_5").val()
                },
                success: function () {
                    createModal.close();
                    location.reload();
                },
                error: function (err) {
                    if (err.status === 422) {
                        showErrors(err.responseJSON.errors, "update");
                    } else {
                        console.error(err);
                    }
                }
            });
        }

        const deleteModal = document.getElementById("deleteModal");

        function openDeleteModal(juntaPanelasId, participantId) {
            deleteModal.setAttribute("data-junta-panelas-id", juntaPanelasId);
            deleteModal.setAttribute("data-participant-id", participantId);
            deleteModal.show();
        }

        $("#closeDeleteModal").on("click", () => {
            deleteModal.close();
        });

        function deleteParticipant() {
            const juntaPanelasId = deleteModal.getAttribute("data-junta-panelas-id");
            const participantId = deleteModal.getAttribute("data-participant-id");

            $.ajax({
                url: `http://localhost:8000/junta-panelas/${juntaPanelasId}/participants/${participantId}`,
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
        }

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
            $(`[data-name-errors=${action}]`).empty().addClass("hidden");
            $(`[data-item_1-errors=${action}]`).empty().addClass("hidden");
            $(`[data-item_2-errors=${action}]`).empty().addClass("hidden");
            $(`[data-item_3-errors=${action}]`).empty().addClass("hidden");
            $(`[data-item_4-errors=${action}]`).empty().addClass("hidden");
            $(`[data-item_5-errors=${action}]`).empty().addClass("hidden");
        }
    </script>
</x-layout>
