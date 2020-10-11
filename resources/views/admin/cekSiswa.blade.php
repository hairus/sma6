@extends('admin.layouts')
<h1>
  @foreach ($Kelas as $siswa)
    {{ $siswa->nama }}
  @endforeach
</h1>
