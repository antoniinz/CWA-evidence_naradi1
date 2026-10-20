@extends('layouts.app')
@section('content')
    <h1 class="h3 mb-3">Nové zařízení</h1>
    <form method="post" action="{{ route('equipment.store') }}" class="card card-body">
        @include('equipment._form')
    </form>
@endsection
