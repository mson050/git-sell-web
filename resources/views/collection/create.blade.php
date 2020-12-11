@extends('layout.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                 <div class="card">
                    
                    <form enctype="multipart/form-data" style="margin: 20px 20% 20px 20%" action="{{ route('collections.store') }}" method="POST" role="form">
                        @csrf
                        <div class="card-header">
                            <legend>Tạo mới bộ sưu tập</legend>
                        </div>

                        <div class="form-group">
                            <label for="">Tên bộ sưu tập</label>
                            <input type="text" class="form-control" name="name" id="" placeholder="Nhập tên bộ sưu tập">
                        </div>
                        <div class="form-group">
                            <label for="">Chọn ảnh cho bộ sưu tập</label>
                            <br>
                            <input type="file" name="image" >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Tạo mới</button>
                    </form>
                    
                 </div>
            </div>
        </div>
    </div>
@endsection