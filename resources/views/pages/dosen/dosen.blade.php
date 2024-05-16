@extends('layouts.main')

@section('content')

<div class="layout-px-spacing">
    <div class="row">
        <div class="col-lg-12">
            <form id="configform" action="{{ route('search-dosen') }}" method="get">
                @csrf
                <div class="row mb-1 mt-1">
                    <div class="col-lg-3">
                        <label for="dosen">Dosen</label>
                        <input type="text" class="form-control" name="dosen" id="dosen" placeholder="Cari dosen">
                        <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                        <button type="button" onclick="resetForm()" class="btn btn-warning btn-sm">Reset</button>
                    </div>
                    <div class="col-lg-3"></div>
                </div>
            </form>
        </div>
    </div>
    <div class="row layout-top-spacing">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('dosen.create')}}" class="btn btn-primary btn-sm">Tambah</a>

                    <!-- Modal -->
                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Upload data dosen</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{url('/importdosen')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="form-control">Upload file</label>
                                                <input type="file" class="form-control" name="excel_file">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="form-control">Unduh excel untuk import data dosen</label>
                                                <a title="Unduh" href="excel/IMPORT DATA DOSEN STIMIK.xlsx" target="_blank" download>
                                                    <i class="bx bxs-download"></i> Unduh
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Upload file</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- endmodal -->
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-hover" id="default-ordering">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>NUPTK</th>
                                        <th>Guru</th>
                                        <th>Wali Kelas</th>
                                        <th>Ikatan kerja</th>
                                        <th>Jabatan Fungsional</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="data-table-body">
                                    @foreach($dosen as $key => $value)
                                    <tr style="text-align: center;">
                                        <td width="1%">{{$key + 1}}</td>
                                        <td>{{$value->nidn}}</td>
                                        <td>{{$value->nama}}</td>
                                        <td>
                                            @if($value->progdi == null)
                                            <span class="badge badge-warning">Progdi belum ditentukan</span>
                                            @else
                                            <span class="badge badge-success">{{$value->progdi}} | {{$value->kelas}}</span>
                                            @endif
                                        </td>
                                        <td>{{$value->ikatan_kerja}}</td>
                                        <td>{{$value->jabatan_fungsional}}</td>
                                        <td>{{$value->status}}</td>
                                        <td class="text-center" style="display: flex; justify-content: center;">
                                            <a href="{{ route('dosen.show', $value->uid) }}" class="btn btn-warning mb-1 mr-1 rounded-circle" data-toggle="tooltip" title='Update'><i class="bx bx-edit bx-sm"></i></a>
                                            <form action="{{ route('dosen.destroy', $value->uid) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger mb-1 mr-1 rounded-circle show_confirm" data-toggle="tooltip" title='Delete' type="submit"><i class="bx bx-trash bx-sm"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
   $(document).ready(function() {
        var showUrlBase = "{{ route('dosen.show', '') }}";
        var destroyUrlBase = "{{ route('dosen.destroy', '') }}";

        // Function to update the table based on search
        function updateTable(search) {
            $.ajax({
                url: '{{ route("search-dosen") }}',
                type: 'GET',
                data: {
                    search: search
                },
                success: function(response) {
                    $('#data-table-body').empty();
                    var nomor = 1;

                    $.each(response, function(index, value) {
                        var row = '<tr style="text-align: center;">' +
                            '<td>' + nomor++ + '</td>' +
                            '<td>' + value.nidn + '</td>' +
                            '<td>' + value.nama + '</td>' +
                            '<td>' + (value.progdi ? '<span class="badge badge-success">' + value.progdi + ' | ' + value.kelas + '</span>' : '<span class="badge badge-warning">Progdi belum ditentukan</span>') + '</td>' +
                            '<td>' + value.ikatan_kerja + '</td>' +
                            '<td>' + value.jabatan_fungsional + '</td>' +
                            '<td>' + value.status + '</td>' +
                            '<td class="text-center" style="display: flex; justify-content: center;">' +
                                '<a href="' + showUrlBase + '/' + value.uid + '" class="btn btn-warning mb-1 mr-1 rounded-circle" data-toggle="tooltip" title="Update"><i class="bx bx-edit bx-sm"></i></a>' +
                                '<form action="' + destroyUrlBase + '/' + value.uid + '" method="post" style="display:inline;">' +
                                '@method("DELETE")' +
                                '@csrf' +
                                '<button class="btn btn-danger mb-1 mr-1 rounded-circle show_confirm" data-toggle="tooltip" title="Delete" type="submit"><i class="bx bx-trash bx-sm"></i></button>' +
                                '</form>' +
                            '</td>' +
                            '</tr>';

                        $('#data-table-body').append(row);
                    });

                    // Re-initialize tooltips and confirmation dialogs after updating the table
                    $('[data-toggle="tooltip"]').tooltip();
                    addEventListenersToActionButtons();
                }
            });
        }

        $('#configform').submit(function(event) {
            event.preventDefault();
            var search = $('#dosen').val();
            updateTable(search);
        });

        // Function to add event listeners to action buttons
        function addEventListenersToActionButtons() {
            $('.show_confirm').click(function(event) {
                var form = $(this).closest("form");
                event.preventDefault();
                swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
            });
        }

        // Call the function to add event listeners when the page loads
        addEventListenersToActionButtons();

        // Function to reset the form and reload the page
        window.resetForm = function() {
            document.getElementById("configform").reset();
            window.location = "{{ route('dosen.index') }}";
        }
    });
</script>
@endsection
