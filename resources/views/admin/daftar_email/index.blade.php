@extends('layouts.app')
@section('content')
<!-- DataTables -->
<link href="/assets_login/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/assets_login/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Required datatable js -->
<script src="/assets_login/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets_login/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<div class="m-2">
  <button class="btn btn-warning mt-3" type="button" onclick="goBack()"><i class="mdi mdi-arrow-left-bold"></i>
    Back</button>
  <h5 class="text-uppercase text-center mt-2">Daftar Email</h5>
  <div class="row justify-content-center mt-3">
    <div class="col-lg-12">
      <a href="/daftar-email/create" class="btn btn-primary mb-2">Tambah Email</a>
      @if (session('success_message'))
      <div class="alert alert-success">
        {{ session('success_message') }}
      </div>
      @endif
      <div class="table-responsive bg-secondary text-light py-3 rounded">
        <table id="datatable" class="table table-striped table-bordered nowrap">
          <thead>
            <tr>
              <th class="align-middle">No</th>
              <th class="align-middle">Nama Lengkap</th>
              <th class="align-middle">Alamat Email</th>
              <th class="align-middle">Action</th>
            </tr>
          </thead>
          <tbody>
            @php
            $i=1
            @endphp
            @foreach($daftar_email as $row)
            <tr>
              <td class="text-center">
                {{ $i++ }}
              </td>
              <td>
                {{ $row->name }}
              </td>
              <td>
                {{ $row->email }}
              </td>
              <td>
                <a href="/daftar-email/edit/{{ $row->id }}" class="btn btn-warning">Edit</a>
                <form action="/daftar-email/delete/{{ $row->id }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger"
                    onclick="return confirm('Apakah anda yakin untuk menghapus?')">Delete</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#datatable').DataTable();
  });
  function goBack() {
    window.history.back();
  }
</script>
@endsection