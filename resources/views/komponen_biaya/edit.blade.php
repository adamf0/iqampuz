@extends('components.index')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-10 d-flex p-5">
            <h1 class="text-center">Form Ubah Komponen Biaya</h1>
            <hr>
        </div>
        <div class="col-10 d-flex">
            @if(Session::has('msg'))
                <div class="col-10">
                    {{ Session::get('msg') }}
                </div>
            @endif
            <form action="{{ route('komponen_biaya.update',['id'=>$komponen->id_komponen_biaya]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <label>Kampus</label>
                        <select class="form-control" name="id_kampus" id="id_kampus" style="width: 100%;"></select>
                        @if($errors->has('id_kampus'))
                            <div class="text-danger">{{ $errors->first('id_kampus') }}</div>
                        @endif
                    </div>
                    <div class="col-12">
                        <label>Nama Komponen</label>
                        <select class="form-control" name="id_komponen" id="id_komponen" style="width: 100%;"></select>
                        @if($errors->has('id_komponen'))
                            <div class="text-danger">{{ $errors->first('id_komponen') }}</div>
                        @endif
                    </div>
                    <div class="col-12">
                        <label>Biaya</label>
                        <input type="text" class="form-control" name="biaya" id="biaya" value="Rp ">
                        @if($errors->has('biaya'))
                            <div class="text-danger">{{ $errors->first('biaya') }}</div>
                        @endif
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var id_kampus = '{{ $komponen->id_kampus }}';
    var id_komponen = '{{ $komponen->id_kampus }}';

    function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
    function get(url,element){
        $.ajax({
            type: "GET",  
            url: url,
            accept: 'application/json',
            dataType: 'json',
            success: function(response){  
                var response_ = {id: -1,text: '',selected: 'selected',search:'',hidden:true};
                response_ = [response_].concat(response);
                response_.map(function(r_){
                    if(element=='id_kampus' && r_.id==id_kampus) r_.selected = 'selected'
                    if(element=='id_komponen' && r_.id==id_komponen) r_.selected = 'selected'
                });

                $(`#${element}`).select2({
                    allowClear: true,
                    placeholder: {
                        id: "-1",
                        text:"-- Pilih --",
                        selected:'selected'
                    },
                    data: response_
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                // alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }       
        });
    }

    $(document).ready(function() {
        get('{{ route("utility",["type"=>"kampus"]) }}','id_kampus');
        get('{{ route("utility",["type"=>"komponen"]) }}','id_komponen');

        var biaya = document.getElementById('biaya');
		biaya.addEventListener('keyup', function(e){
			biaya.value = formatRupiah(this.value, 'Rp. ');
		});
        biaya.value = formatRupiah('{{ $komponen->biaya }}', 'Rp. ');
    });
</script>
@endsection