@extends('layouts.base')

{{-- Trien khai title --}}

@section('title', 'Thêm bài viết')

@section('main')
        <h1 class="text-center" >Thêm bài viết</h1>
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Tên bài viết:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="song_name">Tên bài hát:</label>
                <input type="text" name="song_name" id="song_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="author_id">Tên tác giả:</label>
                <select name="author_id" id="author_id" class="form-control" required>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="category_id">Tên thể loại:</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="written_date">Ngày viết:</label>
                <input type="datetime-local" name="written_date" id="written_date" class="form-control" required>
            </div>
            <div class="form-group mt-3">
                <label for="image">Ảnh bài viết</label>
                <input type="file" name="image" id="image" required>
            </div>            
            <button type="submit" class="btn btn-primary mt-4" style="width:200px;">Thêm</button>
        </form>
@endsection
