
@extends("admin.layout.master")
@section("title","People Feedback")
@section("content")
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>People Feedback</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('peoplefeedback/create')}}">Create New </a></li>
                  <li class="breadcrumb-item active">People Feedback Data</li>
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
                  <h3 class="card-title">People Feedback Data</h3>

                    <div class="card-tools">
                      <ul class="pagination pagination-sm float-right">
                        <li class="page-item">
                            <a class="page-link bg-primary" href="{{url('peoplefeedback/create')}}"> 
                                Add New 
                                <i class="fas fa-plus"></i> 
                            </a>
                        </li>
                        <li class="page-item">
                          <a class="page-link" target="_blank" href="{{url('peoplefeedback/export/pdf')}}">
                            <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                          </a>
                        </li>
                        <li class="page-item">
                          <a class="page-link" target="_blank" href="{{url('peoplefeedback/export/excel')}}">
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
                            <th class="text-center">Photo</th>
                            <th class="text-center">Feedback</th>
                            <th class="text-center">Feedback Author</th>
                            <th class="text-center">Module Status</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if(count($dataRow))
                            @foreach($dataRow as $row)  
                                <tr>
                                    <td class="text-center">{{$row->id}}</td>
                                    <td class="text-center">
                                      @isset($row->photo)
                                          <img style="width: 100px;" src="{{asset('upload/peoplefeedback/'.$row->photo)}}"  />
                                      @endisset
                                    </td>
                                    <td class="text-center">{{$row->feedback}}</td>
                                    <td class="text-center">{{$row->feedback_author}}</td>
                                    <td class="text-center">{{$row->module_status}}</td>
                                    <td>{{formatDate($row->created_at)}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{url('peoplefeedback/edit/'.$row->id)}}" type="button" class="btn btn-default">
                                                Edit 
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{url('peoplefeedback/delete/'.$row->id)}}" type="button" class="btn btn-default">
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
                        <th class="text-center">Photo</th>
                        <th class="text-center">Feedback</th>
                        <th class="text-center">Feedback Author</th>
                        <th class="text-center">Module Status</th>
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
        