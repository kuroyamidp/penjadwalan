$(document).ready(function() {
    globalgetactivemenu()

    App.init();
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        event.preventDefault();
        swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                        'Deleted!',
                        'Your data has been deleted.',
                        'success'
                    )

                }
            });
    });
    $( "#skstambah" ).change(function() {
        // alert( "Handler for .change() called." );
        var sks = $("#skstambah").val()
        var bobot = $("#bobottambah").val()
        var mutu = sks * bobot
        $("#mututambah").val(mutu)
      });


      $('#default-ordering').DataTable( {
        "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
    "<'table-responsive'tr>" +
    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
           "sLengthMenu": "Results :  _MENU_",
        },
        "order": [[ 3, "desc" ]],
        "stripeClasses": [],
        "lengthMenu": [7, 10, 20, 50],
        "pageLength": 7,
        drawCallback: function () { $('.dataTables_paginate > .pagination').addClass(' pagination-style-13 pagination-bordered'); }
    } );
    var hari = $("#hr").val()
    var semester = $("#semester").val()
    // console.log(hari)
    $("#haris option[value="+ hari +"]").attr("selected", true);
    $("#smt option[value="+ semester +"]").attr("selected", true);
    

    var firstUpload = new FileUploadWithPreview('myFirstImage')

})

function globalgetactivemenu() {
    //deactivate menu
    $('a').attr('data-active', 'false');
    $('a').attr('aria-expanded', 'false');
    //get path now
    var pathNow = window.location.pathname;
    //activate menu based on path
    $('a[href="' + pathNow + '"]').attr('data-active', 'true');
    $('a[href="' + pathNow + '"]').attr('aria-expanded', 'true');
    $('a[href="' + pathNow + '"]').parent('li').parent('ul').siblings('.dropdown-toggle').attr('data-active', 'true');
    $('a[href="' + pathNow + '"]').parent('li').parent('ul').siblings('.dropdown-toggle').attr('aria-expanded', 'true');
    $('a[href="' + pathNow + '"]').parent('li').parent('ul').addClass('show');
}

function calculatemutu() {
    var sks = $("#skstambah").val()
    var bobot = $("#bobottambah").val()
    var mutu = sks * bobot
    $("#mututambah").val(mutu)
    // console.log($("#bobottambah").val())
    
}

function getkelas() {
    $("#kls").select2();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var semester = $("#smt").val();
    jQuery.ajax({
        url: "/getkelas",
        method: 'get',
        data: {
            semester: semester,
        },
        success: function(result) {
            console.log(result)
          var data = $.map(result, function (obj) {
            obj.id = obj.id; 
            obj.text = obj.matkul;
          
            return obj;
          });
          $("#kls").select2({data:data});
         
        },
    })
    
    
}
function reset() {
    $('#configform')[0].reset(); // Reset the form fields
    // Reload the initial data by redirecting to the index route
    window.location.href = "{{ route('daftar-kelas.index') }}";
}


function getnamemahasiswa() {
    var datamahasiswa = JSON.parse( $("#mhs").val())
    $("#username").val(datamahasiswa.nama)
    // console.log(datamahasiswa.nama)
}
function getnamedosen() {
    var datadosen = JSON.parse( $("#dsn").val())
    $("#username").val(datadosen.nama)
    // console.log(datamahasiswa.nama)
}
//Script Khusus Pencarian
//Penjadwalan/Daftar Kelas
