@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Post') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="/post/{{$post->id}}" method="post"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="">Post Title</label>
                            <input type="text" name="title" class="form-control" value="{{$post->title}}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Post Body</label>
                            <textarea name="body" id="" cols="30" rows="10" class="form-control">{{$post->body}}</textarea>
                        </div>
                                                <div class="form-group mb-3">

                         <label for="">Post Image</label>
                            <input type="file" name="image" class="form-control mb-3">
                            <img src="{{ asset('uploads/posts/'.$post->image) }}" width="300" height="200" alt="Image">
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update Post</button>
                        </div>
                      </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
