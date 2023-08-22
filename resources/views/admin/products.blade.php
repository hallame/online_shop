@extends('admin_layout.master')
@section('title')
    Products
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Products</h3>
              </div>
              <!-- /.card-header -->
              @if (Session::has("status"))
                        <div class="alert alert-success">
                          {{Session::get("status")}}
                        </div>
              @endif
              <input type="hidden" value="{{$counter = 1}}">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Num.</th>
                    <th>Picture</th>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Product Price</th>
                    <th>Product Discount Price</th>
                    <th>Product Category</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $product)
                    <tr>
                      <td>{{$counter}}</td>
                      <td>
                          <img src="{{asset('storage/product_images/'.$product->product_image)}}" style="height : 50px; width : 50px" class="img-circle elevation-2" alt="{{$product->product_image}}">
                      </td>
                      <td>{{$product->product_name}}</td>
                      <td>{{$product->product_description}}</td>
                      <td>${{$product->product_price}}</td>
                      <td>${{$product->product_discount_price}}</td>
                      <td>{{$product->product_category}}</td>
                      <td>
                        @if ($product->status==1)
                        <form action="{{url('admin/unactivateproduct/'.$product->id)}}" method="POST">
                          @csrf
                          @method('PUT')
                          <input type="submit" class="btn btn-success" value="Unactivate">
                        </form>
                        @else
                        <form action="{{url('admin/activateproduct/'.$product->id)}}" method="POST">
                          @csrf
                          @method('PUT')
                          <input type="submit" class="btn btn-warning" value="Activate">
                        </form>
                        @endif
                        <a href="{{url('admin/editproduct/'.$product->id)}}" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                        <form action="{{url('admin/deleteproduct/'.$product->id)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <input type="submit" id="delete" class="btn btn-danger" value="Delete">
                        </form>
                        
                      </td>
                    </tr>
                    <input type="hidden" value="{{$counter++}}">
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Num.</th>
                    <th>Picture</th>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Product Price</th>
                    <th>Product Discount Price</th>
                    <th>Product Category</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection