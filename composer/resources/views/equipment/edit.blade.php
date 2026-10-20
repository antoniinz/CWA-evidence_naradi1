@extends('layouts.app')
@section('content')
    <h1 class="h3 mb-3">Upravit zařízení</h1>
    <form method="post" action="{{ route('equipment.update', $equipment) }}" class="card card-body">
        @method('PUT')
        @include('equipment._form')
    </form>
@endsection
