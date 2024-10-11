<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nik">{{ __('NIK*') }}</label>
            <input type="number" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik"
                placeholder="Masukkan NIK" value="{{ old('nik', $penduduk->nik) }}" min="0" max="9999999999999999"
                step="1" required>
            @error('nik')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">{{ __('Nama*') }}</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="name"
                placeholder="Masukkan Nama" value="{{ old('nama', $penduduk->nama) }}" required>
            @error('nama')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin*</label>
            <select name="jenis_kelamin" id="jenis_kelamin"
                class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                @foreach ($jenis_kelamin as $jk)
                    <option value="{{ $jk->value }}"
                        {{ old('jenis_kelamin', $penduduk->jenis_kelamin ?? '') == $jk->value ? 'selected' : '' }}>
                        {{ $jk->label() }}
                    </option>
                @endforeach
            </select>
            @error('jenis_kelamin')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="usia">{{ __('Usia*') }}</label>
            <input type="number" name="usia" class="form-control @error('usia') is-invalid @enderror" id="usia"
                placeholder="Masukkan Usia" value="{{ old('usia', $penduduk->usia) }}" min="0" max="150"
                step="1" required>
            @error('usia')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="alamat">{{ __('Alamat*') }}</label>
            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                id="alamat" placeholder="Masukkan Alamat Lengkap" value="{{ old('alamat', $penduduk->alamat) }}"
                required>
            @error('alamat')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="rt">{{ __('RT*') }}</label>
            <input type="number" name="rt" class="form-control @error('rt') is-invalid @enderror" id="rt"
                placeholder="Masukkan RT" value="{{ old('rt', $penduduk->rt) }}" min="1" max="999"
                required>
            @error('rt')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="rw">{{ __('RW*') }}</label>
            <input type="number" name="rw" class="form-control @error('rw') is-invalid @enderror" id="rw"
                placeholder="Masukkan RW" value="{{ old('rw', $penduduk->rw) }}" min="1" max="999"
                required>
            @error('rw')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="tps">{{ __('TPS*') }}</label>
            <input type="text" name="tps" class="form-control @error('tps') is-invalid @enderror" id="tps"
                placeholder="Masukkan TPS" value="{{ old('tps', $penduduk->tps) }}" required>
            @error('tps')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="kode_kec">{{ __('Kecamatan*') }}</label>
            <select class="form-control @error('kode_kec') is-invalid @enderror" name="kode_kec" id="kode_kec"
                required>
                <option value="" disabled selected>{{ __('Pilih Kecamatan') }}</option>
                @foreach ($wilayah_kecamatan as $item)
                    <option value="{{ $item->kode_full_kec }}"
                        {{ old('kode_kec', $penduduk->kode_kec ?? '') == $item->kode_full_kec ? 'selected' : '' }}>
                        {{ $item->nama_kecamatan }}
                    </option>
                @endforeach
            </select>
            @error('kode_kec')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="kode_kel">{{ __('Kelurahan*') }}</label>
            <select class="form-control @error('kode_kel') is-invalid @enderror" name="kode_kel" id="kode_kel"
                required>
                <option value="" disabled selected>{{ __('Pilih Kelurahan') }}</option>
                @foreach ($wilayah_kelurahan as $item)
                    <option value="{{ $item->kode_full_kel }}"
                        {{ old('kode_kel', $penduduk->kode_kel ?? '') == $item->kode_full_kel ? 'selected' : '' }}>
                        {{ $item->nama_kelurahan }}
                    </option>
                @endforeach
            </select>
            @error('kode_kel')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
