@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Kitchen Panel</h1>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order Listing</h3>
              </div>
            <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
                <table id="dishes" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    
                    <th>Dish Name</th>
                    <th>Table Number</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  
                  <tbody>
                    @foreach($orders as $order)
                        <tr>
                          
                          <td>{{$order->dish->name}}</td>
                          <td>{{$order->table_id}}</td>
                          <td>{{$status[$order->status]}}</td>
                          <td>
                            <div>
                              <a href="/order/{{$order->id}}/approve" class="btn btn-primary">Approve</a>
                              <a href="/order/{{$order->id}}/cancel" class="btn btn-danger">Cancel</a>
                              <a href="/order/{{$order->id}}/ready" class="btn btn-success">Ready</a>
                            </div>
                          </td>
                        </tr>
                    @endforeach
                  
                  </tbody>
                </table>
              </div>
            </div>

          </div>
          
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#dishes').DataTable({
      "paging": true,
      "pageLength": 10,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>