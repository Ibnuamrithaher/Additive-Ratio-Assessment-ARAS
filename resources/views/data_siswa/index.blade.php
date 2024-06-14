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
        {{-- <h3 class="card-title">Bordered Table</h3> --}}
        <a href="{{ route('datasiswa.create') }}" class="btn btn-default">Tambah + </a>
        <div class="card-tools my-2">
            <form action="">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama</th>
                    @foreach ($datalriterias as $datalriteria)
                        <th>{{ $datalriteria->description }} ({{ $datalriteria->title }})</th>
                    @endforeach
                    <th style="width: 40px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_siswa as $key => $item)
                <tr>
                    <td>{{ $key+1 }}.</td>
                    <td>{{ $item->name }}</td>
                    @foreach ($item->data_kriteria as $data_kriteria)
                        <th>{{ $data_kriteria->pivot->value }}</th>
                    @endforeach
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('datasiswa.edit',$item->id) }}" class="btn btn-default btn-sm"><i
                                    class="fas fa-pencil-alt"></i></a>
                            <form action="{{ route('datasiswa.destroy',$item->id) }}" method="POST"
                                onclick="return confirm('Apa anda ingin mengahapus data ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-default btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- /.card-body -->
    <div class="card-footer clearfix">
        {{ $data_siswa->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>

@endsection
@push('js')
<script>

</script>
@endpush
