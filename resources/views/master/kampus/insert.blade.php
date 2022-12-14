@extends('components.index')

@section('content')
    <style>
        .wizard,
        .wizard .nav-tabs,
        .wizard .nav-tabs .nav-item {
            position: relative;
        }

        .wizard .nav-tabs:after {
            content: "";
            width: 80%;
            border-bottom: solid 2px #ccc;
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            top: 38%;
            z-index: -1;
        }

        .wizard .nav-tabs .nav-item .nav-link {
            width: 70px;
            height: 70px;
            margin-bottom: 6%;
            background: white;
            border: 2px solid #ccc;
            color: #ccc;
            z-index: 10;
        }

        .wizard .nav-tabs .nav-item .nav-link:hover {
            color: #333;
            border: 2px solid #333;
        }

        .wizard .nav-tabs .nav-item .nav-link.active {
            background: #fff;
            border: 2px solid #0dcaf0;
            color: #0dcaf0;
        }

        .wizard .nav-tabs .nav-item .nav-link:after {
            content: " ";
            position: absolute;
            left: 50%;
            transform: translate(-50%);
            opacity: 0;
            margin: 0 auto;
            bottom: 0px;
            border: 5px solid transparent;
            border-bottom-color: #0dcaf0;
            transition: 0.1s ease-in-out;
        }

        .nav-tabs .nav-item .nav-link.active:after {
            content: " ";
            position: absolute;
            left: 50%;
            transform: translate(-50%);
            opacity: 1;
            margin: 0 auto;
            bottom: 0px;
            border: 10px solid transparent;
            border-bottom-color: #0dcaf0;
        }

        .wizard .nav-tabs .nav-item .nav-link svg {
            font-size: 25px;
        }
    </style>


    <div class="container">
        <div class="wizard my-5">
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item flex-fill me-1" role="presentation" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Step 1">
                    <a class="nav-link active rounded-circle mx-auto d-flex align-items-center justify-content-center"
                        href="#step1" id="step1-tab" data-bs-toggle="tab" role="tab" aria-controls="step1"
                        aria-selected="true">
                        <!-- <i class="fas fa-folder-open"></i> -->
                        Data
                    </a>
                </li>

                <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Step 2">
                    <a class="nav-link rounded-circle mx-auto d-flex align-items-center justify-content-center"
                        href="#step2" id="step2-tab" data-bs-toggle="tab" role="tab" aria-controls="step2"
                        aria-selected="false" title="Step 2">
                        <!-- <i class="fas fa-briefcase"></i> -->
                        Sejarah
                    </a>
                </li>
                <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Step 3">
                    <a class="nav-link rounded-circle mx-auto d-flex align-items-center justify-content-center"
                        href="#step3" id="step3-tab" data-bs-toggle="tab" role="tab" aria-controls="step3"
                        aria-selected="false" title="Step 3">
                        <i class="fas fa-star"></i>
                        Prodi
                    </a>
                </li>
                <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Step 4">
                    <a class="nav-link rounded-circle mx-auto d-flex align-items-center justify-content-center"
                        href="#step4" id="step4-tab" data-bs-toggle="tab" role="tab" aria-controls="step4"
                        aria-selected="false" title="Step 4">
                        <i class="fas fa-flag-checkered"></i>
                        Hak akses
                    </a>
                </li>

            </ul>
            @if (count($errors) > 0)
                <div class="text-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('masterKampus.store') }}" method="post" enctype="multipart/form-data">
                <div class="tab-content" id="myTabContent">
                    @csrf

                    <div class="tab-pane fade show active" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                        <div class="col-12 mb-3 m-auto shadow-sm p-4">

                            <div class="row">
                                <div class="col-12 col-md-6 my-1">
                                    <label for="nama" class="form-label">Nama
                                        Kampus</label>
                                    <input type="text" name="nama_kampus" value="{{ old('nama_kampus') }}"
                                        class="form-control" id="nama">
                                </div>
                                <div class="col-12 col-md-6 my-1">
                                    <label for="logo_kampus" class="form-label">Logo Kampus</label>
                                    <input type="file" accept="image/*" onchange="loadFile(event,'output_logo')"
                                        name="logo_kampus" class="form-control" id="logo_kampus">
                                    <div class="col-6 col-md-3 m-auto">
                                        <img id="output_logo" class="img-fluid my-3" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 my-1">
                                    <label for="kode" class="form-label">Kode Kampus</label>
                                    <input type="text" name="kode_kampus" class="form-control" id="kode"
                                        value="{{ old('kode_kampus') }}">
                                </div>
                                <div class="col-12 col-md-6 my-1">
                                    <label for="singkatan_kampus" class="form-label">Singkatan Kampus</label>
                                    <input type="text" name="singkatan_kampus" class="form-control"
                                        id="singkatan_kampus" value="{{ old('singkatan_kampus') }}">
                                </div>
                                <div class="col-12 col-md-6 my-1">
                                    <label for="kode_pt" class="form-label">Kode Pt</label>
                                    <input type="text" name="kode_pt" class="form-control"
                                        value="{{ old('kode_pt') }}" id="kode_pt">
                                </div>
                                <div class="col-12 col-md-6 my-1">
                                    <label for="tanggal_berdiri" class="form-label">Tanggal berdiri</label>
                                    <input type="date" name="tanggal_berdiri" class="form-control"
                                        id="tanggal_berdiri" value="{{ old('tanggal_berdiri') }}">
                                </div>
                                <div class="col-12 col-md-6 my-1">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <select class="provinsi js-example-responsive form-select" name="provinsi"
                                        id="provinsi">
                                        <option selected>-- pilih provinsi --</option>
                                        <option value="{{ old('provinsi') }}">{{ old('provinsi') }}</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 my-1">
                                    <label for="kota" class="form-label">Kota</label>
                                    <select name="kota" class="kota js-example-responsive form-select" id="kota">
                                        <option value="{{ old('kota') }}">{{ old('kota') }}</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 my-1">
                                    <label for="kode_pos" class="form-label">Kode Pos</label>
                                    <input type="text" name="kode_pos" value="{{ old('kode_pos') }}"
                                        class="form-control" id="kode_pos">
                                </div>
                                <div class="col-12 col-md-6 my-1">
                                    <label for="faximile" class="form-label">Maximile</label>
                                    <input type="text" name="faximile" class="form-control"
                                        value="{{ old('faximile') }}" id="faximile">
                                </div>
                                <div class="col-12 col-md-6 my-1">
                                    <label for="akreditasi" class="form-label">Akreditasi</label>
                                    <select class="akreditasi_kampus js-example-responsive form-select"
                                        name="akreditasi_kampus">
                                        @if (old('akreditasi_kampus'))
                                            <option value="{{ old('akreditasi_kampus') }}">{{ old('akreditasi_kampus') }}
                                            </option>
                                            @foreach ($akreditasi as $akre_kampus)
                                                <option value="{{ $akre_kampus }}">{{ $akre_kampus }}</option>
                                            @endforeach
                                        @endif
                                        @foreach ($akreditasi as $akre_kampus)
                                            <option value="{{ $akre_kampus }}">{{ $akre_kampus }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 my-1">
                                    <label for="telepon" class="form-label">Telepon</label>
                                    <input type="text" name="telepon" value="{{ old('telepon') }}"
                                        class="form-control" id="telepon">
                                </div>
                                <div class="col-12 col-md-6 my-1">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control" id="email"
                                        value="{{ old('email') }}">
                                </div>
                                <div class="col-12 col-md-6 my-1">
                                    <label for="website" class="form-label">Website</label>
                                    <input type="text" name="website" class="form-control"
                                        value="{{ old('website') }}" id="website">
                                </div>

                                <div class="col-12 col-md-6 my-1">
                                    <label for="tgl_kerjasama" class="form-label">Tanggal Kerja Sama</label>
                                    <input type="date" name="tgl_kerjasama" value="{{ old('tgl_kerjasama') }}"
                                        class="form-control" id="tgl_kerjasama">
                                </div>

                                <div class="col-12 col-md-6 my-1">
                                    <label for="nama_rektor" class="form-label">Nama Rektor</label>
                                    <input type="text" name="nama_rektor" value="{{ old('nama_rektor') }}"
                                        class="form-control" id="nama_rektor">
                                </div>
                                <div class="col-12 col-md-6 my-1">
                                    <label for="foto_rektor" class="form-label">Foto Rektor</label>
                                    <input type="file" accept="image/*" onchange="loadFile(event,'output_rektor')"
                                        name="foto_rektor" class="form-control" id="foto_rektor">
                                    <div class="col-6 m-auto">
                                        <img id="output_rektor" class="img-fluid" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 my-1">
                                    <label for="foto_kampus" class="form-label">Foto kampus</label>
                                    <input type="file" name="foto_kampus" accept="image/*"
                                        onchange="loadFile(event,'output_kampus')" class="form-control" id="foto_kampus">
                                    <div class="col-6 m-auto">
                                        <img id="output_kampus" class="img-fluid" />
                                    </div>
                                </div>
                                <div class="col-12 my-1">
                                    <label for="alamat" class="form-label">Alamat kampus</label>
                                    <textarea class="form-control" name="alamat_kampus" id="alamat" rows="3">{{ old('alamat_kampus') }}</textarea>
                                </div>
                                <div class="col-12 my-1">
                                    <label for="profil_kampus" class="form-label">Profil kampus</label>
                                    <textarea class="form-control" name="profil_kampus" id="profil_kampus" rows="3">{{ old('profil_kampus') }}</textarea>
                                </div>

                                <div class="col-12 my-1">
                                    <label for="warna_kampus" class="form-label">Warna/Tema kampus</label>
                                    <input type="color" name="warna_kampus"
                                        class="form-control form-control-color w-100 p-2 border-0"
                                        value="{{ old('warna_kampus') }}" id="warna_kampus">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-success next fw-semibold">Next Step <i class="fas fa-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="tab-pane fade mb-5" role="tabpanel" id="step2" aria-labelledby="step2-tab">
                        <div class=" shadow-sm mb-3 p-4">
                            <h4 class="my-3">Sejarah</h4>
                            <textarea name="sejarah" class="texteditor" name="sejarah" cols="30" rows="10">{{ old('sejarah') }}</textarea>
                            <h4 class="my-3">Visi</h4>
                            <textarea name="visi" class="texteditor" name="visi" cols="30" rows="10">{{ old('visi') }}</textarea>
                            <h4 class="my-3">Misi</h4>
                            <textarea name="misi" class="texteditor" name="misi" cols="30" rows="10">{{ old('misi') }}</textarea>
                            <h4 class="my-3">Slogan</h4>
                            <textarea class="form-control" name="slogan" rows="3">{{ old('slogan') }}</textarea>
                            <h4 class="my-3"><label for="youtube">Youtube</label></h4>
                            <input type="text" class="form-control" name="youtube" placeholder="youtube"
                                id="youtube" value="{{ old('youtube') }}">
                        </div>
                        <div class="d-flex justify-content-between my-3">
                            <a class="btn btn-secondary previous "><i class="fas fa-angle-left"></i> Back</a>
                            <a class="btn btn-success next fw-semibold">Next Step<i class="fas fa-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="tab-pane fade" role="tabpanel" id="step3" aria-labelledby="step3-tab">
                        <div class=" mb-3 shadow-sm p-4">
                            <div class="row my-3">
                                <div class="col-6">
                                    <h3>Prodi</h3>
                                </div>
                                <div class="col-6">
                                    <h3>Akreditasi</h3>
                                </div>
                            </div>
                            <div class="row my-3" id="a">
                                <div class="col-6">
                                    @if (old('prodi'))
                                        @foreach (old('prodi') as $items)
                                            @foreach ($jurusan as $jes)
                                                @if ($jes->idx == $items)
                                                    <select class="prodi js-example-responsive form-select" name="prodi[]"
                                                        style="width: 100%">
                                                        <option selected value="{{ $jes->idx }}">
                                                            {{ $jes->text }}
                                                        </option>
                                                        @foreach ($jurusan as $jurus)
                                                            <option value="{{ $jurus->idx }}">{{ $jurus->text }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @else
                                        <select class="prodi js-example-responsive form-select" name="prodi[]"
                                            style="width: 100%">

                                            <option selected class="js-example-matcher">-- PILIH PRODI --</option>
                                            @foreach ($jurusan as $j)
                                                <option value="{{ $j->idx }}">{{ $j->text }}</option>
                                            @endforeach
                                        </select>
                                    @endif


                                </div>
                                <div class="col-6">
                                    <select class="akreditasi js-example-responsive form-select" name="akreditasi[]"
                                        style="width: 100%">
                                        @if (old('akreditasi'))
                                            @foreach (old('akreditasi') as $old)
                                                <option value="{{ $old }}">{{ $old }}</option>
                                            @endforeach
                                            @foreach ($akreditasi as $akre)
                                                <option value="{{ $akre }}">{{ $akre }}</option>
                                            @endforeach
                                        @else
                                            <option selected>-- AKREDITASI --</option>
                                            @foreach ($akreditasi as $akre)
                                                <option value="{{ $akre }}">{{ $akre }}</option>
                                            @endforeach
                                        @endif



                                    </select>
                                </div>

                            </div>
                            <div class="" id="b">

                            </div>
                            <a href="#" class="btn btn-primary my-3" id="coba">TAMBAH</a>

                        </div>
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-secondary previous"><i class="fas fa-angle-left"></i> Back</a>
                            <a class="btn btn-success next fw-semibold">Next Step <i class="fas fa-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="tab-pane fade" role="tabpanel" id="step4" aria-labelledby="step4-tab">
                        <div class=" shadow-sm mb-3 p-4">


                            <h3 class="my-3">Hak akses</h3>
                            <div class="row my-3">

                                @foreach ($panels as $panel)
                                    <div class="col-6 my-1">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                name="{{ $panel['id_panel'] }}" id="{{ $panel['id_panel'] }}"
                                                @if (old($panel['id_panel'])) checked @endif>
                                            <label class="form-check-label" for="{{ $panel['id_panel'] }}">
                                                {{ $panel['nama_panel'] }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-secondary previous"><i class="fas fa-angle-left"></i> Back</a>
                            <button type="submit" class="btn btn-primary fw-semibold">Submit</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            //Enable Tooltips
            var tooltipTriggerList = [].slice.call(
                document.querySelectorAll('[data-bs-toggle="tooltip"]')
            );
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            //Advance Tabs
            $(".next").click(function() {
                const nextTabLinkEl = $(".nav-tabs .active")
                    .closest("li")
                    .next("li")
                    .find("a")[0];
                const nextTab = new bootstrap.Tab(nextTabLinkEl);
                nextTab.show();
            });

            $(".previous").click(function() {
                const prevTabLinkEl = $(".nav-tabs .active")
                    .closest("li")
                    .prev("li")
                    .find("a")[0];
                const prevTab = new bootstrap.Tab(prevTabLinkEl);
                prevTab.show();
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <!-- panggil ckeditor.js -->
    <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
    <!-- panggil adapter jquery ckeditor -->
    <script type="text/javascript" src="assets/ckeditor/adapters/jquery.js"></script>
    <!-- setup selector -->
    <script type="text/javascript">
        $('textarea.texteditor').ckeditor();
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var loadFile = function(event, element) {
            var output1 = document.getElementById(element);
            output1.src = URL.createObjectURL(event.target.files[0]);

            output1.onload = function() {
                URL.revokeObjectURL(output1.src) // free memory
            }
        };
    </script>
    <script>
        $(document).ready(function() {
            $('.prodi').select2({});
            $('.akreditasi').select2({});
            $('.provinsi').select2({
                placeholder: 'Pilih Provinsi',
            });
            $('.kota').select2({
                placeholder: 'Pilih Kota',
            });
            $('.akreditasi_kampus').select2({});
        });
        $(document).ready(function() {
            $("#coba").click(function() {
                $("#a").first().clone().appendTo('#b');
                $('.prodi').select2();
                $('.akreditasi').select2();


                $('.prodi').last().next().next().remove();
                $('.akreditasi').last().next().next().remove();

            });
        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getData(type, kode = '0') {
            $.ajax({
                type: "GET",
                dataType: "json",
                accept: "applicaion/json",
                url: `http://127.0.0.1:8000/wilayah/${type}/${kode}`,
                // data: "kode=" + kode,
                success: function(datas) {
                    if (type == 'provinsi') {
                        $(".provinsi").select2({
                            data: datas
                        })
                    } else if (type == 'kota') {
                        $(".kota").select2({
                            data: datas
                        })
                    } else if (type == 'jurusan') {
                        var data = $.map(datas, function(obj) {
                            obj.id = obj.idx;
                            return obj;
                        });
                        $("#prodi").select2({
                            data: data
                        })
                    }
                }
            });
        }
        $(document).ready(function() {
            $(".provinsi").change(function() {
                console.log(this.value);
                $(".kota").empty();
                getData('kota', String(this.value).padStart(6, '0'));
            });
            getData('provinsi');
            // getData('jurusan');
            // $("#kota").change(getAjaxKota);
        });
    </script>
@endsection
