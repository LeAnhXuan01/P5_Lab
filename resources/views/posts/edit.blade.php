@extends('layouts.base')

@section('title','Sửa bài viết')

@section('main')
        <h1 class="text-center">Sửa bài viết</h1>
        <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Tên tiêu đề:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" required>
            </div>
            <div class="form-group">
                <label for="song_name">Tên bài hát:</label>
                <input type="text" name="song_name" id="song_name" class="form-control" value="{{ $post->song_name }}" required>
            </div>
            <div class="form-group">
                <label for="author_id">Tên tác giả:</label>
                <select name="author_id" id="author_id" class="form-control" required>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}" @if($author->id == $post->author_id) selected @endif>{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="category_id">Thể loại:</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == $post->category_id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="written_date">Ngày tạo:</label>
                <input type="datetime-local" name="written_date" id="written_date" class="form-control" value="{{ $post->written_date }}" required>
            </div>
            <div class="form-group mt-3 mb-3">
                <label for="current_image">Ảnh hiện tại:</label>
                @if($post->image)
                    <img src="{{ asset($post->image) }}" alt="Current Image" style="max-width: 300px; max-height:200px">
                @else
                    <p>Không có ảnh.</p>
                @endif
            </div>
            <div class="form-group">
                <label for="image">Thay đổi ảnh:</label>
                <input type="file" name="image" id="image">
            </div>

            <button type="submit" class="btn btn-primary mt-3" style="width: 200px;" >Lưu</button>
        </form>
@endsection
