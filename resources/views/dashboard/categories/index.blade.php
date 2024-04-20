@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
<x-alert type="succes" />

<div class="mb-5">
    <a href="{{route('dashboard.categories.create')}}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
    <a href="{{route('dashboard.categories.trash')}}" class="btn btn-sm btn-outline-dark">Trash</a>
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
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>NAME</th>
                <th>Parent</th>
                <th>Products #</th>
                <th>Status</th>
                <th>CREATED AT</th>
                <th colspan="2" ></th>
            </tr>
        </thead>
        <tbody>
            <!--لمعرفة هل Products فارغة نستعمل تحقق $Products->count()-->
            @if ($categories->count())
                @foreach ($categories as $Category)
                    <tr>
                        <td><img src="{{ asset('storage/'.$Category->image) }}" height="50px" alt="" srcset=""></td>
                        <td>{{ $Category->id }}</td>
                        <td>{{ $Category->name }}</td>
                        <td> <a href="{{ route('dashboard.categories.show',$Category->id) }}">{{ $Category->name }}</a></td>
                        
                        <td>{{ $Category->products_number}}</td>
                        <td>{{ $Category->status }}</td>
                        <td>{{ $Category->created_at }}</td>
                        <td>
                            <a href="{{ route('dashboard.categories.edit',$Category->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('dashboard.categories.destroy',$Category->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9">No Products defined </td>
                </tr>
            @endif


        </tbody>
    </table>
    
    {{ $categories->withQueryString()->appends(['search'=>1])->links() }}
@endsection
