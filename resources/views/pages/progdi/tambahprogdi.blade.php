@extends('layouts.main')

@section('content')

<div class="layout-px-spacing">

    <div class="row layout-top-spacing">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <a href="{{route('progdi.index')}}" class="btn btn-dark btn-sm">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{route('progdi.store')}}" method="post">
                        @csrf
                        <div class="row mb-1">
                            <div class="col-lg-3">
                                <label for="form-control">Kode progdi</label>
                                <input type="text" class="form-control" name="kode">
                                @if($errors->has('kode'))
                                <div class="error" style="color: red; display:block;">
                                    {{ $errors->first('kode') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-lg-3">
                                <label for="form-control">Nama studi</label>
                                <input type="text" class="form-control" name="studi">
                                @if($errors->has('studi'))
                                <div class="error" style="color: red; display:block;">
                                    {{ $errors->first('studi') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-lg-3">
                                <label for="form-control">Jenjang studi</label>
                                <input type="text" class="form-control" name="jenjang_studi">
                                @if($errors->has('jenjang_studi'))
                                <div class="error" style="color: red; display:block;">
                                    {{ $errors->first('jenjang_studi') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-lg-3">
                                <label for="form-control">Singkatan studi</label>
                                <input type="text" class="form-control" name="singkatan_studi">
                                @if($errors->has('singkatan_studi'))
                                <div class="error" style="color: red; display:block;">
                                    {{ $errors->first('singkatan_studi') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 d-flex justify-content-end">
                                <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection