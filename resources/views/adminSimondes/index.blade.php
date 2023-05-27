@extends('adminSimondes.templates.main')

@section('content')

<section role="main" class="content-body">
    <header class="page-header">
        <h2>Dashboard Irban</h2>

        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/irban">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>

                <li><span>Beranda</span></li>

                <li>&nbsp;</li>
            </ol>            
        </div>
    </header>

    <div class="row">
        <div class="col">
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    </div>
                    <h2 class="card-title">Desa </h2>
                </header>
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0" id="datatable-default">
                        <thead>
                            <tr>
                                <th style="width: 3%">No.</th>
                                <th>Rendering engine</th>
                                <th>Browser</th>
                                <th>Platform(s)</th>
                                <th class="d-lg-none">Engine version</th>
                                <th class="d-lg-none">CSS grade</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Trident</td>
                                <td>Internet
                                    Explorer 4.0
                                </td>
                                <td>Win 95+</td>
                                <td class="center d-lg-none">4</td>
                                <td class="center d-lg-none">X</td>
                            </tr>
                            <tr>
                                <td>Trident</td>
                                <td>Internet
                                    Explorer 5.0
                                </td>
                                <td>Win 95+</td>
                                <td class="center d-lg-none">5</td>
                                <td class="center d-lg-none">C</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</section>




@endsection