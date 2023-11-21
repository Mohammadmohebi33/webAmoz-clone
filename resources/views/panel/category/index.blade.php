@extends('panel.master.index')


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Courses</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
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
            <div class="row">
                <form action="{{route('category.store')}}" method="post">
                    @csrf
            <div class="card-body">
                <label for="exampleInputEmail1">category</label>
                <input name="category" type="text" class="form-control" id="exampleInputEmail1" placeholder="category name">
            </div>
                    <div class="card-body">
                        <label>Select</label>
                        <select name="parent_id" class="form-control">
                            <option value="">select</option>
                            @foreach($categories as $category)
                                @if($category->parent_id == null)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            <div class="card-body p-0">
                <table class="table  table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>name</th>
                        <th>type</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>

                            @if($category->parent_id != null)
                            <td>sub category</td>
                            @else
                                <td>main category</td>

                            @endif

                            <td class="project-actions">

                                <a class="btn btn-info btn-sm" href="{{route('category.show' , $category->id)}}">
                                    <i class="fas fa-pencil-alt"></i>Edit
                                </a>

                                <form action="{{route('category.delete' , $category->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
        {{--            {{$users->links()}}--}}
        </div>
    </section>
@endsection
