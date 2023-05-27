@extends('templates.desa.main')
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="x_panel">                                     
            <div class="img-thumbnail border-0 p-0 d-block">                
                @forelse ($kantor as $akun)                            
                <a href="{{ asset('storage/'.$akun->file_data) }}" target="_blank">
                    <img src="{{ asset('storage/'.$akun->file_data) }}"
                        width="365px"><br>                    
                </a>
                @empty                                
                <a href="{{ asset('storage/image/kantordesa.jpg') }}" target="_blank">
                    <img src="{{ asset('storage/image/kantordesa.jpg') }}"
                        width="365px"><br>                    
                </a>
                @endforelse

            </div>     

            <h5 class="font-weight-semibold line-height-2 mt-3">Kepala Desa</h5>            
            @forelse ($kades as $kd)
            <span>{{ $kd->nama }}</span>
            @empty
            <span>Data Kepala Desa Belum Diisi</span>
            @endforelse
        </div>
    </div>
    @foreach($desas as $desa)
    <div class="col-md-8">
        <div class="x_panel">                                     
            <h4 class="font-weight-bold text-12 line-height-2 mb-3">Profil Desa {{ $desa->asal }} Tahun {{ $tahun }}</h4>
            <p class="custom-font-size-1">Terletak di Kecamatan {{ $desa->kecamatan }} dengan luas wilayah
                @foreach($datums as $dt)
                    @if($dt->nama_data == 'luas_wilayah')
                        {{$dt->isidata}} m <sup>2</sup>
                    @endif
                @endforeach
            </p>

            <div class="row">
                <div class="col-lg-6">                    
                    <h5 class="mb-2"><i class="icon-arrow-up-circle icons"></i> Batas Utara</h5>
                    @foreach($datums as $dt)
                        @if($dt->nama_data == 'batas_utara')
                            <p class="mb-4">{{$dt->isidata}}</p>
                        @endif
                    @endforeach                    
                </div>
                <div class="col-lg-6">                    
                    <h5 class="mb-2"><i class="icon-arrow-down-circle icons"></i> Batas Selatan</h5>
                    @foreach($datums as $dt)
                        @if($dt->nama_data == 'batas_selatan')
                            <p class="mb-4">{{$dt->isidata}}</p>
                        @endif
                    @endforeach										                    
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">                    
                    <h5 class="mb-2"><i class="icon-arrow-left-circle icons"></i> Batas Barat</h5>
                    @foreach($datums as $dt)
                        @if($dt->nama_data == 'batas_barat')
                            <p class="mb-4">{{$dt->isidata}}</p>
                        @endif
                    @endforeach										                    
                </div>
                <div class="col-lg-6">                    
                    <h5 class="mb-2"><i class="icon-arrow-right-circle icons"></i> Batas Timur</h5>
                    @foreach($datums as $dt)
                        @if($dt->nama_data == 'batas_timur')
                            <p class="mb-4">{{$dt->isidata}}</p>
                        @endif
                    @endforeach										                    
                </div>
            </div>

            <div class="row">                
                <div class="col-md-12 col-sm-12">        
                    <h5 class="mt-2">Sarana dan Prasarana</h5>
                    <div class="row" style="display: inline-block;"> 
                        <div class="tile_count">
                            <div class="col-md-2 col-sm-4  tile_stats_count">            
                                <div class="count green">{{ $jmlpdd }}</div>
                                <span class="count_top" ><i class="fa fa-user"></i> Pendidikan</span>
                            </div>
                            <div class="col-md-2 col-sm-4  tile_stats_count">
                                <div class="count green">{{ $jmlibdah }}</div>
                                <span class="count_top"><i class="fa-solid fa-mosque"></i> Ibadah</span>
                            </div>
                            <div class="col-md-3 col-sm-4  tile_stats_count">            
                                <div class="count green">{{ $jmlkshatan }}</div>            
                                <span class="count_top"><i class="fa-solid fa-house-medical"></i> Kesahatan</span>
                            </div>
                            <div class="col-md-2 col-sm-4  tile_stats_count">            
                                <div class="count green">{{ $jmlumum }}</div>            
                                <span class="count_top"><i class="fa-sharp fa-solid fa-users-line"></i> Prasarana Umum</span>
                            </div>
                            <div class="col-md-3 col-sm-5  tile_stats_count">            
                                <div class="count green">{{ $pddmiskin }}</div>            
                                <span class="count_top"><i class="fa-solid fa-person-arrow-down-to-line"></i> Jumlah Penduduk Miskin</span>
                            </div>        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>


