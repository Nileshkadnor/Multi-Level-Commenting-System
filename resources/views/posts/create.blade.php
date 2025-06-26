@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Create New Post</h4>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" name="title" id="title" class="form-control" >
                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Post Content</label>
                <textarea name="content" id="content" rows="5" class="form-control" ></textarea>
                @error('content') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
</div>
@endsection
