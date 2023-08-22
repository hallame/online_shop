@extends('admin_layout.master')
@section('title')
    Sliders
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sliders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sliders</li>
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
                <h3 class="card-title">All Sliders</h3>
              </div>
              <!-- /.card-header -->
              @if (Session::has("status"))
                        <div class="alert alert-success">
                          {{Session::get("status")}}
                        </div>
              @endif
              <input type="hidden" {{$counter = 1}}>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Num.</th>
                    <th>Picture</th>
                    <th>Description one</th>
                    <th>Description Two</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($sliders as $slider)
                    <tr>
                      <td>{{$counter}}</td>
                      <td>
                        <img src="{{asset('storage/slider_images/'.$slider->image)}}" style="height : 50px; width : 50px" class="img-circle elevation-2" alt="{{$slider->image}}">
                      </td>
                      <td>{{$slider->description1}}</td>
                      <td>{{$slider->description2}}</td>
                      <td>
                        @if ($slider->status==1)
                        <form action="{{url('admin/unactivateslider/'.$slider->id)}}" method="POST">
                          @csrf
                          @method('PUT')
                          <input type="submit" class="btn btn-success" value="Unactivate">
                        </form>
                        @else
                        <form action="{{url('admin/activateslider/'.$slider->id)}}" method="POST">
                          @csrf
                          @method('PUT')
                          <input type="submit" class="btn btn-warning" value="Activate">
                        </form>
                        @endif
                        
                        <a href="{{url('admin/editslider/'.$slider->id)}}" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                        <!--<a href="#" id="delete" class="btn btn-danger" ><i class="nav-icon fas fa-trash"></i></a>-->
                        <form action="{{url('admin/deleteslider/'.$slider->id)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <input type="submit" id="delete" class="btn btn-danger" value="Delete">
                        </form>
                        
                      </td>
                    </tr>
                    <input type="hidden" {{$counter++}}>
                        
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Num.</th>
                    <th>Picture</th>
                    <th>Description one</th>
                    <th>Description Two</th>
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
