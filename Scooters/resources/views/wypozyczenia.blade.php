@extends('layouts.app')
<title>Wypożyczenia</title>
@section('content')
        <table class="w-full text-left transition-opacity ease-in-out duration-100">
            <thead>
            <tr class="text-black">
                <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">Data rozpoczęcia</th>
                <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">Data zakończenia</th>
                <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">Klient</th>
                <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">Hulajnogi</th>
                <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">Pracownik</th>
                <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200">Placówka</th>

            </tr>
            </thead>
            <tbody class="text-gray-500">
            @foreach($wypozyczenia as $wypozyczenie)

                <tr class="  hover:bg-zinc-600 hover:bg-opacity-10 transition-colors duration-300 ease-in-out">
                    <td class="sm:p-3 py-2 px-1 border-b border-gray-200">
                        <div class="flex items-center">
                            {{$wypozyczenie->data_wypozyczenia}}
                        </div>
                    </td>
                    <td class="sm:p-3 py-2 px-1 border-b border-gray-200">
                        <div class="flex items-center">
                            {{$wypozyczenie->data_zakonczenia}}
                        </div>
                    </td>
                    <td class="sm:p-3 py-2 px-1 border-b border-gray-200">
                        <div class="flex items-center">
                            {{$wypozyczenie->klient->name}}
                        </div>
                    </td>
                    <td class="sm:p-3 py-2 px-1 border-b border-gray-200">
                        <div class="flex items-center">
                            @if($wypozyczenie->hulajnogi->count()>1)
                                <ul class="list-disc">
                                    @else
                                        <ul>
                            @endif
                                @foreach ($wypozyczenie->hulajnogi as $hul)
                                    <li>{{ $hul->Nazwa }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </td>
                    <td class="sm:p-3 py-2 px-1 border-b border-gray-200">
                        <div class="flex items-center">
                            {{$wypozyczenie->pracownik->name}}
                        </div>
                    </td>
                    <td class="sm:p-3 py-2 px-1 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="sm:flex hidden flex-col">
                                @if ($wypozyczenie->pracownik->placowka)
                                    {{ $wypozyczenie->pracownik->placowka->nazwa }}
                                @else
                                    Brak przypisanej placówki do pracownika.
                                @endif
                            </div>


                            <div class="table_center">
                                <div id="dropdown{{$wypozyczenie->id}}" class="drop-down">
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
                                            <li data-name="profile" class="drop-down__item" data-modal-target="editRecordModal{{$wypozyczenie->id}}" data-modal-toggle="editRecordModal{{$wypozyczenie->id}}">Edytuj</li>
                                            <form id="deleteForm" action="{{ route('wypozyczenia.destroy', $wypozyczenie->id) }}" method="POST">
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
                <div id="editRecordModal{{$wypozyczenie->id}}" tabindex="-1" aria-hidden="true" class="editRecordModal fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <div class="flex items-start justify-between p-4 border-b rounded-t">
                                <h3 class="text-xl font-semibold text-gray-900">
                                    Edytuj wypożyczenie
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="editRecordModal{{$wypozyczenie->id}}" data-bs-dismiss="modal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Zamknij</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="space-y-6">
                                <form id="editForm" action="{{ route('wypozyczenia.update', $wypozyczenie->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="p-6">
                                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900">Klient:</label>
                                        <select name="klient_id" id="klient_id" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            @foreach($klienci as $klient)
                                                <option value="{{ $klient->id }}" {{ $klient->id == $wypozyczenie->klient_id ? 'selected' : '' }}>
                                                    {{ $klient->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="pb-6 ps-6 pe-6">
                                        <label for="" class="block mb-2 text-sm font-medium text-gray-900">Data rozpoczęcia:</label>
                                        <input class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="text" id="datetimepicker" name="data_wyp" placeholder="Wybierz datę rozpoczęcia..." value="{{ $wypozyczenie->data_wypozyczenia }}"/>
                                        <script>
                                            flatpickr("#datetimepicker",{
                                                "locale":"pl",
                                                time_24hr: true,
                                                enableTime:true,
                                                dateFormat:"Y-m-d H:i",
                                                onChange: function(selectedDates, dateStr) {
                                                    const inputElement = document.querySelector('input[name="data_wyp"]');
                                                    inputElement.value = dateStr;
                                                }
                                            });
                                        </script>
                                    </div>
                                    <div class="pb-6 ps-6 pe-6">
                                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Data zakończenia:</label>
                                        <input class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="text" id="datetimepicker2" name="data_zak" placeholder="Wybierz datę zakończenia..." value="{{ $wypozyczenie->data_zakonczenia }}"/>
                                        <script>
                                            flatpickr("#datetimepicker2", {
                                                "locale": "pl",
                                                time_24hr: true,
                                                enableTime: true,
                                                dateFormat: "Y-m-d H:i:s",
                                                onChange: function(selectedDates, dateStr) {
                                                    const inputElement = document.querySelector('input[name="data_zak"]');
                                                    inputElement.value = dateStr;
                                                }
                                            });
                                        </script>
                                    </div>
                                    <div class="pb-6 ps-6 pe-6">
                                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Dostępne hulajnogi:</label>
                                        @foreach($hulajnogi as $hulajnoga)
                                            @if($hulajnoga->zajeta==0 || $hulajnoga->zajeta==1 && in_array($hulajnoga->id, $wypozyczenie->hulajnogi->pluck('id')->toArray()))
                                                <div>
                                                    <input id="check{{$hulajnoga->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" type="checkbox" name="hulajnogi[]" value="{{ $hulajnoga->id }}" multiple
                                                        {{ in_array($hulajnoga->id, $wypozyczenie->hulajnogi->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                    <label for="check{{$hulajnoga->id}}" class="ml-2 text-sm font-medium text-gray-900">{{ $hulajnoga->Nazwa }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class=" p-6 flex items-center justify-center pt-6 border-t border-gray-200 rounded-b">
                                        <button data-modal-hide="editWypozyczenie" type="submit" class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Zapisz</button>
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
        <div id="addWypozyczenie" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Dodaj wypożyczenie
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="addWypozyczenie">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Zamknij</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="space-y-6">
                        <form id="addForm" action="{{ route('wypozyczenia.store') }}" method="POST">
                            @csrf
                            <p class="px-6 pt-6 block mb-2 text-sm font-medium text-gray-900">Typ wypożyczenia:</p>
                            <div class="ps-6 pe-6 flex items-center mb-4">
                                <input onclick="fun1()" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300" type="radio" id="nowe" name="typ_wyp" value="nowe" checked>
                                <label onclick="fun1()" class="block ml-2 text-sm font-medium text-gray-900" for="nowe">Nowe</label>
                            </div>

                            <div class="pb-6 ps-6 pe-6 flex items-center">
                                <input onclick="fun2()" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300" type="radio" id="rezerwacja" name="typ_wyp" value="rezerwacja">
                                <label onclick="fun2()" class="block ml-2 text-sm font-medium text-gray-900" for="rezerwacja">Z rezerwacji</label>
                            </div>

                            <div class="schowaj pb-6 ps-6 pe-6">
                                <label for="klient_id" class="block mb-2 text-sm font-medium text-gray-900">Klient:</label>
                                <select name="klient_id" id="klient_id" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    @foreach($klienci as $klient)
                                        <option value="{{ $klient->id }}">{{ $klient->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="schowaj pb-6 ps-6 pe-6">
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Data rozpoczęcia:</label>
                                <input type="text" id="datetimepicker" name="data_wyp" placeholder="Wybierz datę rozpoczęcia..." class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                                <script>
                                    flatpickr("#datetimepicker",{
                                        "locale":"pl",
                                        time_24hr: true,
                                        enableTime:true,
                                        dateFormat:"Y-m-d H:i",
                                        onChange: function(selectedDates, dateStr) {
                                            const inputElement = document.querySelector('input[name="data_wyp"]');
                                            inputElement.value = dateStr;
                                        }});
                                </script>
                            </div>
                            <div class="schowaj pb-6 ps-6 pe-6">
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Data zakończenia:</label>
                                <input type="text" id="datetimepicker2" name="data_zak" placeholder="Wybierz datę zakończenia..." class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                                <script>
                                    flatpickr("#datetimepicker2", {
                                        "locale": "pl",
                                        time_24hr: true,
                                        enableTime: true,
                                        dateFormat: "Y-m-d H:i:s",
                                        onChange: function(selectedDates, dateStr) {
                                            const inputElement = document.querySelector('input[name="data_zak"]');
                                            inputElement.value = dateStr;
                                        }
                                    });
                                </script>
                            </div>
                            <div class="schowaj pb-6 ps-6 pe-6">
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Dostępne hulajnogi:</label>
                                @foreach($hulajnogi as $hulajnoga)
                                    @if($hulajnoga->zajeta==0)
                                        <div>
                                            <input id="pcheck{{$hulajnoga->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" type="checkbox" name="hulajnogi[]" value="{{ $hulajnoga->id }}" multiple>
                                            <label for="pcheck{{$hulajnoga->id}}" class="ml-2 text-sm font-medium text-gray-900">{{ $hulajnoga->Nazwa }}</label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="schowaj2 hidden pb-6 ps-6 pe-6">
                                <label for="rezerwacja_id" class="block mb-2 text-sm font-medium text-gray-900">Rezerwacja:</label>
                                <select name="rezerwacja_id" id="rezerwacja_id" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    @foreach($rezerwacje as $rezerwacja)
                                        <option value="{{ $rezerwacja->id }}">Rezerwacja #{{ $rezerwacja->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" p-6 flex items-center justify-center pt-6 border-t border-gray-200 rounded-b">
                                <button data-modal-hide="addWypozyczenie" type="submit" class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Dodaj</button>
                            </div>
                        </form>
                    </div>
                </div>
    <script>
        function fun1()
        {
            const zmiany=document.getElementsByClassName('schowaj');
            const zmiany2=document.getElementsByClassName('schowaj2');
            for (let i=0; i< zmiany.length; i++)
            {
                zmiany[i].style.display='block';
            }

            for (let i=0; i< zmiany2.length; i++)
            {
                zmiany2[i].style.display='none';
            }
        }

        function fun2()
        {
            const zmiany=document.getElementsByClassName('schowaj');
            const zmiany2=document.getElementsByClassName('schowaj2');
            for (let i=0; i< zmiany.length; i++)
            {
                zmiany[i].style.display='none';
            }

            for (let i=0; i< zmiany2.length; i++)
            {
                zmiany2[i].style.display='block';
            }
        }
    </script>
@endsection
