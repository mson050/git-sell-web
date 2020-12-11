@extends('layout.admin')
@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Danh sách sản phẩm</h1>
                    </div>

                    <div class="card-body">
                        <a href="{{ route('items.create') }}" class="btn btn-primary">Tạo mới sản phẩm</a>

                        <form style="float: right" action="" method="GET" class="form-inline" role="form">
                            <div class="form-group">
                                <label class="sr-only" for=""></label>
                                <input type="text" name="keyword" class="form-control" value="{{ request()->input('keyword') }}" id="" placeholder="Keyword">
                            </div>

                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                        <table style="margin-top: 20px" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><h5>ID</h5> </th>
                                    <th><h5>Tên sản phẩm</h5></th>
                                    <th><h5>Chi tiết sản phẩm</h5></th>
                                    <th><h5>Số lượng sản phẩm</h5></th>
                                    <th><h5>Giá</h5></th>
                                    <th><h5>Màu sản phẩm</h5></th>
                                    <th><h5>Loại sản phẩm</h5></th>
                                    <th><h5>Ảnh sản phẩm</h5></th>
                                    <th><h5>Action</h5></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->detail }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->color }}</td>
                                        <td>
                                            @if ($item->category)
                                                {{ $item->category->name}}
                                            @endif
                                        </td>
                                        <td> 
                                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                                            <div class="image">
                                                <img src="/uploads/images/{{ $item->image }}" class="img-circle elevation-2" alt="Item Image">
                                            </div>
                                        </div>
                                        </td>
                                        <td> <a href="{{ route('items.edit',$item->id)  }}" class="btn btn-primary">Edit</a>  
                                            
                                            <form action="{{  route('items.destroy',$item->id)   }}" method="POST" role="form">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $items->appends($_GET) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection