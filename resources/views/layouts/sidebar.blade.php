<div class="px-2 bg-light rounded">
  <div id="calendar_side" class="py-3 rounded"></div>
</div>
@if(Auth::user())
<div class="card mt-2">
  <div class="card-body">
    <h5>Menu Admin</h5>
    <ul>
      <li><a href="/daftar-email">Daftar Email</a></li>
    </ul>
  </div>
</div>
@endif
<div class="card mt-2">
  <div class="card-body">
    <h5>Nama Alat Ukur</h5>
    <ul>
      @foreach ($alat_ukur as $row)
      <li>
        <span class="badge rounded-pill text-bg-primary" style="background-color: {{ $row->color }} !important;">{{
          $row->nama
          }}</span>
      </li>
      @endforeach
    </ul>
  </div>
</div>
<div class="card mt-2">
  <div class="card-body">
    <h5>Planning</h5>
    <ul>
      @foreach ($event_planning as $row)
      <li>{{ $row->title }}</li>
      @endforeach
    </ul>
  </div>
</div>
<div class="card mt-2">
  <div class="card-body">
    <h5>Actual</h5>
    <ul>
      @foreach ($event_actual as $row)
      <li>{{ $row->title }}</li>
      @endforeach
    </ul>
  </div>
</div>