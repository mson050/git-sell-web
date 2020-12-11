@extends('layout.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Danh sách loại sản phẩm</h1>
                </div>

                    <table style="margin-top: 20px" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><h5>ID</h5> </th>
                                <th><h5>Tên loại sản phẩm</h5></th>
                                <th><h5>Action</h5></th>
                            </tr>
                        </thead>
                        <tbody>
                         
                        </tbody>
                    </table>

                    {{ $invoices->appends($_GET) }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection