@extends('layout.admin')

@section('title')
    Admin Section - {{($isEdit = isset($post)) ? 'Edit' : 'Create'}} Post
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>{{$isEdit ? 'Edit' : 'Create'}} Post</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{$isEdit ? route('posts.update', $post->id) : route('posts.store')}}">
                @csrf

                @if($isEdit)
                    <input type="hidden" name="_method" value="PUT">
                @endif
                <div class="row form-group">
                    <div class="col-m-5">
                        <label class="form-label" for="title">Title</label>
                    </div>
                    <div class="col-m-7">
                        <input value="{{old('title') ?: $isEdit ? $post->title : ''}}" class="form-element" name="title" id="title" type="text">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-m-5">
                        <label class="form-label" for="slug">Slug</label>
                    </div>
                    <div class="col-m-7">
                        <input value="{{old('slug') ?: $isEdit ? $post->slug : ''}}" class="form-element" type="text" name="slug" id="slug">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-m-5">
                        <label class="form-label" for="meta">Meta Description</label>
                    </div>
                    <div class="col-m-7">
                        <input value="{{old('meta') ?: $isEdit ? $post->meta : ''}}" class="form-element" type="text" id="meta" name="meta">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-m-5">
                        <label class="form-label" for="body">Body</label>
                    </div>
                    <div class="col-m-7">
                        <textarea class="form-element" name="body" id="body" cols="30" rows="10">{{old('body') ?: $isEdit ? $post->getOriginal('body') : ''}}
                        </textarea>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-12 text-right">
                        <input type="submit" class="btn btn-blue" value="Save">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
