@extends('layouts.app')
<title>Hulajnogi</title>
@section('content')

    <html>
    <head>

    </head>
    <body>

    <table class="w-full text-left transition-opacity ease-in-out duration-100">
        <thead>
        <tr class="text-black">
            <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">Nazwa</th>
            <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">Model</th>
            <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">Placowka</th>

            @if(Auth::user()->isAdmin()||Auth::user()->isEmployee())
            <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">Data dodania</th>
            @endif
        </tr>
        </thead>
        <tbody class="text-gray-500">
        @if ($hulajnogi->count() === 0)
            @for ($i = 1; $i <= 10; $i++)
                @php
                    $nazwa = "Hulajnoga $i";
                    $adres = "Model $i";
                    \App\Models\Hulajnogi::create(['Nazwa' => $nazwa, 'Model' => $adres]);
                @endphp
            @endfor
        @endif
        @foreach($hulajnogi ?? [] as $hulajnoga)
            <tr class="  hover:bg-zinc-600 hover:bg-opacity-10 transition-colors duration-300 ease-in-out">
                <td class="sm:p-3 py-2 px-1 border-b border-gray-200">
                    <div class="flex items-center">
                        {{ $hulajnoga->Nazwa }}
                    </div>
                </td>
                <td class="sm:p-3 py-2 px-1 border-b border-gray-200">
                    <div class="flex items-center">

                        {{ $hulajnoga->Model }}
                    </div>
                </td>
                <td class="sm:p-3 py-2 px-1 border-b border-gray-200">
                    <div class="flex items-center">

                        @if($hulajnoga->placowka)
                            {{ $hulajnoga->placowka->nazwa }}
                        @else
                            Brak przypisanej placówki
                        @endif
                    </div>
                </td>
                @if(Auth::user()->isAdmin()||Auth::user()->isEmployee())
                <td class="sm:p-3 py-2 px-1 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="sm:flex hidden flex-col">
                            {{$hulajnoga->updated_at->format('Y-m-d')}}
                        </div>


                        <div class="table_center">
                            <div id="dropdown{{$hulajnoga->id}}" class="drop-down">
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
                                        <li data-name="profile" class="drop-down__item" data-modal-target="editRecordModal{{$hulajnoga->id}}" data-modal-toggle="editRecordModal{{$hulajnoga->id}}">Edytuj</li>
                                        <form id="deleteForm" action="{{ route('hulajnogi.destroy', $hulajnoga->id) }}" method="POST">
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
                </td>@endif
            </tr>
            <!-- Edit modal -->
            <div id="editRecordModal{{$hulajnoga->id}}" tabindex="-1" aria-hidden="true" class="editRecordModal fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-gray-900">
                                Edytuj hulajnogę
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="editRecordModal{{$hulajnoga->id}}" data-bs-dismiss="modal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="space-y-6">
                            <form id="editForm" action="{{ route('hulajnogi.update', $hulajnoga->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="pb-6 ps-6 pe-6">
                                    <label for="edit_nazwa{{$hulajnoga->id}}" class="block mb-2 text-sm font-medium text-gray-900">Nazwa:</label>
                                    <input type="text" id="edit_nazwa{{$hulajnoga->id}}" value="{{$hulajnoga->Nazwa}}" name="nazwa" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                </div>
                                <div class="pb-6 ps-6 pe-6">
                                    <label for="edit_adres{{$hulajnoga->id}}" class="block mb-2 text-sm font-medium text-gray-900">Model:</label>
                                    <input type="text" id="edit_adres{{$hulajnoga->id}}" value="{{$hulajnoga->Model}}" name="adres" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                </div>
                                <div class="pb-6 ps-6 pe-6">
                                    <label for="placowka" class="block mb-2 text-sm font-medium text-gray-900">Placówka:</label>
                                    <select name="placowka_id" id="edit_placowka{{$hulajnoga->id}}" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                        @foreach($placowki ?? [] as $placowka)
                                            <option value="{{ $placowka->id }}" {{ $hulajnoga->placowka_id == $placowka->id ? 'selected' : '' }}>
                                                {{ $placowka->nazwa }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="pb-6 ps-6 pe-6 flex items-center justify-center pt-6 border-t border-gray-200 rounded-b">
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

    <!-- Main modal -->
    <div id="hulajnogiModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow ">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Dodaj hulajnogę
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="hulajnogiModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="space-y-6">
                    <form id="addForm" action="{{ route('hulajnogi.store') }}" method="POST">
                        @csrf
                        <div class="p-6">
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900">Nazwa</label>
                            <input type="text" id="nazwa"  name="nazwa" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                        <div class="pb-6 ps-6 pe-6">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Model</label>
                            <input type="text"  name="model" id="model"class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                        <div class="pb-6 ps-6 pe-6">
                            <label for="placowka" class="block mb-2 text-sm font-medium text-gray-900">Przypisz do placówki</label>
                            <select name="placowka_id" id="placowka" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                @foreach($placowki ?? [] as $placowka)
                                    <option value="{{ $placowka->id }}">{{ $placowka->nazwa }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="pb-6 ps-6 pe-6 flex items-center justify-center pt-6 border-t border-gray-200 rounded-b">
                            <button data-modal-hide="defaultModal" type="submit" class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Dodaj</button>
                        </div>
                    </form>
                </div>
            </div>



@endsection

</body>
    </html>

