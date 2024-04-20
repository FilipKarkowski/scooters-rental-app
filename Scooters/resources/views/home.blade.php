@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (auth()->user()->isAdmin())
                        <div class="alert alert-info" role="alert">
                            {{ __('Zalogowano jako Kierownik!') }}
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">users</h5>
                                        <p class="card-text">Panel edycyjny pracownikow</p>
                                        <a href="users" class="btn btn-primary">Edytuj pracownikow</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Placowki</h5>
                                        <p class="card-text">Panel edycyjny placowek</p>
                                        <a href="placowki" class="btn btn-primary">Edytuj placowki</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif (auth()->user()->isEmployee())
                        <div class="alert alert-info" role="alert">
                            {{ __('Zalogowano jako pracownik!') }}
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">View Reports</h5>
                                        <p class="card-text">You can view reports here.</p>
                                        <a href="{{-- route('') --}}-" class="btn btn-primary">Go to Reports</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">lorem cziczum</h5>
                                        <p class="card-text">lorem cziczum</p>
                                       <a href="{{-- route('') --}}" class="btn btn-primary">lorem cziczum</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info" role="alert">
                            {{ __('Logowanie jako gosc') }}
                        </div>
                        <p>test</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
