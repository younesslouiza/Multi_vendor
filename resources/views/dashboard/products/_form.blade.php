@if ($errors->any())
    <div class="alert alert-danger">
        <h1>Error Occured!</h1>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    {{--<label for="">Category Name</label>--}}
    <x-input label="Product Name" name="name" type="text" role="input" :value="$product->name" />
</div>


<div class="form-group">
    <label for="">Category </label>
    <select type="text" name="category_id" class="form-control form-select">
        <option value="">Priamry Category </option>
        @foreach (App\Models\Categorie::all() as $category)
            <option value="{{ $category->id }}" @selected(old('category_id',$category->category_id) == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="">Description</label>
    <x-textarea name="description" :value="$product->description"/>
</div>


<div class="form-group">
    <label for="">Image</label>
    <input type="file" name="image" class="form-control">
    @if ($product->image)
    <img src="{{ asset('storage/'.$product->image) }}" height="50px" alt="" srcset="">
    @endif
</div>

<div class="form-group">
    <label for="">Price</label>
    <x-input name="price" :value="$product->price"/>
</div>

<div class="form-group">
    <label for="">Compare Price</label>
    <x-input name="price" :value="$product->price"/>
</div>

<div class="form-group">
    <label for=""> Tags</label>
    <x-input name="tags" :value="$product->tags"/>
</div>

<div class="form-group">
    <label for="">Status</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" value="Active" @checked(old('status',$product->status) == 'active')>
        <label class="form-check-label" for="flexRadioDefault1">
            Active
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" value="Draft" @checked(old('status',$product->status) == 'draft')>
        <label class="form-check-label" for="flexRadioDefault2">
            Draft
        </label>
    </div>
    
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" value="archived" @checked(old('status',$product->status) == 'archived')>
        <label class="form-check-label" for="flexRadioDefault3">
            Archived
        </label>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>