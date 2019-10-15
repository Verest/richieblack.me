@extends('layout.admin')

@section('title')
    Admin Section - View All Posts
@endsection

@section('js')
    <script>
        $(function() {
            $('.delete').on('click', function(e) {
                const $postId = $(e.target).data('id');
                $.ajax({
                    url: "{{ url()->current() }}" + "/" + $postId,
                    data: {
                        "_method": "Delete",
                    },
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    method: "DELETE",
                }).done(function(res) {
                    location.reload();
                })
            })
        });
    </script>
@endsection

@section('content')
    <div id="admin-view-blog" class="row">
        <div class="col-s-8">
            <h1>Edit Posts</h1>
        </div>

        <div class="col-s-4 new-button-container">
            <a href="{{route('posts.create')}}" class="btn btn-blue">Make New</a>
        </div>

        <div class="col-12">
            {{--    todo table--}}
            <table>
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Slug</th>
                    <th>Title</th>
                    <th>Created</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->created_at->toDateString() }}</td>
                        <td>
                            <a href="{{route('posts.edit', $post->id)}}" class="btn btn-green mb-vr">Edit</a><br>
                            <button data-id="{{$post->id}}" class="btn btn-brown delete">Delete</button>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
