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

@endsection
@section('content')
<div role="main" class="main">

    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-self-center p-static order-2 text-center">
                    <h1 class="text-dark font-weight-bold text-8">Pengumuman</h1>
                    <span class="sub-title text-dark">Pengumuman Terbaru Simondes</span>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-2">
        <div class="row">
            <div class="col-md-12">
                <div class="blog-posts">
                    <div class="row">
                        @foreach ($pengumuman as $pg)

                        <div class="col-md-4 col-lg-3">
                            <article class="post post-medium border-0 pb-0 mb-5">                                
                                <div class="post-content">

                                    <h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a href="/viewpengumuman/{{ $pg->id }}">{{ $pg->title }}</a></h2>
                                    <p>{!! Str::limit($pg->content, 100) !!}</p>

                                    <div class="post-meta">
                                        <span><i class="far fa-user"></i> Oleh <a href="#">Admin</a> </span>
                                        <span><i class="far fa-calendar"></i>{{ $pg->created_at }}</span>                                            
                                        <span class="d-block mt-2"><a href="/viewpengumuman/{{ $pg->id }}" class="btn btn-xs btn-light text-1 text-uppercase">Selengkapnya</a></span>
                                    </div>

                                </div>
                            </article>
                        </div>                                
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
    </div>
   

</div>

@endsection