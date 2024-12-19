<!DOCTYPE html>
<html>

<head>
  <title>Reminder Calibration</title>
</head>

<body>
  <h4>Hallo, {{ $name }}!</h4>
  <p>Jadwal Kalibrasi</p>
  <p><b>{{ $title }}</b></p>
  <p>akan dilaksanakan pada:</p>
  <br>
  <p>Hari/Tanggal</p>
  @if ($end != '')
  <p><b>{{ $start }} s/d {{ $end }}</b></p>
  @else
  <p><b>{{ $start }}</b></p>
  @endif
  <p>Jangan lupa untuk melakukan kalibrasi pada waktu yang sudah ditentukan</p>
  <h5>Divisi Quality Control</h5>
</body>

</html>