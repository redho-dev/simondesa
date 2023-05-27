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
<div class="container py-4">
    <div class="row">
        <div class="col">
            <div class="blog-posts single-post">

                <article class="post post-large blog-single-post border-0 m-0 p-0">
                    <div class="post-image ms-0">
                        <a href="#">
                            <img src={{ Storage::url('blogs/').$article->image }} class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
                        </a>
                    </div>

                    <div class="post-date ms-0">
                        <span class="day">{{ $article->nomor }}</span>
                        <span class="month">{{ $article->tahun }}</span>
                    </div>

                    <div class="post-content ms-0">

                        <h2 class="font-weight-semi-bold"><a href="#">{{ $article->title }}</a></h2>

                        <div class="post-meta">
                            <span><i class="fa-solid fa-file"></i> No : {{ $article->nomor }}</span>
                            <span><i class="fa-regular fa-file"></i>Tahun : {{ $article->tahun }}</span>
                            <span><i class="far fa-calendar"></i>{{ Str::limit($article->created_at, 10, '') }}</span>
                        </div>
                        <embed type="application/pdf" src="/storage/peraturans/{{ $article->image }}" width="100%" height="1000"></embed>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>

@endsection