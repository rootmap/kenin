
@extends("admin.layout.master")
@section("title","Rental Booking")
@section("content")
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Rental Booking</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('rentalbooking/create')}}">Create New </a></li>
                  <li class="breadcrumb-item active">Rental Booking Data</li>
                </ol>
              </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include("admin.include.msg")
                </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
        
        <section class="content">
          <div class="row">
            <div class="col-12">
              <!-- /.card -->
              <div class="card">

                <div class="card-header">
                  <h3 class="card-title">Rental Booking Data</h3>

                    <div class="card-tools">
                      <ul class="pagination pagination-sm float-right">
                        <li class="page-item">
                            <a class="page-link bg-primary" href="{{url('rentalbooking/create')}}"> 
                                Add New 
                                <i class="fas fa-plus"></i> 
                            </a>
                        </li>
                        <li class="page-item">
                          <a class="page-link" target="_blank" href="{{url('rentalbooking/export/pdf')}}">
                            <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                          </a>
                        </li>
                        <li class="page-item">
                          <a class="page-link" target="_blank" href="{{url('rentalbooking/export/excel')}}">
                            <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                          </a>
                        </li>
                      </ul>
                    </div>
                </div>


                
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Rental ID Name</th>
                            <th class="text-center">Rental Price</th>
                            <th class="text-center">Rent Start Date Time</th>
                            <th class="text-center">Rent End Date Time</th>
                            <th class="text-center">Customer Name</th>
                            <th class="text-center">Customer Phone</th>
                            <th class="text-center">Customer Email</th>
                            <th class="text-center">Booking Method</th>
                            <th class="text-center">Booking Status</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if(count($dataRow))
                            @foreach($dataRow as $row)  
                                <tr>
                                    <td class="text-center">{{$row->id}}</td><td class="text-center">{{$row->rental_id_name}}</td><td class="text-center">{{$row->rental_price}}</td><td class="text-center">{{$row->rent_start_date_time}}</td><td class="text-center">{{$row->rent_end_date_time}}</td><td class="text-center">{{$row->customer_name}}</td><td class="text-center">{{$row->customer_phone}}</td><td class="text-center">{{$row->customer_email}}</td><td class="text-center">{{$row->booking_method}}</td><td class="text-center">{{$row->booking_status}}</td>
                                    <td>{{formatDate($row->created_at)}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{url('rentalbooking/edit/'.$row->id)}}" type="button" class="btn btn-default">
                                                Edit 
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{url('rentalbooking/delete/'.$row->id)}}" type="button" class="btn btn-default">
                                                Delete 
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                
                                </tr>
                            @endforeach
                        @endif
                                        
                    </tbody>
                    <tfoot>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Rental ID Name</th>
                        <th class="text-center">Rental Price</th>
                        <th class="text-center">Rent Start Date Time</th>
                        <th class="text-center">Rent End Date Time</th>
                        <th class="text-center">Customer Name</th>
                        <th class="text-center">Customer Phone</th>
                        <th class="text-center">Customer Email</th>
                        <th class="text-center">Booking Method</th>
                        <th class="text-center">Booking Status</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center">Actions</th>

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
        </section>
@endsection
@section("css")
    @include("admin.include.lib.datatable.css")
@endsection

@section("js")
    @include("admin.include.lib.datatable.js")
@endsection
        