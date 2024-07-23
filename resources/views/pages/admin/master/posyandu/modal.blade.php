@can($globalModule['create'])
    <x-mollecules.modal id="add-posyandu_modal" action="{{ route('master.posyandu.store') }}" tableId="posyandu-table">
        <x-slot:title>Tambah Posyandu</x-slot:title>

        <div class="row">

            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="nama_posyandu" required>Nama Posyandu</x-atoms.form-label>
                <x-atoms.input name="nama_posyandu" id="nama_posyandu" placeholder="Nama Posyandu" />
            </div>
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="nomor_hp" required>Kontak</x-atoms.form-label>
                <x-atoms.input name="nomor_hp" id="nomor_hp" placeholder="Kontak" />
            </div>
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="email" required>Email</x-atoms.form-label>
                <x-atoms.input name="email" id="email" placeholder="Email" />
            </div>
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="alamat" required>Alamat</x-atoms.form-label>
                <x-atoms.input name="alamat" id="alamat" placeholder="Alamat" />
            </div>
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="kecamatan_id" required>Kecamatan</x-atoms.form-label>
            <x-atoms.select2 name="kecamatan_id" id="kecamatan_id" placeholder="Pilih Kecamatan"
                source="{{ route('reference.kecamatan') }}" />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="kelurahan_id" required>Kelurahan</x-atoms.form-label>
            <x-atoms.select2 name="kelurahan_id" id="kelurahan_id" placeholder="Pilih Kelurahan"
                source="{{ route('reference.kelurahan') }}" disabled />
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="rt" required>RT</x-atoms.form-label>
                <x-atoms.input name="rt" id="rt" placeholder="RT" />
            </div>
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="rw" required>RW</x-atoms.form-label>
                <x-atoms.input name="rw" id="rw" placeholder="RW" />
            </div>
        </div>

        <x-slot:footer>
            <button class="btn-primary btn" type="submit">Tambah</button>
        </x-slot:footer>
    </x-mollecules.modal>
@endcan

@can($globalModule['update'])
    <x-mollecules.modal id="edit-posyandu_modal" action="/master/posyandu/{id}" tableId="posyandu-table" method="PUT">
        <x-slot:title>Edit Posyandu</x-slot:title>

        <div class="row">

            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="nama_posyandu" required>Nama Posyandu</x-atoms.form-label>
                <x-atoms.input name="nama_posyandu" id="nama_posyandu2" placeholder="Nama Posyandu" />
            </div>
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="nomor_hp" required>Kontak</x-atoms.form-label>
                <x-atoms.input name="nomor_hp" id="nomor_hp2" placeholder="Kontak" />
            </div>
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="email" required>Email</x-atoms.form-label>
                <x-atoms.input name="email" id="email2" placeholder="Email" />
            </div>
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="alamat" required>Alamat</x-atoms.form-label>
                <x-atoms.input name="alamat" id="alamat2" placeholder="Alamat" />
            </div>
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="kecamatan_id" required>Kecamatan</x-atoms.form-label>
            <x-atoms.select2 name="kecamatan_id" id="kecamatan_id2" placeholder="Pilih Kecamatan"
                source="{{ route('reference.kecamatan') }}" />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="kelurahan_id" required>Kelurahan</x-atoms.form-label>
            <x-atoms.select2 name="kelurahan_id" id="kelurahan_id2" placeholder="Pilih Kelurahan"
                source="{{ route('reference.kelurahan') }}" />
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="rt" required>RT</x-atoms.form-label>
                <x-atoms.input name="rt" id="rt2" placeholder="RT" />
            </div>
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="rw" required>RW</x-atoms.form-label>
                <x-atoms.input name="rw" id="rw2" placeholder="RW" />
            </div>
        </div>

        <x-slot:footer>
            <button class="btn-primary btn" type="submit">Save</button>
        </x-slot:footer>
    </x-mollecules.modal>
@endcan
@push('scripts')
    <script>
        $(document).ready(function() {

            $('[name="kecamatan_id"]').on('change', function() {
                const modal = $(this).closest('.modal');
                const kecamatan_id = modal.find('[name="kecamatan_id"]')
                const kelurahan_id = modal.find('[name="kelurahan_id"]');

                if (!kecamatan_id.val()) {
                    kelurahan_id.empty();
                    kelurahan_id.attr('disabled', true);
                    return;
                }

                kelurahan_id.empty();
                kelurahan_id.attr('disabled', false);

                const kelurahanSelect2Setting = {
                    dropdownParent: modal,
                    allowClear: true,
                    ajax: {
                        url: `{{ route('reference.kelurahan') }}`,
                        data: function(params) {
                            return {
                                search: params.term,
                                kecamatan_id: kecamatan_id.val()
                            }
                        },
                        processResults: function(data) {
                            return {
                                results: data.data
                            }
                        }
                    }
                }
                kelurahan_id.select2(kelurahanSelect2Setting);
            });
        })
    </script>
@endpush
