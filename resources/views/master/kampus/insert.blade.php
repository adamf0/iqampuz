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
            <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip" data-bs-placement="top" title="Step 1">
                <a class="nav-link active rounded-circle mx-auto d-flex align-items-center justify-content-center" href="#step1" id="step1-tab" data-bs-toggle="tab" role="tab" aria-controls="step1" aria-selected="true">
                    <!-- <i class="fas fa-folder-open"></i> -->
                    Data
                </a>
            </li>
            <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip" data-bs-placement="top" title="Step 2">
                <a class="nav-link rounded-circle mx-auto d-flex align-items-center justify-content-center" href="#step2" id="step2-tab" data-bs-toggle="tab" role="tab" aria-controls="step2" aria-selected="false" title="Step 2">
                    <!-- <i class="fas fa-briefcase"></i> -->
                    Prodi
                </a>
            </li>
            <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip" data-bs-placement="top" title="Step 3">
                <a class="nav-link rounded-circle mx-auto d-flex align-items-center justify-content-center" href="#step3" id="step3-tab" data-bs-toggle="tab" role="tab" aria-controls="step3" aria-selected="false" title="Step 3">
                    <i class="fas fa-star"></i>
                </a>
            </li>
            <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip" data-bs-placement="top" title="Step 4">
                <a class="nav-link rounded-circle mx-auto d-flex align-items-center justify-content-center" href="#step4" id="step4-tab" data-bs-toggle="tab" role="tab" aria-controls="step4" aria-selected="false" title="Step 4">
                    <i class="fas fa-flag-checkered"></i>
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                <h3>Step 1</h3>
                <div class="col-12 mb-5 m-auto shadow-sm p-4">
                    <form action="{{ route('masterKampus.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
<div class="row">
    <div class="col-6 my-1">
        <label for="nama" class="form-label">Nama Kampus</label>
        <input type="text" name="nama_kampus" class="form-control" id="nama">
    </div>
    <div class="col-6 my-1">
        <label for="logo_kampus" class="form-label">Logo Kampus</label>
        <input type="file" name="logo_kampus" class="form-control" id="logo_kampus">
    </div>
    <div class="col-6 my-1">
        <label for="kode" class="form-label">Kode Kampus</label>
        <input type="text" name="kode_kampus" class="form-control" id="kode">
    </div>
    <div class="col-6 my-1">
        <label for="singkatan_kampus" class="form-label">Singkatan Kampus</label>
        <input type="text" name="singkatan_kampus" class="form-control" id="singkatan_kampus">
    </div>
    <div class="col-6 my-1">
        <label for="tanggal_berdiri" class="form-label">Tanggal berdiri</label>
        <input type="date" name="tanggal_berdiri" class="form-control" id="tanggal_berdiri">
    </div>
    <div class="col-6 my-1">
        <label for="provinsi" class="form-label">Provinsi</label>
        <input type="text" name="provinsi" class="form-control" id="provinsi">
    </div>
    <div class="col-6 my-1">
        <label for="kota" class="form-label">Kota</label>
        <input type="text" name="kota" class="form-control" id="kota">
    </div>
    <div class="col-6 my-1">
        <label for="kode_pos" class="form-label">Kode Pos</label>
        <input type="text" name="kode_pos" class="form-control" id="kode_pos">
    </div>
    <div class="col-6 my-1">
        <label for="faximile" class="form-label">Maximile</label>
        <input type="text" name="faximile" class="form-control" id="faximile">
    </div>
    <div class="col-6 my-1">
        <label for="akreditasi" class="form-label">Akreditasi</label>
        <input type="text" name="akreditasi" class="form-control" id="akreditasi">
    </div>
    <div class="col-6 my-1">
        <label for="telepon" class="form-label">Telepon</label>
        <input type="text" name="telepon" class="form-control" id="telepon">
    </div>
    <div class="col-6 my-1">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" class="form-control" id="email">
    </div>
    <div class="col-6 my-1">
        <label for="website" class="form-label">Website</label>
        <input type="text" name="website" class="form-control" id="website">
    </div>

    <div class="col-6 my-1">
        <label for="tgl_kerjasama" class="form-label">Tanggal Kerja Sama</label>
        <input type="date" name="tgl_kerjasama" class="form-control" id="tgl_kerjasama">
    </div>

    <div class="col-6 my-1">
        <label for="nama_rektor" class="form-label">Nama Rektor</label>
        <input type="text" name="nama_rektor" class="form-control" id="nama_rektor">
    </div>
    <div class="col-6 my-1">
        <label for="foto_rektor" class="form-label">Foto Rektor</label>
        <input type="file" name="foto_rektor" class="form-control" id="foto_rektor">
    </div>
    <div class="col-12">
        <label for="alamat" class="form-label">Alamat kampus</label>
        <textarea class="form-control" name="alamat_kampus" id="alamat" rows="3"></textarea>
    </div>
    <div class="col-12">
        <label for="profil_kampus" class="form-label">Profil kampus</label>
        <textarea class="form-control" name="profil_kampus" id="profil_kampus" rows="3"></textarea>
    </div>
    <div class="col-6 my-1">
        <label for="foto_kampus" class="form-label">Foto kampus</label>
        <input type="file" name="foto_kampus" class="form-control" id="foto_kampus">
    </div>
    <div class="col-6 my-1">
        <label for="warna_kampus" class="form-label">Warna/Tema kampus</label>
        <input type="color" name="warna_kampus" class="form-control form-control-color w-100 p-2 border-0" id="warna_kampus" value="#FFEA00">
    </div>
    <div class="col-12 my-1">
        <h6 class="my-3">Hak akses</h6>
    </div>
    @foreach ($panels as $panel)
    <div class="col-6 my-1">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="{{ $panel['id_panel'] }}">
            <label class="form-check-label">
                {{ $panel['nama_panel'] }}
            </label>
        </div>
    </div>
    @endforeach
</div>


<button type="submit" name="submit" class="btn btn-primary w-100 fm-semibold mt-3">Submit</button>


                </form>

            </div>
            <div class="d-flex justify-content-end">
                <a class="btn btn-info next">Continue <i class="fas fa-angle-right"></i></a>
            </div>
        </div>
        <div class="tab-pane fade" role="tabpanel" id="step2" aria-labelledby="step2-tab">
            <h3>Step 2</h3>
            <p>This is step 2</p>
            <div class="d-flex justify-content-between">
                <a class="btn btn-secondary previous"><i class="fas fa-angle-left"></i> Back</a>
                <a class="btn btn-info next">Continue <i class="fas fa-angle-right"></i></a>
            </div>
        </div>
        <div class="tab-pane fade" role="tabpanel" id="step3" aria-labelledby="step3-tab">
            <h3>Step 3</h3>
            <p>This is step 3</p>
            <div class="d-flex justify-content-between">
                <a class="btn btn-secondary previous"><i class="fas fa-angle-left"></i> Back</a>
                <a class="btn btn-info next">Continue <i class="fas fa-angle-right"></i></a>
            </div>
        </div>
        <div class="tab-pane fade" role="tabpanel" id="step4" aria-labelledby="step4-tab">
            <h3>Complete</h3>
            <p>You have successfully completed all steps.</p>
            <div class="d-flex justify-content-between">
                <a class="btn btn-secondary previous"><i class="fas fa-angle-left"></i> Back</a>
                <a class="btn btn-info next">Submit <i class="fas fa-angle-right"></i></a>
            </div>
        </div>
    </div>
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
@endsection