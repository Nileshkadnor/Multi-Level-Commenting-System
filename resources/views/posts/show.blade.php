@extends('layouts.app')

@section('content')
    <!-- Post Card -->
    <div class="card mb-4">
        <div class="card-body">
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->content }}</p>
        </div>
    </div>

    <!-- Success or Error Flash Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Laravel Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Comment Form (Top-level) -->
    <div class="card mb-4">
        <div class="card-header">Add a Comment</div>
        <div class="card-body">
            <form action="{{ route('comments.store', $post) }}" method="POST">
                @csrf
                <input type="hidden" name="parent_id" value="">
                <div class="mb-2">
                    <textarea name="content" rows="3" class="form-control" placeholder="Your comment..." >{{ old('content') }}</textarea>
                    @error('content')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button class="btn btn-primary btn-sm">Submit</button>
            </form>
        </div>
    </div>

    <!-- Display Comments -->
    <h5>Comments</h5>
    @include('posts.partials.comment-tree', ['comments' => $post->comments])
@endsection
