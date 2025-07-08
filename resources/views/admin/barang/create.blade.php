@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Tambah Barang Baru</h4>
            </div>
        </div>
    </div>

    @include('layouts.partials.error-message')


    <div class="row mt-2">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('barang.store') }}" method="POST" id="barangForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Upload Gambar</label>
                            <div class="dropzone" id="imageUpload"></div>
                            <input type="hidden" name="gambar" id="uploadedFile">
                            <small class="text-muted">Format: JPEG, PNG, GIF (Max 5MB)</small>
                            @error('gambar')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="kode_barang" class="form-label fw-semibold">Kode Barang</label>
                            <input type="text" name="kode_barang" class="form-control" id="kode_barang"
                                value="{{ $kode_barang }}" readonly>
                            @error('kode_barang')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="nama_barang" class="form-label fw-semibold">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" id="nama_barang"
                                placeholder="Masukkan nama barang">
                            @error('nama_barang')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" id="deskripsi"
                                placeholder="Masukkan deskripsi">
                            @error('deskripsi')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="kategori_barang" class="form-label fw-semibold">Kategori Barang</label>
                            <select name="kategori_id" class="form-select" id="kategori_barang">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_barang')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="stok" class="form-label fw-semibold">Stok Awal</label>
                            <input type="number" name="stok" class="form-control" id="stok"
                                placeholder="Masukkan stok">
                            @error('stok')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <button type="reset" class="btn btn-light"onclick="window.history.back()">Kembali</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-check me-2"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('styles')
        <style>
            .dropzone {
                border: 2px dashed #0087F7;
                border-radius: 5px;
                background: #f8f9fa;
                min-height: 150px;
                padding: 20px;
            }

            .dropzone .dz-preview .dz-image {
                border-radius: 5px;
            }
        </style>
    @endsection

@endsection

@section('scripts')
<script>
    // Inisialisasi Dropzone
    Dropzone.autoDiscover = false;

    $(document).ready(function() {
        var myDropzone = new Dropzone("#imageUpload", {
            url: "{{ route('barang.upload-temp') }}",
            paramName: "file",
            maxFilesize: 5, // MB
            acceptedFiles: "image/jpeg,image/png,image/gif",
            maxFiles: 1,
            addRemoveLinks: true,
            autoProcessQueue: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            init: function() {
                this.on("success", function(file, response) {
                    if (response.success) {
                        $('#uploadedFile').val(response.file_name);
                        // Tampilkan preview
                        if (file.previewElement) {
                            file.previewElement.classList.add("dz-success");
                        }
                    } else {
                        this.removeFile(file);
                        alert(response.message);
                    }
                });
                this.on("removedfile", function(file) {
                    $.ajax({
                        url: "{{ route('barang.upload-temp') }}",
                        type: "DELETE",
                        data: {
                            file_name: $('#uploadedFile').val(),
                            _token: "{{ csrf_token() }}"
                        },
                        success: function() {
                            $('#uploadedFile').val('');
                        }
                    });
                });
                this.on("error", function(file, message) {
                    this.removeFile(file);
                    alert(message);
                });
            }
        });

        // Pastikan form tidak submit ganda
        $('#barangForm').submit(function(e) {
            e.preventDefault();
            $(this).find('button[type="submit"]').prop('disabled', true);
            this.submit();
        });
    });
</script>
@endsection
