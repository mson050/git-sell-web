@extends('layout.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
             <div class="card">
                <form style="margin : 20px 20%" enctype="multipart/form-data" action="{{ route('categories.update',$category->id) }}" method="POST" role="form">
                    @csrf
                    @method('put')
                    <div class="card-header">
                        <legend>Cập nhật loại sản phẩm</legend>
                    </div>

                    <div class="form-group">
                        <label for="">Tên loại sản phẩm</label>
                        <input type="text" value="{{ $category->name }}" class="form-control" name="name" id="" placeholder="Nhập tên sản phẩm">
                    </div>
                   

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
                
             </div>
        </div>
    </div>
</div>
@endsection