<div class="row">

    <div class="col-md-6">
        <div class="x_panel">
            <div class="x_title">            
                <h2>Visi dan Misi</h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="row">
                    <div class="col-md-12">
                        <h6>Visi</h6>
                        @forelse($visi as $vs)                
                        <span style="padding-left: 10px;">{{ $vs->uraian }}</span>            
                        @empty
                        <span>Data Visi belum diisi</span>
                        @endforelse
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h6>Misi</h6>
                        <?php $i=1; ?>
                        @forelse($misi as $ms)                
                        <span style="padding-left: 10px;">Misi {{ $i }} : {{ $ms->uraian }}<br></span>
                        <?php $i++; ?>
                        @empty
                        <span>Data Misi belum diisi</span>
                        @endforelse
                    </div>           
                </div>                         
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="x_panel">
            <div class="x_title">            
                <h2>Potensi Desa</h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="row">
                    <div class="col-md-12">
                        -
                    </div>
                </div>                                 
            </div>
        </div>
    </div>

</div>



<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">            
                <h2>Kependudukan <small>Data Kependudukan Tahun {{ $tahun }}</small></h2>
                <div class="clearfix"></div>
            </div>
            
            <div class="x_content">
                <div class="row">
                    <div class="col-md-4">
                        <table class="countries_list">
                            <tbody>
                            <tr>
                                <td>Jumlah Penduduk</td>
                                <td class="fs15 fw700 text-right">
                                    @foreach($datums as $dt)
                                    @if($dt->nama_data == 'jumlah_penduduk')
                                        <strong>{{$dt->isidata}}</strong> Jiwa
                                    @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>Penduduk Perempuan</td>
                                <td class="fs15 fw700 text-right">
                                    @foreach($datums as $dt)
                                        @if($dt->nama_data == 'jumlah_penduduk_p')
                                            <strong>{{$dt->isidata}}</strong> Jiwa
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>Usia > 65 tahun</td>
                                <td class="fs15 fw700 text-right">
                                    @foreach($datums as $dt)
                                        @if($dt->nama_data == 'usia_65_keatas')
                                            <strong>{{$dt->isidata}}</strong> Jiwa
                                        @endif
                                    @endforeach
                                </td>                                
                            </tr>
                            <tr>
                                <td>Jumlah Penerima BLT DD</td>
                                <td class="fs15 fw700 text-right">
                                    @foreach($datums as $dt)
                                        @if($dt->nama_data == 'penerima_blt_dd')
                                            <strong>{{$dt->isidata}}</strong> Jiwa
                                        @endif
                                    @endforeach
                                </td>                                
                            </tr>                                                    
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-4">
                        <table class="countries_list">
                            <tbody>
                            <tr>
                                <td>Jumlah Kepala Keluarga</td>
                                <td class="fs15 fw700 text-right">
                                    @foreach($datums as $dt)
                                        @if($dt->nama_data == 'jumlah_kk')
                                            <strong>{{$dt->isidata}}</strong> Jiwa
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>Usia 0-15 tahun</td>
                                <td class="fs15 fw700 text-right">
                                    @foreach($datums as $dt)
                                        @if($dt->nama_data == 'usia_0_15')
                                            <strong>{{$dt->isidata}}</strong> Jiwa
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>Jumlah Penduduk Miskin</td>
                                <td class="fs15 fw700 text-right">
                                    @foreach($datums as $dt)
                                        @if($dt->nama_data == 'penduduk_miskin')
                                            <strong>{{$dt->isidata}}</strong> Jiwa
                                        @endif
                                    @endforeach
                                </td>                            
                            </tr>                                                                                                          
                            </tbody>
                        </table>
                    </div>


                    <div class="col-md-4">
                        <table class="countries_list">
                            <tbody>
                            <tr>
                                <td>Penduduk Laki - Laki</td>
                                <td class="fs15 fw700 text-right">
                                    @foreach($datums as $dt)
                                        @if($dt->nama_data == 'jumlah_penduduk_l')
                                            <strong>{{$dt->isidata}}</strong> Jiwa
                                        @endif
                                    @endforeach
                                </td>                            
                            </tr>
                            <tr>
                                <td>Usia 15-65 tahun</td>
                                <td class="fs15 fw700 text-right">
                                    @foreach($datums as $dt)
                                        @if($dt->nama_data == 'usia_15_65')
                                            <strong>{{$dt->isidata}}</strong> Jiwa
                                        @endif
                                    @endforeach
                                </td>                            
                            </tr>
                            <tr>
                                <td>Jumlah KK Miskin</td>
                                <td class="fs15 fw700 text-right">
                                    @foreach($datums as $dt)
                                        @if($dt->nama_data == 'kk_miskin')
                                            <strong>{{$dt->isidata}}</strong> Jiwa
                                        @endif
                                    @endforeach
                                </td>                                                               
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>                    
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">            
                <h2>Kelembagaan <small>Data Kelembagaan Tahun {{ $tahun }}</small></h2>
                <div class="clearfix"></div>
            </div>
            
            <div class="x_content">
                <div class="row">
                    <div class="col-md-4">
                        <table class="countries_list">
                            <tbody>
                            <tr>
                                <td>Pimpinan/Anggota BPD</td>
                                <td class="fs15 fw700 text-right">
                                    @foreach($datums as $dt)
                                        @if($dt->nama_data == 'jumlah_bpd')
                                            <strong>{{$dt->isidata}}</strong>
                                        @endif
                                    @endforeach
                                </td>                                                             
                            </tr>
                            <tr>
                                <td>Pengurus/Anggota Karang Taruna</td>
                                <td class="fs15 fw700 text-right">
                                    @foreach($datums as $dt)
                                        @if($dt->nama_data == 'jumlah_karang_taruna')
                                            <strong>{{$dt->isidata}}</strong>
                                        @endif
                                    @endforeach
                                </td>                                                         
                            </tr>
                            
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-4">
                        <table class="countries_list">
                            <tbody>
                            <tr>
                                <td>Pengurus/Anggota LPM</td>
                                <td class="fs15 fw700 text-right">
                                    @foreach($datums as $dt)
                                        @if($dt->nama_data == 'jumlah_lpm')
                                            <strong>{{$dt->isidata}}</strong>
                                        @endif
                                    @endforeach
                                </td>                                                                                                            
                            </tr>
                            <tr>
                                <td>Anggota Linmas</td>
                                <td class="fs15 fw700 text-right">
                                    @foreach($datums as $dt)
                                        @if($dt->nama_data == 'jumlah_linmas')
                                            <strong>{{$dt->isidata}}</strong>
                                        @endif
                                    @endforeach
                                </td>                                    
                            </tr>                            
                            </tbody>
                        </table>
                    </div>


                    <div class="col-md-4">
                        <table class="countries_list">
                            <tbody>
                            <tr>
                                <td>Pengurus/Anggota PKK</td>
                                <td class="fs15 fw700 text-right">
                                    @foreach($datums as $dt)
                                        @if($dt->nama_data == 'jumlah_pkk')
                                            <strong>{{$dt->isidata}}</strong>
                                        @endif
                                    @endforeach
                                </td>                                                                                                       
                            </tr>
                            <tr>
                                <td>Kader Posyandu</td>
                                <td class="fs15 fw700 text-right">
                                    @foreach($datums as $dt)
                                        @if($dt->nama_data == 'jumlah_kader')
                                            <strong>{{$dt->isidata}}</strong> 
                                        @endif
                                    @endforeach
                                </td>                                                
                            </tr>                            
                            </tbody>
                        </table>
                    </div>       
                </div>     
            </div>
        </div>
    </div>
</div>

<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>


@endsection