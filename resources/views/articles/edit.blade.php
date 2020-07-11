@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit article</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('articles.update', $article->id ) }}">
                        @csrf
                        @method('patch')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Title</label>

                            <div class="col-md-6">
                                <input
                                    id="title"
                                    type="text"
                                    class="form-control @error('title') is-invalid @enderror"
                                    name="title"
                                    value="{{ $article->title ?? old('title') }}"
                                    autofocus
                                />

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Content</label>

                            <div class="col-md-6">
                                <textarea
                                    id="content"
                                    type="text"
                                    rows="5"
                                    class="form-control @error('content') is-invalid @enderror"
                                    name="content"
                                >{{ $article->content ?? old('content') }}</textarea>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Tag</label>

                            <div class="col-md-6">
                                <select name="tag" id="tag" class="form-control">
                                    <option value="" disabled selected>Select a tag</option>
                                    <option {{ $article->tag == 'Food' ? 'selected' : '' }} value="Food">Food</option>
                                    <option {{ $article->tag == 'Travel' ? 'selected' : '' }} value="Travel">Travel</option>
                                    <option {{ $article->tag == 'Technology' ? 'selected' : '' }} value="Technology">Technology</option>
                                </select>

                                @error('tag')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Post
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
