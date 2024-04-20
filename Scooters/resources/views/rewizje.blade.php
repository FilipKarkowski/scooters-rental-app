@extends('layouts.app')
<title>Rewizje</title>
@section('content')

<table class="w-full text-left transition-opacity ease-in-out duration-100">
    <thead>
    <tr class="text-black">
        <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">Data dodania</th>
        <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">Czy uszkodzona</th>
        <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">Opis</th>
        <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">Koszt uszkodzeń</th>
        <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">Hulajnoga</th>
        <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200"></th>



    </tr>
    </thead>
    <tbody class="text-gray-500">
    @foreach($rewizje as $rewizja)

        <tr class="  hover:bg-zinc-600 hover:bg-opacity-10 transition-colors duration-300 ease-in-out">
            <td class="sm:p-3 py-2 px-1 border-b border-gray-200">
                <div class="flex items-center">
                    {{$rewizja->Data}}
                </div>
            </td>
            <td class="sm:p-3 py-2 px-1 border-b border-gray-200">
                <div class="flex items-center">

                    {{$rewizja->Czy_uszkodzona}}
                </div>
            </td>

            <td class="sm:p-3 py-2 px-1 border-b border-gray-200">
                <div class="flex items-center">

                    {{$rewizja->Opis}}
                </div>
            </td>
            <td class="sm:p-3 py-2 px-1 border-b border-gray-200">
                <div class="flex items-center">
                    {{$rewizja->Koszt_uszkodzen}}
                </div>
            </td>
            <td class="sm:p-3 py-2 px-1 border-b border-gray-200">
                <div class="flex items-center">
                    @if($rewizja->hulajnoga)
                        {{ $rewizja->hulajnoga->Nazwa }}
                    @else
                        Brak przypisanej hulajnogi
                    @endif
                </div>
            </td>
            <td class="sm:p-3 py-2 px-1 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="sm:flex hidden flex-col">
                    </div>


                    <div class="table_center">
                        <div id="dropdown{{$rewizja->id}}" class="drop-down">
                            <div class="drop-down__button">
                                        <span class="drop-down__name w-8 h-8 inline-flex items-center justify-center text-gray-400 ml-auto">
                                            <svg viewBox="0 0 24 24" class="w-5" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="19" cy="12" r="1"></circle>
                                        <circle cx="5" cy="12" r="1"></circle>
                                    </svg></span>
                            </div>
                            <div class="drop-down__menu-box">
                                <ul class="drop-down__menu">
                                    <li data-name="profile" class="drop-down__item" data-modal-target="editRecordModal{{$rewizja->id}}" data-modal-toggle="editRecordModal{{$rewizja->id}}">Edytuj</li>
                                    <form id="deleteForm" action="{{ route('rewizje.destroy', $rewizja->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="flex items-center">
                                            <button type="submit" class="w-full">
                                                <li data-name="dashboard" class="drop-down__item">
                                                    Usuń
                                                </li>
                                            </button>
                                        </div>
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <!-- Edit modal -->
        <div id="editRecordModal{{$rewizja->id}}" tabindex="-1" aria-hidden="true" class="editRecordModal fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Edytuj rewizję
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="editRecordModal{{$rewizja->id}}" data-bs-dismiss="modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="space-y-6">
                        <form id="editForm" action="{{ route('rewizje.update', $rewizja->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="p-6">
                                <label for="edit_nazwa{{$rewizja->id}}" class="block mb-2 text-sm font-medium text-gray-900">Data</label>
                                <input type="date" id="edit_nazwa{{$rewizja->id}}" value="{{$rewizja->Data}}" name="data" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </div>
                            <div class="pb-6 ps-6 pe-6 flex items-center">
                                <label for="edit_adres{{$rewizja->id}}" class="mr-4 text-sm font-medium text-gray-900">Czy uszkodzona</label>
                                <input type="checkbox" id="edit_adres{{$rewizja->id}}" value="{{$rewizja->Czy_uszkodzona ? 'checked' : ''}}" name="czy_uszkodzona" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                            </div>

                            <div class="pb-6 ps-6 pe-6">
                                <label for="edit_nazwa{{$rewizja->id}}" class="block mb-2 text-sm font-medium text-gray-900">Opis</label>
                                <textarea type="text" id="edit_nazwa{{$rewizja->id}}" value="{{$rewizja->Opis}}" name="opis" class="form-controlform-control  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" rows="3" required></textarea>
                            </div>

                            <div class="pb-6 ps-6 pe-6">
                                <label for="edit_nazwa{{$rewizja->id}}" class="block mb-2 text-sm font-medium text-gray-900">Koszt uszkodzeń</label>
                                <input type="number" id="edit_nazwa{{$rewizja->id}}" value="{{$rewizja->Koszt_uszkodzen}}" name="koszt_uszkodzen" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </div>

                            <div class="pb-6 ps-6 pe-6">
                                <label for="edit_nazwa{{$rewizja->id}}" class="block mb-2 text-sm font-medium text-gray-900">Przypisz do hulajnogi</label>
                                <select name="hulajnoga_id" id="edit_rewizja{{$rewizja->id}}" class="form-control   bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                    @foreach($hulajnogi ?? [] as $hulajnoga)
                                        <option value="{{ $hulajnoga->id }}" {{ $rewizja->hulajnoga_id == $hulajnoga->id ? 'selected' : '' }}>
                                            {{ $hulajnoga->Nazwa }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="p-6 flex items-center justify-center pt-6 border-t border-gray-200 rounded-b">
                                <button type="submit" class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edytuj</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
    <script>
        $(document).ready(function() {
            $('[id^="dropdown"]').click(function() {
                var dropdownId = $(this).attr('id');

                // Check if the clicked dropdown is already active
                var isActive = $(this).hasClass('drop-down--active');

                // Close all dropdowns
                $('.drop-down').removeClass('drop-down--active');

                // Open the clicked dropdown if it was not active
                if (!isActive) {
                    $(this).addClass('drop-down--active');
                }
            });
        });
    </script>
    </tbody>
</table>

</div>
</div>

<div id="addRewizje" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Dodaj rewizję
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="addRewizje">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="space-y-1">
                <form id="addForm" action="{{ route('rewizje.store') }}" method="POST">
                    @csrf
                    <div class="p-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900">Data</label>
                        <input type="date" class="form-control form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="data" name="data" required>
                    </div>
                    <div class="pb-6 ps-6 pe-6 flex items-center">
                        <label for="czy_uszkodzona" class="mr-4 text-sm font-medium text-gray-900">Czy uszkodzona</label>
                        <input type="checkbox" class="form-check-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" id="czy_uszkodzona" name="czy_uszkodzona">
                    </div>

                    <div class="pb-6 ps-6 pe-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900">Opis</label>
                        <textarea class="form-control  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="opis" name="opis" rows="3" required></textarea>
                    </div>
                    <div class="pb-6 ps-6 pe-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900">Koszt uszkodzeń</label>
                        <input type="number" class="form-control  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="koszt_uszkodzen" name="koszt_uszkodzen" required>
                    </div>
                    <div class="pb-6 ps-6 pe-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900">Przypisz do hulajnogi</label>
                        <select name="hulajnoga_id" id="hulajnoga" class="form-control  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            @foreach($hulajnogi ?? [] as $hulajnoga)
                                <option value="{{ $hulajnoga->id }}">{{ $hulajnoga->Nazwa }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class=" p-6 flex items-center justify-center pt-6 border-t border-gray-200 rounded-b">
                        <button data-modal-hide="defaultModal" type="submit" class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Dodaj</button>
                    </div>
                </form>
            </div>
        </div>
@endsection
