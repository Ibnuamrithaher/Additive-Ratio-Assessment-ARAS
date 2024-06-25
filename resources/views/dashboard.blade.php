@extends('layout')
@section('title', 'Dashboard')
@section('content')
<div class="card">

    <div class="card-header">
        @if (session()->has('errors'))
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <strong>{{ $error }}</strong>
                @endforeach
                @endif
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @elseif (session()->has('success'))
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
    </div>
    <div class="card-body table-responsive p-0">
        <div class="text-center">
            <img src="{{ asset('Logo MTS Darussalam.png') }}" alt="MTS Darussalam">
        </div>
        <div class="text-center">
            @foreach ($normalisasi as $key => $item)
                @if ($item[count($item)-1] == auth()->user()->name)
                <h1>{{ $item[count($item)-1] }} Rangking {{ $key+1 }} dari {{ count($normalisasi) }} Siswa</h1>
                @endif
            @endforeach
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">

    </div>
</div>
@endsection
@push('js')
<script>

</script>
@endpush
