@can($globalModule['read'])
    <x-mollecules.modal id="detail-kader_modal" action="#" tableId="kader-table">
        <x-slot:title>Detail Kader</x-slot:title>
        <div class="mb-3">
            <x-atoms.form-label for="nama_lengkap">Nama Lengkap</x-atoms.form-label>
            <x-atoms.input name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" disabled />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="nik">NIK</x-atoms.form-label>
            <x-atoms.input name="nik" id="nik" placeholder="NIK" disabled />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="jenis_kelamin">Jenis Kelamin</x-atoms.form-label>
            <x-atoms.select placeholder="Pilih Jenis Kelamin" id="jenis_kelamin" name="jenis_kelamin" value="menu"
                :lists="[
                    'L' => 'Laki-Laki',
                    'P' => 'Perempuan',
                ]" disabled></x-atoms.select>
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="tempat_lahir">Tempat Lahir</x-atoms.form-label>
            <x-atoms.input name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" disabled />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="tanggal_lahir">Tanggal Lahir</x-atoms.form-label>
            <x-atoms.input type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" disabled />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="nomor_hp">Nomor HP</x-atoms.form-label>
            <x-atoms.input name="nomor_hp" id="nomor_hp" placeholder="Nomor HP" type="number" value="Nomor HP" disabled />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="email">Email</x-atoms.form-label>
            <x-atoms.input type="email" name="email" id="email" placeholder="Alamat Email" disabled />
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="rt">RT</x-atoms.form-label>
                <x-atoms.input name="rt" id="rt" placeholder="RT" disabled />
            </div>
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="rw">RW</x-atoms.form-label>
                <x-atoms.input name="rw" id="rw" placeholder="RW" disabled />
            </div>
        </div>
        <div class="mb-3">
            <div class="col-md-12">
                <x-atoms.form-label for="alamat">Alamat</x-atoms.form-label>
                <x-atoms.textarea name="alamat" id="alamat" placeholder="Alamat" disabled rows="4" />
            </div>
        </div>
        <div class=" mb-3">
            <x-atoms.form-label for="kecamatan_id">Kecamatan</x-atoms.form-label>
            <x-atoms.select2 name="kecamatan_id" id="kecamatan_id" placeholder="Pilih Kecamatan"
                source="{{ route('reference.kecamatan') }}" disabled allowClear="false" />
        </div>

        <div class=" mb-3">
            <x-atoms.form-label for="kelurahan_id">Kelurahan</x-atoms.form-label>
            <x-atoms.select2 name="kelurahan_id" id="kelurahan_id" placeholder="Pilih Kelurahan"
                source="{{ route('reference.kecamatan') }}" disabled allowClear="false" />
        </div>

        <div class="mb-3">
            <x-atoms.form-label for="posyandu_id">Posyandu</x-atoms.form-label>
            <x-atoms.select2 name="posyandu_id" id="posyandu_id" placeholder="Pilih Posyandu"
                source="{{ route('reference.kecamatan') }}" disabled allowClear="false" />
        </div>
        <x-slot:footer>

        </x-slot:footer>
    </x-mollecules.modal>
@endcan
