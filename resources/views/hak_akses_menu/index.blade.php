@extends('components.index')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center d-flex">
        <div class="col-10 p-5">
            <h1 class="text-center">Hak Akses Menu</h1>
            <hr>
        </div>
        @if(Session::has('msg'))
        <div class="col-10">
           {{ Session::get('msg') }}
        </div>
        @endif
        <div class="col-10">
            <table id="example" class="table table-bordered table-hover pt-5">
                <thead>
                    <tr>
                        <td>#</td>
                        <th>Kampus</th>
                        <th>Role</th>
                        <th>Panel</th>
                        <th>Menu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<script>
// function format ( d ) {
//     console.log(d)
//     return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
//         '<tr>'+
//             '<td>Role:</td>'+
//             '<td>***</td>'+
//         '</tr>'+
//     '</table>';
// }
$(document).ready(function() {
    let i=1;
    let table = $('#example').DataTable( {
        'ajax': '{{ route("utility",["type"=>"db_ham"]) }}',
        'columns': [
            {
                // 'className':      'details-control',
                // 'orderable':      false,
                'data': null,
                'render': function(row){
                    return i++ + "";
                }
            },
            { 'data': 'kampus' },
            { 'data': 'role' },
            { 'data': 'panel' },
            { 'data': 'menu' },
            { 
                'data': 'id_hak_akses_menu', 
                'render': function(row){
                    return `
                        <a href='http://localhost:8000/hak_akses_menu/delete/${row}' class='btn btn-danger'>hapus</a>
                        <a href='http://localhost:8000/hak_akses_menu/edit/${row}' class='btn btn-warning'>edit</a>
                    `;
                } 
            }
        ]
    });

    // $('#example tbody').on('click', 'td.details-control', function(){
    //     var tr = $(this).closest('tr');
    //     var row = table.row( tr );

    //     if(row.child.isShown()){
    //         row.child.hide();
    //         tr.removeClass('shown');
    //     } else {
    //         row.child(format(row.data())).show();
    //         tr.addClass('shown');
    //     }
    // });

} );
</script>
@endsection