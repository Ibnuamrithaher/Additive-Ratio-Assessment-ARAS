@extends('layout')
@section('title', '')
@section('content')
<div class="card card-default">
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
        <h3 class="card-title">Tambah Data Siswa</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('datasiswa.store') }}" id="form_input" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter ..." required>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($datalriterias as $item)
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{ $item->description }}</label>
                            <input type="number" min="0" step="0.01" class="form-control" name={{ $item->id }} placeholder="Enter ..." required>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-default">Simpan</button>
        </div>
    </form>
</div>
@endsection
@push('js')
<script>
    $(function () {
        // Summernote
        $('#content').summernote({
            height: 300
        })
            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai"

        });
    })
</script>
@endpush
