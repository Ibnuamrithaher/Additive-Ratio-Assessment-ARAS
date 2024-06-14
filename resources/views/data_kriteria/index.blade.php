@extends('layout')
@section('title', 'Data Kriteria')
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
        <a href="{{ route('datakriteria.create') }}" class="btn btn-default">Tambah + </a>
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
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Kriteria</th>
                    <th>Deskripsi</th>
                    <th>Bobot</th>
                    <th>Sifat</th>
                    <th style="width: 40px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datakriteria as $key => $item)
                <tr>
                    <td>{{ $key+1 }}.</td>
                    <td>{{ $item->title }}</td>
                    <td>
                        {{ $item->description }}
                    </td>
                    <td>
                        {{ $item->weight }}
                    </td>
                    <td>
                        {{ $item->type }}
                    </td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('datakriteria.edit',$item->id) }}" class="btn btn-default btn-sm"><i
                                    class="fas fa-pencil-alt"></i></a>
                            <form action="{{ route('datakriteria.destroy',$item->id) }}" method="POST"
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
        {{ $datakriteria->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>


<div class="modal fade" id="modal-create">
    <div class="modal-dialog modal-create">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" class="form-control" placeholder="Enter ...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-default">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
@push('js')
<script>

</script>
@endpush
