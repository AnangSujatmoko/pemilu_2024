<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="FormControlSelect2">NIK</label>
            <div class="row">
                <div class="col-12 col-md-12">
                    <select class="form-control js-data-example-ajax select2" id="FormControlSelect2" name="nik"
                        style="width: 100%;">
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="name">{{ __('Nama*') }}</label>
            <input type="text" name="name" class="form-control @error('nama') is-invalid @enderror" id="name"
                placeholder="Masukkan Nama" value="{{ old('name', $penduduk->nama) }}" required readonly>
            @error('nama')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin*</label>
            <select name="jenis_kelamin" id="jenis_kelamin"
                class="form-control @error('jenis_kelamin') is-invalid @enderror" required disabled>
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
                step="1" required readonly>
            @error('usia')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="alamat">{{ __('Alamat*') }}</label>
            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                id="alamat" placeholder="Masukkan Alamat Lengkap" value="{{ old('alamat', $penduduk->alamat) }}"
                required readonly>
            @error('alamat')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>

        {{-- <div class="form-group">
            <label for="id_domisili">{{ __('Domisili*') }}</label>
            <input type="text" name="id_domisili"
                class="form-control @error('id_domisili') is-invalid @enderror"
                id="id_domisili" placeholder="Masukkan Domisili"
                value="{{ old('id_domisili', $penduduk->id_domisili) }}" required>
            @error('id_domisili')
                <small class="error invalid-feedback"
                    role="alert">{{ $message }}</small>
            @enderror
        </div> --}}

        <div class="form-group">
            <label for="id_domisili">{{ __('Domisili*') }}</label>
            <select class="form-control @error('id_domisili') is-invalid @enderror" name="id_domisili" id="id_domisili"
                required>
                <option value="" disabled selected>{{ __('Pilih Domisili') }}
                </option>
                @foreach ($domisili as $item)
                    <option value="{{ $item->id }}"
                        {{ old('id_domisili', $penduduk->id_domisili ?? '') == $item->id ? 'selected' : '' }}>
                        {{ $item->uraian }}
                    </option>
                @endforeach
            </select>
            @error('id_domisili')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="rt">{{ __('RT*') }}</label>
            <input type="number" name="rt" class="form-control @error('rt') is-invalid @enderror" id="rt"
                placeholder="Masukkan RT" value="{{ old('rt', $penduduk->rt) }}" min="1" max="999" required
                readonly>
            @error('rt')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="rw">{{ __('RW*') }}</label>
            <input type="number" name="rw" class="form-control @error('rw') is-invalid @enderror" id="rw"
                placeholder="Masukkan RW" value="{{ old('rw', $penduduk->rw) }}" min="1" max="999" required
                readonly>
            @error('rw')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="tps">{{ __('TPS*') }}</label>
            <input type="text" name="tps" class="form-control @error('tps') is-invalid @enderror" id="tps"
                placeholder="Masukkan TPS" value="{{ old('tps', $penduduk->tps) }}" required readonly>
            @error('tps')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="kode_kec">{{ __('Kecamatan*') }}</label>
            <select class="form-control @error('kode_kec') is-invalid @enderror" name="kode_kec" id="kode_kec"
                required disabled>
                <option value="" disabled selected>{{ __('Pilih Kecamatan') }}
                </option>
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
                required disabled>
                <option value="" disabled selected>{{ __('Pilih Kelurahan') }}
                </option>
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

        <div class="form-group">
            <label for="id_paslon">{{ __('Paslon*') }}</label>
            {{-- <input type="text" name="id_paslon"
                class="form-control @error('id_paslon') is-invalid @enderror"
                id="id_paslon" placeholder="Masukkan Nama Paslon"
                value="{{ old('id_paslon', $penduduk->id_paslon) }}" required> --}}
            <select class="form-control @error('id_paslon') is-invalid @enderror" name="id_paslon" id="id_paslon"
                required>
                <option value="" disabled selected>{{ __('Pilih Paslon') }}
                </option>
                @foreach ($paslon as $item)
                    <option value="{{ $item->id }}"
                        {{ old('id_paslon', $penduduk->id_paslon ?? '') == $item->id ? 'selected' : '' }}>
                        {{ $item->uraian }}
                    </option>
                @endforeach
            </select>
            @error('id_paslon')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="keterangan">{{ __('Keterangan') }}</label>
            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                placeholder="Masukkan Keterangan" rows="4">{{ old('keterangan', $penduduk->keterangan) }}</textarea>
            @error('keterangan')
                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
