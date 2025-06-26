@foreach($comments as $comment)
    <div class="mb-3 ms-{{ $comment->depth * 4 }}">
        <div class="border p-2 bg-light rounded">
            <p class="mb-1">{{ $comment->content }}</p>
            <small class="text-muted">Depth: {{ $comment->depth }}</small>

            @if($comment->canReply())
                <form action="{{ route('comments.store', $comment->post) }}" method="POST" class="mt-2">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                    <div class="mb-2">
                        <textarea name="content" rows="2" class="form-control mb-1" placeholder="Reply..." >{{ old('parent_id') == $comment->id ? old('content') : '' }}</textarea>

                        {{-- Show validation only if it's for this reply --}}
                        @if ($errors->has('content') && old('parent_id') == $comment->id)
                            <small class="text-danger">{{ $errors->first('content') }}</small>
                        @endif
                    </div>

                    <button class="btn btn-sm btn-outline-primary">Reply</button>
                </form>
            @endif
        </div>

        {{-- Recursive inclusion of replies --}}
        @if($comment->replies)
            @include('posts.partials.comment-tree', ['comments' => $comment->replies])
        @endif
    </div>
@endforeach
