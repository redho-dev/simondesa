@extends('layouts.main')
@section('css')
<!-- Material Icons -->
<link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
<!-- CSS Files -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
<link id="pagestyle" href="/assets/css/material-kit.css?v=3.0.4" rel="stylesheet" />

<link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@endsection
@section('content')
<div role="main" class="main">

    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-self-center p-static order-2 text-center">
                    <h1 class="text-dark font-weight-bold text-8">APBDes</h1>
                    <span class="sub-title text-dark">Anngaran Pendapatan dan Belanja Desa</span>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
            <div class="card card-border card-border-top bg-color-light">
            <div class="card-body">
                <div class="card-box table-responsive">
                    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Desa</th>
                                <th style="text-align: center">Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            @forelse ($apbdes as $apbdes)                                               
                            <tr>
                                <td style="width:5%; text-align: center;">{{ $loop->iteration }}</td>
                                <td style="text-align: left; width:75%">{{ $apbdes->asal }}</td>
                                <td class="text-center" style="width:20%"></td>
                            </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Blog belum Tersedia.
                                </div>
                            @endforelse									
                        </tbody>
                    </table>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
