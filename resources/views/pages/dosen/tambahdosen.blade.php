@extends('layouts.main')

@section('content')

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content">
                    <a href="{{route('dosen.index')}}" class="btn btn-dark btn-sm">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{route('dosen.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <label for="form-control">Progdi</label>
                                <select name="progdi" class="form-control">
                                    <option value="">Pilih salah satu</option>
                                    @foreach($progdi as $key => $value)
                                    <option value="{{$value->id}}">{{$value->nama_studi}} | <b>{{$value->singkatan_studi}}</b></option>
                                    @endforeach
                                </select>
                                @if($errors->has('progdi'))
                                <div class="error" style="color: red; display:block;">
                                    {{ $errors->first('progdi') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-lg-4">
                                <label for="form-control">kelas</label>
                                <select class="form-control" data-live-search="true" name="kelas">
                                    <option value="">Pilih salah satu</option>
                                    @foreach($kelas as $key => $value)
                                    <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                </select>
                                @error('kelas')
                                <div class="error" style="color: red; display:block;">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- <div class="col-lg-4">
                                <label for="form-control">Progdi 2</label>
                                <select name="progdi" class="form-control">
                                    <option value="">Pilih salah satu</option>
                                    @foreach($progdi as $key => $value)
                                    <option value="{{$value->id}}">{{$value->nama_studi}} | <b>{{$value->singkatan_studi}}</b></option>
                                    @endforeach
                                </select>
                                @if($errors->has('progdi'))
                                <div class="error" style="color: red; display:block;">
                                    {{ $errors->first('progdi') }}
                                </div>
                                @endif
                            </div> -->
                            <!-- <div class="col-lg-4">
                                <label for="form-control">Progdi</label>
                                <select name="progdi[]" class="form-control" multiple>
                                    <option value="">Pilih salah satu</option>
                                    @foreach($progdi as $key => $value)
                                    <option value="{{$value->id}}">{{$value->nama_studi}} | <b>{{$value->singkatan_studi}}</b></option>
                                    @endforeach
                                </select>
                                @if($errors->has('progdi'))
                                <div class="error" style="color: red; display:block;">
                                    {{ $errors->first('progdi') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-lg-4">
                                <label for="form-control">Data yang Dipilih</label>
                                <label id="selectedProgdis"></label>
                            </div> -->
                            <div class="col-lg-4">
                                <label for="form-control">NUPTK</label>
                                <input type="text" class="form-control" name="nidn">
                                @if($errors->has('nidn'))
                                <div class="error" style="color: red; display:block;">
                                    {{ $errors->first('nidn') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-1">
                        <div class="col-lg-4">
                                <label for="form-control">Nama Guru</label>
                                <input type="text" class="form-control" name="dosen">
                                @if($errors->has('dosen'))
                                <div class="error" style="color: red; display:block;">
                                    {{ $errors->first('dosen') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-lg-4">
                                <label for="form-control">Jenis kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="">Pilih salah satu</option>
                                    <option value="1">Laki-laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                                @if($errors->has('jenis_kelamin'))
                                <div class="error" style="color: red; display:block;">
                                    {{ $errors->first('jenis_kelamin') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-lg-4">
                                <label for="pendidikan_tertinggi">Pendidikan tertinggi</label>
                                <select class="form-control" name="pendidikan_tertinggi">
                                    <option value="">Pilih pendidikan tertinggi</option>
                                    <option value="SD">Tamatan SD</option>
                                    <option value="SMP">Tamatan SMP</option>
                                    <option value="SMA/SMK">Tamatan SMA/SMK</option>
                                    <option value="D1">Diploma 1 (D1)</option>
                                    <option value="D2">Diploma 2 (D2)</option>
                                    <option value="D3">Diploma 3 (D3)</option>
                                    <option value="D4">Diploma 4 (D4)</option>
                                    <option value="S1">Sarjana (S1)</option>
                                    <option value="S2">Magister (S2)</option>
                                    <option value="S3">Doktor (S3)</option>
                                </select>
                                @if($errors->has('pendidikan_tertinggi'))
                                <div class="error" style="color: red; display:block;">
                                    {{ $errors->first('pendidikan_tertinggi') }}
                                </div>
                                @endif
                            </div>

                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <label for="form-control">Ikatan kerja</label>
                                <input type="text" class="form-control" name="ikatan_kerja">
                                @if($errors->has('ikatan_kerja'))
                                <div class="error" style="color: red; display:block;">
                                    {{ $errors->first('ikatan_kerja') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-lg-4">
                                <label for="form-control">Status</label>
                                <input type="text" class="form-control" name="status">
                                @if($errors->has('status'))
                                <div class="error" style="color: red; display:block;">
                                    {{ $errors->first('status') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-lg-4">
                                <label for="form-control">Jabatan fungsional</label>
                                <input type="text" class="form-control" name="jabatan_fungsional">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-12">
                                <div class="custom-file-container" data-upload-id="myFirstImage">
                                    <label>Foto <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file">
                                        <input type="file" class="custom-file-container__custom-file__custom-file-input" name="foto" accept="image/*">
                                        <!-- <input type="hidden" name="MAX_FILE_SIZE" value="10485760" /> -->
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        <span class="custom-file-container__custom-file__custom-file-control custom-file-container__custom-file__custom-file-control--browse">Browse</span>
                                    </label>
                                    <div class="custom-file-container__image-preview" id="imagePreview">
                                        <p>Nama File: <span id="fileName">Tidak ada file yang dipilih</span></p>
                                    </div>
                                </div>
                                @if($errors->has('foto'))
                                <div class="error" style="color: red; display:block;">
                                    {{ $errors->first('foto') }}
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