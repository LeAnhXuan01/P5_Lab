<!-- search.blade.php -->

@extends('layouts.base')

@section('main')
   
        <h1>Kết quả tìm kiếm cho "{{ $keyword }}"</h1>

        @if ($posts->count() > 0)
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Mã bài viết</th>
                        <th>Tên bài viết</th>
                        <th>Tên bài hát</th>
                        <th>Tên tác giả</th>
                        <th>Tên thể loại</th>
                        <th>Ngày viết</th>
                        <th>Ảnh</th>
                        <th>Chi tiết</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $counter = 1;
                    @endphp
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->song_name }}</td>
                            <td>{{ $post->author_name }}</td>
                            <td>{{ $post->category_name }}</td>
                            <td>{{ $post->written_date }}</td>
                            <td><img src="{{ $post->image }}" alt="Ảnh bài viết" style="width: 300px; height: 150px;"></td>
                            <td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a></td>
                            <td><a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm"><i style='font-size:15px' class='fas'>&#xf4fe;</i></a></td>
                            {{-- <td><form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class='fas fa-user-minus'></i></button>
                                </form>
                            </td> --}}
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $post->id }}">
                                    <i class='fas fa-user-minus'></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="confirmDeleteModal{{ $post->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel{{ $post->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">  
                                                <h5 class="modal-title" id="confirmDeleteModalLabel{{ $post->id }}">Xác nhận xóa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc chắn muốn xóa bài viết này?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Không tìm thấy kết quả phù hợp.</p>
        @endif
    </div>
@endsection
