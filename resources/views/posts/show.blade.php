@extends('layouts.base')

@section('title','Chi tiết')

@section('main')
    
        <h1 class="text-danger">{{ $post->title }}</h1>
        <p class="fw-bold font-italic">Bài hát: {{ $post->song_name }}</p>
        <p>Thể loại: {{ $post->category_name }}</p>
        <p>Tóm tắt: {{ $post->summary }}</p>
        <p>Nội dung: {{ $post->content }}</p>
        <p>Tác giả: {{ $post->author_name }}</p>
        <p>Ngày tạo: {{ $post->written_date }}</p>
        <img src="{{ asset($post->image) }}" alt="Ảnh bài viết" style="width: 800px; height: 400px;">

@endsection