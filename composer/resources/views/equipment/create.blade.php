@extends('layouts.app')

@section('title', 'Nové zařízení | Evidence techniky')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7 col-xl-6">
            <a href="{{ route('equipment.index') }}" class="text-decoration-none text-muted small">
                <i class="bi bi-arrow-left"></i> Zpět na seznam
            </a>
            <h1 class="h3 page-title mt-2 mb-4">Nové zařízení</h1>

            <form method="post" action="{{ route('equipment.store') }}" class="card card-body p-4">
                @include('equipment._form')
            </form>
        </div>
    </div>
@endsection
