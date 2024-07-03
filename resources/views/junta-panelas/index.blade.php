<x-layout>
    <div class="mt-6 w-2/3 flex flex-col">
        <div id="stickyMenu" class="w-full mt-10 py-6 pl-8 sticky top-0 z-10 rounded-md bg-[#fbfbfb] drop-shadow">
            <button id="openCreateModal" class="btn px-8 border-none bg-[#f0997d] hover:bg-[#ee8c6d]">{{ __('Plan') }}</button>
        </div>

        <div class="mt-5 overflow-x-auto rounded-md bg-[#fbfbfb] px-8 py-5 shadow">
            <table class="table table-lg table-pin-cols table-fixed">
                @foreach($juntaPanelasList as $juntaPanelas)
                    <tr class="group hover:bg-black/5 @if(count($juntaPanelasList) === 1) border-b-0 @endif">
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
                                <button title="{{ __('Edit') }}" class="px-1.5 py-1.5 rounded-full hover:bg-black/5 active:bg-black/10">
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
                        <x-form-field label="{{ __('Event Title') }}" name="title" placeholder="{{ __('Christmas Party') }}" :value="old('title')"/>
                        <ul id="titleErrors" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                    </div>

                    <div>
                        <x-form-field label="{{ __('Date') }}" type="date" name="date" :min="now()->addDay()->format('Y-m-d')" :value="old('date')"/>
                        <ul id="dateErrors" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                    </div>

                    <div>
                        <x-form-field label="{{ __('Time') }}" type="time" name="time" :value="old('time')"/>
                        <ul id="timeErrors" class="hidden mt-2 text-sm text-red-600 space-y-1"></ul>
                    </div>
                </form>

                <div class="mt-10 modal-action space-x-5">
                    <button id="closeCreateModal"  class="btn border-transparent rounded-md font-semibold hover:border-[#f0997d] shadow-none">{{ __('Cancel') }}</button>
                    <button id="createButton" class="btn px-5 border-none bg-[#f0997d] hover:bg-[#ee8c6d]">{{ __('Plan') }}</button>
                </div>
            </div>
        </dialog>
    </div>

    <script>
        window.onload = function () {
            const createModal = document.getElementById("createModal");

            $("#openCreateModal").on("click", () => {
                createModal.show();
            });

            $("#closeCreateModal").on("click", () => {
                createModal.close();
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#createButton").on("click", () => {
                removeErrors();

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
                            showErrors(err.responseJSON.errors);
                        } else {
                            console.log(err);
                        }
                    }
                });
            })

            function showErrors(errors) {
                const titleErrors = addErrors(errors.title);
                const dateErrors = addErrors(errors.date);
                const timeErrors = addErrors(errors.time);

                if (titleErrors) $("#titleErrors").html(titleErrors).removeClass("hidden");
                if (dateErrors) $("#dateErrors").html(dateErrors).removeClass("hidden");
                if (timeErrors) $("#timeErrors").html(timeErrors).removeClass("hidden");
            }

            function addErrors(fieldErrors) {
                let errors = "";

                for (const error of fieldErrors) {
                    errors += `<li>${error}</li>`;
                }
                return errors;
            }

            function removeErrors() {
                $("#titleErrors").empty().addClass("hidden");
                $("#dateErrors").empty().addClass("hidden");
                $("#timeErrors").empty().addClass("hidden");
            }
        };
    </script>
</x-layout>
