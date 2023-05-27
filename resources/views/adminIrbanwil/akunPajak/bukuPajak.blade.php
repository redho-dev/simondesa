<div class="row">
    <div class="col-md-6">
        <h4 class="alert alert-info">Buku Pembantu Pajak Tahun {{ $tahun }}</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-6 text-center">
        <a href="{{ asset('storage/'.$buku[0]->file_data) }}" target="_blank">
            <img src="/img/logo-pdf.jpg" width="75px">
        </a>
    </div>
</div>