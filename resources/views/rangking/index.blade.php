@extends('layout')
@section('title', 'Data Siswa')
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
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    {{-- <th style="width: 10px">#</th> --}}
                    <th>Nama</th>
                    @foreach ($datakriteria as $item)
                    <th>{{ $item->title }}</th>
                    @endforeach
                    <th>S<sub>i</sub></th>
                    <th>K<sub>i</sub></th>
                    <th>Rangking</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($normalisasi as $key => $item)
                <tr>
                    <td>{{ $item[count($item)-1] }}</td>
                    @for ($i = 0; $i <= count($item)-2; $i++) <td>{{ $item[$i] }}</td>
                        @endfor
                        <td>{{ $key+1 }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
