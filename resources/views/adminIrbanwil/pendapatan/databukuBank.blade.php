<p class="text-info" style="font-size: 1rem">Data Buku Pembantu Bank TA {{ $tahun }}</p>
<div class="row">
    <div class="col-md-7">

        <table class="table table-bordered">
            <thead style="background-color: beige">
                <tr>
                    <th>#</th>
                    <th>Jenis Data</th>
                    <th class="text-center">dokumen</th>

                </tr>
            </thead>
            <tbody>
                <tr class="{{ $semester_1 && $semester_1->perbaikan ? 'text-danger' : '' }}">
                    <th>1</th>
                    <th>Print-Out Buku Pembantu Bank Bulan Januari s.d Juni (Semester 1)</th>
                    <th class="text-center">

                        @if($semester_1)
                        <a href="{{ asset('storage/'.$semester_1->file_data) }}" target="_blank"> <img
                                src="/img/logo-pdf.jpg" width="50px"></a>
                        <input type="hidden" name="old_1" value="{{ $semester_1->file_data  }}">
                        @endif
                    </th>

                </tr>
                <tr class="{{ $semester_2 && $semester_2->perbaikan ? 'text-danger' : '' }}">
                    <th>2</th>
                    <th>Print-Out Buku Pembantu Bank Bulan Juli s.d Desember (Semester 2)</th>
                    <th class="text-center">
                        @if($semester_2)
                        <a href="{{ asset('storage/'.$semester_2->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px"></a>
                        <input type="hidden" name="old_2" value="{{ $semester_2->file_data  }}">
                        @endif
                    </th>

                </tr>

            </tbody>

        </table>

    </div>
</div>
<hr>


@push('script')

@error('file_data')
<script>
    Swal.fire({
    position: 'center',
    icon: 'error',
    title: 'Failed!, {{ $message }}',
    showConfirmButton: true
    })
</script>
@enderror
@endpush