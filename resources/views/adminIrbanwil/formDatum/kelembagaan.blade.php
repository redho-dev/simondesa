{{-- Form Kelembagaan --}}
<div class="row {{ $jenis=='kelembagaan' ? '' : 'd-none' }}">
    <div class="col-md-6">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="3" class="bg-info">
                        Data Kelembagaan Tahun {{ $tahun }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>1. Pimpinan & anggota BPD
                    </th>
                    <th>
                        {{ $data[0]->isidata }}
                    </th>
                    <th>Orang</th>
                </tr>
                <tr>
                    <th>2. Pengurus & anggota LPM
                    </th>
                    <th>
                        {{ $data[1]->isidata }}
                    </th>
                    <th>Orang</th>
                </tr>
                <tr>
                    <th>3. Rukun Tetangga (RT)
                    </th>
                    <th>
                        {{ $jumrt }}
                    </th>
                    <th>RT</th>

                </tr>
                <tr>
                    <th>4. Pengurus & anggota PKK
                    </th>
                    <th>
                        {{ $data[2]->isidata }}
                    </th>
                    <th>Orang</th>
                </tr>
                <tr>
                    <th>5. Pengurus & anggota Karang Taruna
                    </th>
                    <th>
                        {{ $data[3]->isidata }}
                    </th>
                    <th>Orang</th>

                </tr>
                <tr>
                    <th>6. Anggota Linmas
                    </th>
                    <th>
                        {{ $data[4]->isidata }}
                    </th>
                    <th>Orang</th>

                </tr>
                <tr>
                    <th>7. Kader Posyandu
                    </th>
                    <th>
                        {{ $data[5]->isidata }}
                    </th>
                    <th>Orang</th>

                </tr>
            </tbody>

        </table>

    </div>
</div>
{{-- End Form Kelembagaan --}}