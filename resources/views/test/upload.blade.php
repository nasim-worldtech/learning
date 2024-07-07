@extends('layout.app')
@section('content')
    <div class="w-25 mt-5 mx-auto my-auto">
        @if (session()->has('success'))
            <div class="text-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('test.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <select class="form-select" name="disk" aria-label="Default select example">
                    <option value="" selected>Select disk</option>
                    <option value="public">public</option>
                    <option value="documents">documents</option>
                </select>
                @error('disk')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="file" name="avatar" class="form-control" value="{{ old('avatar') }}"
                    id="exampleFormControlInput1">
            </div>
            @error('avatar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
    <x-show-data :files=$files />
@endsection
