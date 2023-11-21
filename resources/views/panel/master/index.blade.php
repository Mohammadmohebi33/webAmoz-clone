<!DOCTYPE html>
<html lang="en">
@include('panel.master.head')



<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    @include('panel.master.navbar')
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    @include('panel.master.aside')
    <!-- Content Wrapper. Contains page content -->



    <div class="content-wrapper">


        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                @if(session('message'))
                    <div class="col-md-12">
                        <div class="card card-success shadow">
                            <div class="card-header">
                                <h3 class="card-title">Shadow - Regular</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{session('message')}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                @elseif(session('fail'))
                    <div class="col-md-12">
                        <div class="card card-danger shadow">
                            <div class="card-header">
                                <h3 class="card-title">Shadow - Regular</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{session('fail')}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                @endif
                      @yield('content')
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
@include('panel.master.js')
</body>
</html>

