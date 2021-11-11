<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body>
    <div class="card">
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="card-header">
              <div class="row">
                <div class="col-8">
                <h3 style="font-size: 35px;">Order Form</h3>
                </div>
                <div class="col-4">
                <form class="form-inline my-2 my-lg-0" style="float: right;" action="{{route('order.search')}}" method="POST">
                  @csrf
                  
                  <input type="search" name="search" class="form-control me-sm-2" placeholder="Search Place">
                  
                </form>
                </div>
              </div>
            </div>
            <!-- ./row -->
        <div class="row">
          <div class="col-12 col-sm-6 col-lg-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">New Order</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Order List</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                      <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                          <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{route('order.form')}}">All</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="{{route('order.main')}}">Main</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link active" href="{{route('order.burmese')}}">Burmese</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link active" href="{{route('order.japanese')}}">Japanese</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </nav>
                    <form action="{{route('order.submit')}}" method="POST">
                        @csrf
                        <div class="row">
                          
                            @foreach($dishes as $dish)
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="{{url('/images/'.$dish->image)}}" width="200" height="150"><br>
                                        <label for="">{{$dish->name}}</label><br>
                                        <input type="number" value="0" name="{{$dish->id}}">
                                    </div>
                                </div>
                            </div>
                            
                            @endforeach

                            
                        </div>

                        <div class="form-group">
                            <select name="table" style="width: 70px;">
                                @foreach($tables as $table)
                                <option class="form-control" value="{{$table->id}}">{{$table->number}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" class="btn btn-success" value="submit">
                    </form>     
                </div>
                  <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                     <table class="table table-bordered table-hover">
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
                              <a href="/order/{{$order->id}}/serve" class="btn btn-warning">Serve</a>
                            </div>
                          </td>
                        </tr>
                    @endforeach
                  
                  </tbody>
                     </table>
                  </div>
                </div>
              </div>
            
              <!-- /.card -->
            </div>
          </div>
        </div>
        </div>
    </div>
        
</body>
<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/plugins/jszip/jszip.min.js"></script>
<script src="/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
</html>