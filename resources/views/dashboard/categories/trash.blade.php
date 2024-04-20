@extends('layouts.dashboard')

@section('title', 'Trashed Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item ">Categories</li>
    <li class="breadcrumb-item active">Trash</li>
@endsection

@section('content')
<div class="mb-5">
    <a href="{{ route( 'dashboard.categories.index' ) }}" class="btn btn-sm btn-outline-primary">Back</a>
</div>
<form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
    <x-input name="name" placeholder="Name" class="mx-2" :value="request('name')"/>
    <select name="status" class="form-control mx-2" >
        <option value="">All</option>
        <option value="active" @selected(request('status') == 'active')>active</option>
        <option value="archived" @selected(request('status') == 'archived')>archived</option>
    </select>
    <button class="btn btn-dark mx-2">Filter</button>
</form>

<x-alert type="success" />
<x-alert type="info" />

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>NAME</th>
                <th>Status</th>
                <th>Deleted AT</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <!--لمعرفة هل categories فارغة نستعمل تحقق $categories->count()-->
            @if ($categories->count())
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td><img src="{{ asset('storage/'.$category->image) }}" height="50px" alt="" srcset=""></td>
                      
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->status }}</td>
                        <td>{{ $category->deleted_at }}</td>
                        <td>
                            <form action="{{ route('dashboard.categories.restore',$category->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-outline-info">Restore</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('dashboard.categories.force-delete',$category->id) }}" method="post">
                                @csrf
                                @method('Delete')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7"><center>No categories defined</center> </td>
                </tr>
            @endif


        </tbody>
    </table>
    
    {{ $categories->withQueryString()->appends(['search'=>1])->links() }}
@endsection
