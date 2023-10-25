@foreach ($presensi as $d )
    @php
        $folderPath_in = Storage::url('uploads/absensi/' . $d->nik . '/' . $d->foto_in);
        $folderPath_out = Storage::url('uploads/absensi/' . $d->nik . '/' . $d->foto_out);
    @endphp
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $d->nik }}</td>
        <td>{{ $d->nama }}</td>
        <td>{{ $d->jabatan }}</td>
        <td>{{ $d->no_hp }}</td>
        <td>{{ $d->jam_in }}</td>
        <td>{{ $d->jam_out != null ? $d->jam_out : 'Belum Pulang' }}</td>
        <td>
            <img src='{{ url($folderPath_in) }}' class='avatar' alt="">
        </td>
        <td>
            @if ($d->jam_out == null)
                <span class="badge bg-danger">Belum Absen Pulang</span>
            @else
                <img src='{{ url($folderPath_out) }}' class='avatar' alt="">
            @endif
        </td>
        <td>
            @if ($d->jam_in >= '09:00')
                <span class="badge bg-danger">Terlambat</span>
            @else
                <span class="badge bg-success">Tepat Waktu</span>
            @endif
        </td>
    </tr>
@endforeach