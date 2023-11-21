@extends('panel.master.index')


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Courses</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">all User</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table  table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th style="width: 30%">title</th>
                        <th>video</th>
                        <th>course</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sessions as $session)
                        <tr>
                            <td>{{$session->id}}</td>
                            <td>{{$session->title}}</td>
                            <td>
                                <video width="20%" controls="" height="10%">
                                    <source src="/sessions/{{$session->video_url}}" type="video/mp4">
                                </video>
                            </td>
                            <td>{{$session->course->title}}</td>
                            <td class="project-actions">
                                <a class="btn btn-primary btn-sm" href="">
                                    <i class="fas fa-folder"></i>View
                                </a>
                                <a class="btn btn-info btn-sm" href="{{route('session.edit', $session->id)}}">
                                    <i class="fas fa-pencil-alt"></i>Edit
                                </a>

                                <form action="{{route('session.destroy' , $session->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
                        {{$sessions->links()}}
        </div>
    </section>
@endsection
