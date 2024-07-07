<x-layout>
    <div class="max-w-3xl flex flex-col basis-full gap-y-8">
        <section class="flex flex-col gap-y-10">
            <div class="text-center space-y-3">
                <h1 class="text-2xl font-bold">{{ $juntaPanelas->title }}</h1>
                <x-date :date="$juntaPanelas->date" class="block text-md" />
            </div>
            <h2 class="self-center text-2xl">{{ __('Participants') }}</h2>

            <div class="w-full mt-10 py-6 pl-8 sticky top-0 z-10 rounded-md bg-[#fbfbfb] drop-shadow">
                <button id="openCreateModal" class="btn btn-sm px-5 border-none bg-[#f0997d] hover:bg-[#ee8c6d]">{{ __('Add') }}</button>
            </div>

            <div class="overflow-x-auto rounded-md bg-[#fbfbfb] px-8 py-5 shadow">
                <table class="table table-lg table-fixed">
                    @foreach($juntaPanelas->participants->sortBy('name') as $participant)

                        @php $length = count($juntaPanelas->participants); @endphp
                        <tr class="group hover:bg-black/5 @if($length === 1) border-b-0 @elseif($length > 1) border-b-black/15 @endif">
                            <td class="py-5">
                                <h2 class="font-bold text-black/50">{{ $participant->name }}</h2>
                            </td>

                            <td>
                                <p class="text-sm font-semibold text-black/50">{{ implode(' · ', $participant->items) }}</p>
                            </td>

                            <td>
                                <div class="hidden items-center gap-x-2 group-hover:flex">
                                    <button onclick="openUpdateModal({{ json_encode($juntaPanelas->id) }}, {{ json_encode($participant->id) }})" title="{{ __('Edit') }}" class="px-1.5 py-1.5 rounded-full hover:bg-black/5 active:bg-black/10">
                                        <x-icons.pencil class="size-5" />
                                    </button>
                                    <button onclick="openDeleteModal({{ json_encode($juntaPanelas->id) }}, {{ json_encode($participant->id) }})" title="{{ __('Delete') }}" class="px-1.5 py-1.5 rounded-full hover:bg-black/5 active:bg-black/10">
                                        <x-icons.trash class="size-5" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </section>
    </div>

    <dialog id="createModal" class="modal bg-black/40">
        <div class="modal-box px-12 bg-[#fbfbfb]">

            <form class="flex flex-col gap-y-6">
                <div>
                    <x-form-field label="{{ __('Name') }}" name="name" id="name" placeholder="{{ __('John') }}" :value="old('name')" required/>
                    <ul data-name-errors="create" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                </div>

                <div class="flex flex-col gap-y-4">
                    <p class="font-semibold">Item(s)</p>
                    <div>
                        <x-form-field name="item_1" placeholder="{{ __('Cake') }}" />
                        <ul data-item_1-errors="create" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                    </div>

                    <div>
                        <x-form-field name="item_2" />
                        <ul data-item_2-errors="create" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                    </div>

                    <div>
                        <x-form-field name="item_3" />
                        <ul data-item_3-errors="create" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                    </div>

                    <div>
                        <x-form-field name="item_4" />
                        <ul data-item_4-errors="create" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                    </div>

                    <div>
                        <x-form-field name="item_5" />
                        <ul data-item_5-errors="create" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
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
        <div class="modal-box px-12 bg-[#fbfbfb]">

            <form class="flex flex-col gap-y-6">
                <div>
                    <x-form-field label="{{ __('Name') }}" name="update_name" placeholder="{{ __('John') }}" :value="old('name')" required/>
                    <ul data-name-errors="create" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                </div>

                <div class="flex flex-col gap-y-4">
                    <p class="font-semibold">Item(s)</p>
                    <div>
                        <x-form-field name="update_item_1" placeholder="{{ __('Cake') }}" />
                        <ul data-item_1-errors="update" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                    </div>

                    <div>
                        <x-form-field name="update_item_2" />
                        <ul data-item_2-errors="update" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                    </div>

                    <div>
                        <x-form-field name="update_item_3" />
                        <ul data-item_3-errors="update" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                    </div>

                    <div>
                        <x-form-field name="update_item_4" />
                        <ul data-item_4-errors="update" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                    </div>

                    <div>
                        <x-form-field name="update_item_5" />
                        <ul data-item_5-errors="update" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
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

        $("#openCreateModal").on("click", () => {
            createModal.show();
        });

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
