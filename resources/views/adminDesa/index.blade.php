@extends('templates.desa.main')

@section('content')
<script>
    var text = " Sialhkan ikuti langkah sebagai berikut :"+ "\n" +"harus";

    Swal.fire({
    position: 'left',
    icon: 'success',
    width: '50em',
    title:  "Selamat datang Admin Desa",
    html: '<div align="left">Silahkan ikuti Langkah-langkah sebagai berikut : <br><br> 1. Isi Seluruh Data Umum Desa, mulai dari data kewilayahan, data perangkat, APBDes dan data lainnya <br> 2. Isi dan Upload Seluruh Data Akuntabalitas (akuntabilitas pemerintahan, dan akuntabilitas keuangan)<div>',
    showConfirmButton: true,

    }).then((result) => {
        document.location.href='/adminDesa/formKewilayahan';

    });
</script>



@endsection