@extends('layouts.app')
@section('content')

<div class="m-2">
  <button class="btn btn-warning mt-3" type="button" onclick="goBack()"><i class="mdi mdi-arrow-left-bold"></i>
    Back</button>
  <h5 class="text-uppercase text-center mt-2">Edit Daftar Email</h5>
  <div class="row justify-content-center mt-5">
    <div class="col-lg-8 p-3 rounded" style="background-color: rgb(255, 238, 164)">
      <form action="/daftar-email/update/{{ $daftar_email->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="name" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" autofocus
            value="{{ old('name', $daftar_email->name) }}">
          @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
            value="{{ old('email', $daftar_email->email) }}">
          @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
</div>

<script>
  function goBack() {
    window.history.back();
  }
</script>
@endsection