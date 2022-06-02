@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card shadow">

            <div class="card-header py-3 d-flex justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">Edit Kategori</h5>
                <a href="{{ route('category.index') }}" class="btn btn-primary float-right">Kembali</a>
            </div>

            <div class="card-body">
                <x-input-error />

                <form action="{{ route('category.update', $category->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <label for="">Nama Kategori </label>
                        <small class="text-primary d-block mb-3">Slug akan dibuat otomatis!</small>
                        <input type="text" name="name" value="{{ $category->name }}" placeholder="Category name"
                            class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Gambar </label>
                        <input type="file" name="image" value="{{ old('image') }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="status" class="col-form-label">Status </label>
                        <select name="status" class="form-control">
                            <option value="1" {{ $category->status == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $category->status == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary my-3">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#is_parent').change(function() {
                var is_checked = $('#is_parent').prop('checked');
                // alert(is_checked);
                if (is_checked) {
                    $('#parent_categories').addClass('d-none');
                    $('#parent_categories').val('');
                } else {
                    $('#parent_categories').removeClass('d-none');
                }
            })

            $('#deleteCategoryBtn').click(function(e) {
                e.preventDefault();
                if (confirm('Anda yakin ingin menghapus Kategori ini?')) {
                    $('#deleteCategoryForm').submit();
                }
            });
        });
    </script>
@endpush
