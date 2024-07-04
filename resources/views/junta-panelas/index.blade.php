<x-layout>
    <div class="mt-6 w-2/3 flex flex-col">
        <div id="stickyMenu" class="w-full mt-10 py-6 pl-8 sticky top-0 z-10 rounded-md bg-[#fbfbfb] drop-shadow">
            <button id="openCreateModal" class="btn px-8 border-none bg-[#f0997d] hover:bg-[#ee8c6d]">{{ __('Plan') }}</button>
        </div>

        <div class="mt-5 overflow-x-auto rounded-md bg-[#fbfbfb] px-8 py-5 shadow">
            <table class="table table-lg table-pin-cols table-fixed">
                @php $length = count($juntaPanelasList); @endphp

                @foreach($juntaPanelasList as $juntaPanelas)
                    <tr class="group hover:bg-black/5 @if($length === 1) border-b-0 @elseif($length > 1) border-b-black/15 @endif">
                        <td class="py-10">
                            <x-primary-link href="{{ route('junta-panelas.show', ['juntaPanelas' => $juntaPanelas]) }}" class="text-lg font-bold">{{ $juntaPanelas->title }}</x-primary-link>
                        </td>

                        <td>
                            <x-date :date="$juntaPanelas->date" class="text-sm" />
                        </td>

                        <td>
                            <div class="hidden items-center gap-x-3 group-hover:flex">
                                <a href="{{ route('participant.index', ['juntaPanelas' => $juntaPanelas]) }}" title="{{ __('Participants') }}" class="px-1.5 py-1.5 rounded-full hover:bg-black/5 active:bg-black/10">
                                    <x-icons.people class="size-5" />
                                </a>
                                <button onclick="openUpdateModal({{ json_encode($juntaPanelas->id) }})" title="{{ __('Edit') }}" class="openUpdateModal px-1.5 py-1.5 rounded-full hover:bg-black/5 active:bg-black/10">
                                    <x-icons.pencil class="size-5" />
                                </button>
                                <button title="{{ __('Delete') }}" class="px-1.5 py-1.5 rounded-full hover:bg-black/5 active:bg-black/10">
                                    <x-icons.trash class="size-5" />
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
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
    </div>

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

    <script>
        const createModal = document.getElementById("createModal");
        const updateModal = document.getElementById("updateModal");

        $("#openCreateModal").on("click", () => {
            createModal.show();
        });

        $("#closeCreateModal").on("click", () => {
            createModal.close();
        });

        $("#closeUpdateModal").on("click", () => {
            updateModal.close();
        });

        async function openUpdateModal(id) {
            const {title, date} = await getJuntaPanelas(id);

            $("#update_title").val(title);
            $("#update_date").val(dayjs(date).format("YYYY-MM-DD"));
            $("#update_time").val(dayjs(date).format("HH:mm"));

            updateModal.setAttribute("data-id", id);
            updateModal.show();
        }

        async function getJuntaPanelas(id) {
            let juntaPanelas;

            await $.get(`http://localhost:8000/junta-panelas/${id}`, (data) => {
                juntaPanelas = data;
            });
            return juntaPanelas;
        }

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

        function showErrors(errors, action) {
            if (errors.title) {
                $(`[data-title-errors=${action}]`)
                    .html(addErrors(errors.title))
                    .removeClass("hidden");
            }

            if (errors.date) {
                $(`[data-date-errors=${action}]`)
                    .html(addErrors(errors.date))
                    .removeClass("hidden");
            }

            if (errors.time) {
                $(`[data-time-errors=${action}]`)
                    .html(addErrors(errors.time))
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
