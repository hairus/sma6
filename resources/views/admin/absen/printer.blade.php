<div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" border="1">
                <tbody>
                  <tr>
                  <th>No</th>
                  <th>Nis</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th colspan="13">Jam</th>
                  <th>Catatan</th>
                </tr>
                <?php $no = 1; ?>
                <tr>
                  <td colspan="4"></td>
                  <td>1</td>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>
                  <td>5</td>
                  <td>6</td>
                  <td>7</td>
                  <td>8</td>
                  <td>9</td>
                  <td>10</td>
                  <td>11</td>
                  <td>12</td>
                  <td>13</td>
                </tr>
                <?php
                  $no = 1;
                ?>
                @foreach ($siswas as $siswa)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $siswa->nisn }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->kelas_id }}</td>
					<td>{{$siswa->jamKe1}}</td>
					<td>{{$siswa->jamKe2}}</td>
					<td>{{$siswa->jamKe3}}</td>
					<td>{{$siswa->jamKe4}}</td>
					<td>{{$siswa->jamKe5}}</td>
					<td>{{$siswa->jamKe6}}</td>
					<td>{{$siswa->jamKe7}}</td>
					<td>{{$siswa->jamKe8}}</td>
					<td>{{$siswa->jamKe9}}</td>
					<td>{{$siswa->jamKe10}}</td>
					<td>{{$siswa->jamKe11}}</td>
					<td>{{$siswa->jamKe12}}</td>
                    <td>{{$siswa->jamKe13}}</td>
          <td>{{$siswa->jamKe13}}</td>
                    </tr>
                @endforeach
              </tbody></table>
            </div>
			<b>siswa yang alpa bulan ini : </b>
			<table border="1">
			<tr>
				<td>Nama</td>
				<td>Kondisi</td>
				<td>Tanggal</td>
			</tr>
			@foreach($alpa as $data)
			<tr>
				<td>{{ $data->siswas->nama}}</td>
				<td>{{ $data->kondisi }}</td>
				<td>{{ $data->updated_at }}</td>
			</tr>
			@endforeach
			</table>

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <script type="text/javascript">
          //window.print();
        </script>
