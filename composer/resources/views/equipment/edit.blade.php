@extends('layouts.app')

@section('title', 'Upravit zařízení | Evidence techniky')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7 col-xl-6">
            <a href="{{ route('equipment.show', $equipment) }}" class="text-decoration-none text-muted small">
                <i class="bi bi-arrow-left"></i> Zpět na detail
            </a>
            <h1 class="h3 page-title mt-2 mb-4">Upravit zařízení</h1>

            <form method="post" action="{{ route('equipment.update', $equipment) }}" class="card card-body p-4">
                @method('PUT')
                @include('equipment._form')
            </form>
        </div>
    </div>
@endsection
