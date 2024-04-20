@extends('layouts.dashboard')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection

@section('content')

<div class="mb-5">
    <a href="{{route('dashboard.products.create')}}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
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
                <th></th>
                <th>ID</th>
                <th>NAME</th>
                <th>Category</th>
                <th>Store</th>
                <th>Status</th>
                <th>CREATED AT</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <!--لمعرفة هل Products فارغة نستعمل تحقق $Products->count()-->
            @if ($products->count())
                @foreach ($products as $Products)
                    <tr>
                        <td></td>
                        <td>{{ $Products->id }}</td>
                        <td>{{ $Products->name }}</td>
                        <td>{{ $Products->category->name }}</td>
                        <td>{{ $Products->store->name }}</td>
                        <td>{{ $Products->status }}</td>
                        <td>{{ $Products->created_at }}</td>
                        <td>
                            <a href="{{ route('dashboard.products.edit',$Products->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('dashboard.products.destroy',$Products->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8"><center>No Products defined</center> </td>
                </tr>
            @endif


        </tbody>
    </table>
    
    {{ $products->withQueryString()->appends(['search'=>1])->links() }}
@endsection
