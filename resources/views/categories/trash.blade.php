@extends('layouts.global')

@section('title') Trashed Categories @endsection

@section('content')

<div class="row">
    <div class="col-md-6">
        <form action="{{route('categories.index')}}">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Filter by category name" name="name" value="{{Request::get('name')}}">
                <div class="input-group-append">
                    <input type="submit" value="Filter" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-6">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item"><a class="nav-link" href="{{route('categories.index')}}">Published</a></li>
            <li class="nav-item"><a class="nav-link active" href="{{route('categories.trash')}}">Trash</a></li>
        </ul>
    </div>
</div>

<hr class="my-3">

<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th><b>Name</b></th>
                    <th><b>Slug</b></th>
                    <th><b>Image</b></th>
                    <th><b>Action</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>{{$category->slug}}</td>
                        <td>
                            @if($category->image)
                                <img src="{{asset('storage/'.$category->image)}}" width="48px"/>
                            @else
                                No image
                            @endif
                        </td>
                        <td>
                            <a href="{{route('categories.restore', ['id' => $category->id])}}" class="btn btn-success btn-sm">Restore</a>
                            <form class="d-inline" action="{{route('categories.delete-permanent', ['id' => $category->id])}}" method="POST" onsubmit="return confirm('Delete this category permanently?')">
                                @csrf
                                <input type="hidden" value="DELETE" name="_method"/>

                                <input type="submit" class="btn btn-danger btn-sm" value="Delete"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="10">{{$categories->appends(Request::all())->links()}}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
