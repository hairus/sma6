<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Guru ID</th>
            <th>Mapel ID</th>
            <th>Nis</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Smt</th>
            <th>KD</th>
            <th>NilaiP</th>
            <th>NilaiK</th>
        </tr>
    </thead>
    @php $no = 1; @endphp
    <tbody>
    @foreach($siswa as $sis)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ Auth::user()->id }}</td>
            <td>{{ Auth::user()->mapel_id}}</td>
            <td>{{ $sis->nisn }}</td>
            <td>{{ $sis->nama }}</td>
            <td>{{ $sis->kelas_id }}</td>
            <td>smt</td>
            @foreach ($pkd->where('id',18) as $p)
            <td>{{ $p->id }}</td>
            @endforeach
            <td>0</td>
            <td>0</td>
        </tr>
    @endforeach
    </tbody>
</table>