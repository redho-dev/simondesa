@extends('templates.adminIrbanwil.main')

@section('content')
<h4>PENILAIAN AKUNTUBALITAS PEMERINTAHAN DAN KEUANGAN DESA</h4>
<div class="card p-4">
    <form action="/adminIrbanwil/pilihObrik" method="post">
        <div class="row align-items-center">

            @csrf
            <div class="col-md-2">
                <div class="form-group">
                    <label for="pilcam">Pilih Kecamatan</label>
                    <select class="form-control" id="pilcam" style="font-size: .85rem" name="kecamatan">
                        @foreach($kecamatan as $kec)
                        <option value="{{ $kec->nama_kecamatan }}" {{ $pilcam==$kec->nama_kecamatan ? 'selected' : ''
                            }}>
                            {{ $kec->nama_kecamatan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="pildes">Pilih Desa</label>
                    <select class="form-control" id="pildes" style="font-size: .85rem" name="desa">
                        @foreach($deswal as $ds)
                        <option value="{{ $ds->asal }}" {{ $pildes==$ds->asal ? 'selected' : '' }}>{{ $ds->asal}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="tahun">Tahun Data</label>
                    <input type="text" class="form-control" id="tahun" style="font-size: .85rem" value="{{ $tahun }}"
                        name="tahun">
                </div>
            </div>
            <div class="col-md-2 align-items-center">
                <button class="btn btn-primary btn-sm mt-4">Submit</button>
            </div>
        </div>
    </form>
</div>
<div class="card mt-2">
    <div class="row">
        <div class="col">
            <div class="isi">
                <div class="nav my-3 ml-4">
                    <ul class="nav nav-pills card-header-pills ">
                        <li class="nav-item">
                            Desa {{ $pildes }}, Kecamatan {{ $pilcam }}
                        </li>
                        <li class="nav-item pl-2">

                        </li>
                        <li class="nav-item">

                        </li>
                    </ul>
                </div>
                <hr>
                <div class="x_content" style="overflow: scroll">

                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Data Umum / Monografi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                aria-controls="contact" aria-selected="false">Contact</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <table class="table table-bordered ">
                                <tr style="background-color: cadetblue">
                                    @foreach($subi as $sub)
                                    <td class="text-center">{{ $sub->sub_indikator }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach($subi as $sub)
                                    <td><a href="">Cek Data</a></td>
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach($subi as $sub)
                                    <td><input type="number" placeholder="nilai"></td>
                                    @endforeach
                                </tr>
                            </table>

                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="col">
                                <!-- start accordion -->
                                <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel">
                                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse"
                                            data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <h4 class="panel-title">Collapsible Group Items #1</h4>
                                        </a>
                                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <table class="table table-bordered ">
                                                    <tr style="background-color: cadetblue">
                                                        @foreach($subi as $sub)
                                                        <td class="text-center">{{ $sub->sub_indikator }}</td>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        @foreach($subi as $sub)
                                                        <td><a href="">Cek Data</a></td>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        @foreach($subi as $sub)
                                                        <td><input type="number" placeholder="nilai"></td>
                                                        @endforeach
                                                    </tr>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel">
                                        <a class="panel-heading collapsed" role="tab" id="headingTwo"
                                            data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            <h4 class="panel-title">Collapsible Group Items #2</h4>
                                        </a>
                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                                            aria-labelledby="headingTwo">
                                            <div class="panel-body">
                                                <p><strong>Collapsible Item 2 data</strong>
                                                </p>
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life
                                                accusamus terry richardson ad squid. 3 wolf moon officia aute,
                                                non cupidatat skateboard dolor brunch. Food truck quinoa
                                                nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel">
                                        <a class="panel-heading collapsed" role="tab" id="headingThree"
                                            data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            <h4 class="panel-title">Collapsible Group Items #3</h4>
                                        </a>
                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                            aria-labelledby="headingThree">
                                            <div class="panel-body">
                                                <p><strong>Collapsible Item 3 data</strong>
                                                </p>
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life
                                                accusamus terry richardson ad squid. 3 wolf moon officia aute,
                                                non cupidatat skateboard dolor brunch. Food truck quinoa
                                                nesciunt laborum eiusmod. Brunch 3 wolf moon tempor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end of accordion -->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.
                            Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan
                            four
                            loko farm-to-table craft beer twee. Qui photo
                            booth letterpress, commodo enim craft beer mlkshk
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br><br><br>


@endsection
@push('script')

<script>
    $('#pilcam').on('change', function(){
        var kecamatan = $(this).val();
        $.get('/cariDesa', {data:kecamatan}).done(function(hasil){
            $('#pildes').html("");
            $('#pildes').html(hasil);
        });

        
    })

</script>
@endpush