{{-- Form Update Papan Monografi --}}
<div class="row ">
    <div class="col-md-8 mt-2">
        <p class="alert bg-primary text-white" style="font-size: 1rem">Foto Papan Monografi
            Tahun {{ $tahun }}
        </p>

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Foto Papan Monografi</th>

            </tr>
            @foreach($data as $dt)
            <tr>
                <td style="vertical-align: middle">{{ $loop->iteration }}</td>
                <td style="vertical-align: middle">
                    <a href="{{ asset('storage/'.$dt->isidata) }}" target="_blank"><img
                            src="{{ asset('storage/'.$dt->isidata) }}" class="img-fluid" width="500"></a>
                </td>

            </tr>
            @endforeach
        </table>
    </div>
</div>