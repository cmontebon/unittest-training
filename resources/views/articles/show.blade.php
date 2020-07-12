@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Auth::user()->can('update', $article))
            <div class="row justify-content-end my-3">
                <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-success">Edit</a>
            </div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>{{ $article->title }}</span>
                </div>

                <div class="card-body">
                    {{ $article->content }}
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <span>Tag: {{ $article->tag }}</span>
                    <span>by {{ $article->author->name }}</span>
                </div>
            </div>
        </div>

        @if ($article->comments->count())
        <div class="col-md-8 mt-5">
            <div class="card-header bg-dark text-white">Comments</div>

            @foreach ($article->comments as $comment)
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between align-bottom">
                        <span>{{ $comment->author->name }}</span>
                        @if (auth()->user()->id === $comment->user_id)
                        <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                        </form>

                        @endif
                    </div>
                    <div class="card-body">
                        {{ $comment->comment }}
                    </div>
                </div>

            @endforeach
        </div>
        @endif

        <div class="col-md-8 my-5">
            <div class="card">
                <div class="card-header bg-dark text-white">Leave a comment</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('comment.store') }}">
                        @csrf

                        <input type="hidden" value="{{ $article->id }}" name="article_id" />

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">Message</label>

                            <div class="col-md-10">
                                <textarea
                                    id="comment"
                                    type="text"
                                    rows="5"
                                    class="form-control @error('comment') is-invalid @enderror"
                                    name="comment"
                                    value="{{ old('comment') }}"
                                ></textarea>

                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-2 offset-md-10">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
