@extends('layouts.dashboard')
@section('title', $category->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> Categories</li>
    <li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection
@section('content')
     
<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>NAME</th>
            <th>Store</th>
            <th>Status</th>
            <th>CREATED AT</th>
        </tr>
    </thead>
    <tbody>
        @php
           $products = $category-> products() -> with('store') -> latest() -> paginate(5);
        @endphp
            @forelse ( $products as $Products )
                <tr>
                    <td><img src="{{ asset('storage/' . $product->image) }}" height="50"></td>
                    <td>{{ $Products->name }}</td>
                    <td>{{ $Products->category->name }}</td>
                    <td>{{ $Products->status }}</td>
                    <td>{{ $Products->created_at }}</td>
                </tr> 
            @empty       
            <tr>
                <td colspan="5"><center>No Products defined</center> </td>
            </tr>
            @endforelse
    </tbody>
</table>
{{ $products->links() }}
@endsection
