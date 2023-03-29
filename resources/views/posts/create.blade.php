@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Post') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="/post" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Post Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Post Body</label>
                            <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group mb-3">
                           <label  for="">Post Image</label>
                                <input type="file" name="image"  class="form-control">
                        </div>


                        <button type="submit" class="btn btn-primary">Save Post</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
