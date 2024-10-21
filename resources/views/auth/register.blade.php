<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link rel="shortcut icon" href="{{ asset('assets/user.png') }}" type="image/x-icon">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- select2 -->
  <link rel="stylesheet" href="{{ asset(env('APP_PUBLIC') . 'plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset(env('APP_PUBLIC') . 'plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
  <div class="register-box">
    <div class="register-logo">
      <a href="{{ url('/') }}">
        <img src="{{ asset('assets/logo.png') }}" alt="logo" style="width: 80px; height: 80px;">
      </a>
    </div>
  
    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register Anggota Baru</p>
  
        <form action="{{ route('register.store') }}" method="post" class="mb-3">
          @csrf
          <div class="mb-3">
            <div class="input-group">
              <select name="jenis_user" id="jenis_user" class="form-control @error('jenis_user') is-invalid @enderror" >
                <option value="">Pilih Jenis User</option>
                <option value="petani" {{ old('jenis_user') == "petani" ? 'selected' : '' }}>Petani</option>
                <option value="pengepul" {{ old('jenis_user') == "pengepul" ? 'selected' : '' }}>Pengepul</option>
                <option value="pedagang_besar" {{ old('jenis_user') == "pedagang_besar" ? 'selected' : '' }}>Pedagang Besar</option>
                <option value="eksportir" {{ old('jenis_user') == "eksportir" ? 'selected' : '' }}>Eksportir</option>
              </select>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            @error('jenis_user')
              <span class="text-danger text-sm font-italic">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <div class="input-group">
              <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Nama Lengkap" >
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            @error('nama')
              <span class="text-danger text-sm font-italic">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <div class="input-group">
              <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror" value="{{ old('telepon') }}" placeholder="Telepon / WhatsApp" >
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-phone"></span>
                </div>
              </div>
            </div>
            @error('telepon')
              <span class="text-danger text-sm font-italic">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <div class="input-group">
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" >
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            @error('email')
              <span class="text-danger text-sm font-italic">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <div class="input-group">
              <input type="password" id="password" name="password" class="form-control" placeholder="Password" >
              <div id="togglePassword" class="input-group-append" role="button">
                <div class="input-group-text">
                  <i class="fas fa-eye"></i>
                </div>
              </div>
            </div>
            @error('password')
              <span class="text-danger text-sm font-italic">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <div class="input-group">
              <input type="password" id="passwordConfirmation" name="password_confirmation" class="form-control" placeholder="Ulangi Password" >
              <div id="togglePasswordConfirmation" class="input-group-append" role="button">
                <div class="input-group-text">
                  <i class="fas fa-eye"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div>
              <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3"  placeholder="Alamat">{{ old('alamat') }}</textarea>
            </div>
            @error('alamat')
              <span class="text-danger text-sm font-italic">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <div class="input-group">
              <select name="provinsi_id" id="provinsi_id" class="form-control select2_regency" >
                <option value="">Pilih Provinsi</option>
                @foreach ($provinsis as $provinsi)
                  <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                @endforeach
              </select>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-globe"></span>
                </div>
              </div>
            </div>
            @error('provinsi_id')
              <span class="text-danger text-sm font-italic">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <div class="input-group">
              <select name="kabupaten_id" id="kabupaten_id" class="form-control" >
                <option value="">Pilih Kabupaten</option>
              </select>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-globe"></span>
                </div>
              </div>
            </div>
            @error('kabupaten_id')
              <span class="text-danger text-sm font-italic">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <div class="input-group">
              <select name="kecamatan_id" id="kecamatan_id" class="form-control" >
                <option value="">Pilih Kecamatan</option>
              </select>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-globe"></span>
                </div>
              </div>
            </div>
            @error('kecamatan_id')
              <span class="text-danger text-sm font-italic">{{ $message }}</span>
            @enderror
          </div>
          <div class="row">
            <div class="col-12 text-right">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
          </div>
        </form>
  
        <a href="{{ route('login') }}" class="text-center text-sm">Saya sudah punya akun</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset(env('APP_PUBLIC') . 'plugins/select2/js/select2.full.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<script>
  $(document).ready(function() {
    $('.select2_regency').select2({
      theme: 'bootstrap4'
    })

    $('#provinsi_id').on('change', function() {
      let provinsiId = $(this).val();
      $('#kabupaten_id').html('<option value="">Pilih kabupaten</option>');

      let url = "{{ route('register.get.kabupaten', ':id') }}";
      url = url.replace(':id', provinsiId);

      if(provinsiId) {
        $.ajax({
          url: url,
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            let kabupatenSelect = $('#kabupaten_id');
            $.each(response.data, function(key, value) {
              kabupatenSelect.append('<option value="' + value.id + '">' + value.name + '</option>');
            });

            kabupatenSelect.select2({
              placeholder: "Pilih Kabupaten",
              allowClear: true,
              theme: 'bootstrap4'
            });
          }
        });
      }
    });

    $('#kabupaten_id').on('change', function() {
      let kabupatenId = $(this).val();
      $('#kecamatan_id').html('<option value="">Pilih Kecamatan</option>');

      let url = "{{ route('register.get.kecamatan', ':id') }}";
      url = url.replace(':id', kabupatenId);
      console.log(url);
      

      if(kabupatenId) {
        $.ajax({
          url: url,
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            let kecamatanSelect = $('#kecamatan_id');
            $.each(response.data, function(key, value) {
              kecamatanSelect.append('<option value="' + value.id + '">' + value.name + '</option>');
            });

            kecamatanSelect.select2({
              placeholder: "Pilih Kecamatan",
              allowClear: true,
              theme: 'bootstrap4'
            });
          }
        });
      }
    });

    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function () {
      // Toggle the type attribute
      const type = password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);

      // Toggle the eye / eye-slash icon
      this.querySelector('i').classList.toggle("fa-eye");
      this.querySelector('i').classList.toggle("fa-eye-slash");
    });

    const togglePasswordConfirmation = document.querySelector("#togglePasswordConfirmation");
    const passwordConfirmation = document.querySelector("#passwordConfirmation");

    togglePasswordConfirmation.addEventListener("click", function () {
      // Toggle the type attribute
      const type = passwordConfirmation.getAttribute("type") === "password" ? "text" : "password";
      passwordConfirmation.setAttribute("type", type);

      // Toggle the eye / eye-slash icon
      this.querySelector('i').classList.toggle("fa-eye");
      this.querySelector('i').classList.toggle("fa-eye-slash");
    });
  })
</script>
</body>
</html>