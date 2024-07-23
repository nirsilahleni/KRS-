@extends('layouts.guest')
@section('content')
    @include('layouts.partials.hero', ['title' => 'Unduh Dokumen KRS'])
    <section class="row d-flex justify-content-center">
        <div class="col-8">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
    </section>

    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
@endsection
