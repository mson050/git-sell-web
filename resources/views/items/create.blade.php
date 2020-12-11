@extends('layout.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                 <div class="card">
                    
                    <form style="margin: 20px 20% 20px 20%" enctype="multipart/form-data" action="{{ route('items.store') }}" method="POST" role="form">
                        @csrf
                        <div class="card-header">
                            <legend>Tạo mới sản phẩm</legend>
                        </div>

                        <div class="form-group">
                            <label for="">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="name" id="" placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Chi tiết sản phẩm</label>
                            <input type="text" class="form-control" name="detail" id="" placeholder="Nhập chi tiết sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Giá sản phẩm</label>
                            <input type="text" class="form-control" name="price" id="" placeholder="Nhập giá sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Màu sản phẩm</label>
                            <input type="text" class="form-control" name="color" id="" placeholder="Nhập màu sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Số lượng sản phẩm</label>
                            <input type="text" class="form-control" name="quantity" id="" placeholder="Nhập trạng thái sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Chọn loại sản phẩm</label>
                            <select name="category" id="">
                                @php
                                    $categories = App\Models\Category::all();
                                @endphp
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Chọn ảnh sản phẩm</label>
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