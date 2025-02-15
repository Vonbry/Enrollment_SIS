@extends('layouts.app')

@section('content')
    <div class="container1 mt-4">
        <h1 class="h1">Edit Subject</h1>
        
            <form action="{{ route('subjects.update', $subject) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="code" class="form-label">Subject Code</label>
                    <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $subject->code) }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Subject Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $subject->name) }}">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="units" class="form-label">Units</label>
                    <input type="number" name="units" id="units" class="form-control" value="{{ old('units', $subject->units) }}">
                    @error('units') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <x-primary-button type="submit">Update Subject</x-primary-button>
                <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
    </div>
@endsection
