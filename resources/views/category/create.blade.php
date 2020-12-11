@extends('layout.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                 <div class="card">
                    
                    <form style="margin: 20px 20% 20px 20%" action="{{ route('categories.store') }}" method="POST" role="form">
                        @csrf
                        <div class="card-header">
                            <legend>Tạo mới loại sản phẩm</legend>
                        </div>

                        <div class="form-group">
                            <label for="">Tên loại sản phẩm</label>
                            <input type="text" class="form-control" name="name" id="" placeholder="Nhập tên loại sản phẩm">
                        </div>

                        <button type="submit" class="btn btn-primary">Tạo mới</button>
                    </form>
                    
                 </div>
            </div>
        </div>
    </div>
@endsection