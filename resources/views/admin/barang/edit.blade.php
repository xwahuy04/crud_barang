@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Edit Barang</h4>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('barang.update', $barang->kode_barang) }}" id="editForm" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-4">
                            <label>Upload Gambar</label>
                            <div class="dropzone" id="imageUploadEdit"></div>
                            <input type="hidden" name="gambar" id="uploadedFile" value="{{ $barang->gambar }}">
                            @if ($barang->gambar)
                                <div class="mt-2">
                                    <small>Gambar saat ini:</small>
                                    <img src="{{ asset('images/' . $barang->gambar) }}" alt="Gambar Barang"
                                        style="max-width: 200px;" class="img-thumbnail">
                                </div>
                            @endif
                        </div>
                        <div class="mb-4">
                            <label for="kode_barang" class="form-label fw-semibold">Kode Barang</label>
                            <input type="text" name="kode_barang" class="form-control" id="kode_barang"
                                placeholder="Masukkan kode barang" value="{{ $barang->kode_barang }}" required>
                            @error('kode_barang')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="nama_barang" class="form-label fw-semibold">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" id="nama_barang"
                                placeholder="Masukkan nama barang" value="{{ $barang->nama_barang }}" required>
                            @error('nama_barang')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi </label>
                            <input type="text" name="deskripsi" class="form-control" id="deskripsi"
                                placeholder="Masukkan deskripsi" value="{{ $barang->deskripsi }}" required>
                            @error('deskripsi')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="kategori_id" class="form-label fw-semibold">Kategori</label>
                            <select name="kategori_id" class="form-control" id="kategori_id" required>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}"
                                        {{ $barang->kategori_id == $kat->id ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="stok" class="form-label fw-semibold">Stok</label>
                            <input type="number" name="stok" class="form-control" id="stok"
                                placeholder="Masukkan stok" value="{{ $barang->stok }}" required>
                            @error('stok')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <button type="reset" class="btn btn-light" onclick="window.history.back()">Kembali</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-check me-2"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
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

    .dz-success-mark,
    .dz-error-mark {
        display: none;
    }
</style>
@endsection

@section('scripts')
<script>
    // Inisialisasi Dropzone untuk edit
    Dropzone.autoDiscover = false;

    $(document).ready(function() {
        // Konfigurasi Dropzone
        var myDropzone = new Dropzone("#imageUploadEdit", {
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
                // Jika ada gambar lama, tampilkan preview
                // @if ($barang->gambar)
                //     var mockFile = {
                //         name: "{{ $barang->gambar }}",
                //         size: 0,
                //         accepted: true
                //     };
                //     this.emit("addedfile", mockFile);
                //     this.emit("complete", mockFile);
                //     this.files.push(mockFile);
                // @endif

                this.on("success", function(file, response) {
                    if (response.success) {
                        $('#uploadedFile').val(response.file_name);
                        file.previewElement.classList.add("dz-success");
                    } else {
                        this.removeFile(file);
                        alert(response.message);
                    }
                });

                this.on("removedfile", function(file) {
                    // Hapus file temp jika ada
                    if (file.name !== "{{ $barang->gambar }}") {
                        $.ajax({

                            type: "DELETE",
                            data: {
                                file_name: $('#uploadedFile').val(),
                                _token: "{{ csrf_token() }}"
                            }
                        });
                    }
                    $('#uploadedFile').val('');
                });

                this.on("error", function(file, message) {
                    this.removeFile(file);
                    alert(message);
                });
            }
        });

        // Handle form submit
        $('#editForm').submit(function(e) {
            e.preventDefault();
            $(this).find('button[type="submit"]').prop('disabled', true);
            this.submit();
        });
    });
</script>
@endsection
