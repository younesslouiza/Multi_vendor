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
    <x-input label="Category Name" name="name" type="text" role="input" :value="$category->name" />
</div>


<div class="form-group">
    <label for="">Category Parent</label>
    <select type="text" name="parent_id" class="form-control form-select">
        <option value="">Priamry Category </option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" @selected(old('parent_id',$category->parent_id) == $parent->id)>{{ $parent->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="">Description</label>
    <x-textarea name="description" :value="$category->description"/>
</div>

<div class="form-group">
    <label for="">Image</label>
    <input type="file" name="image" class="form-control">
    @if ($category->image)
    <img src="{{ asset('storage/'.$category->image) }}" height="50px" alt="" srcset="">
    @endif
</div>

<div class="form-group">
    <label for="">Status</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" value="Active" @checked(old('status',$category->status) == 'active')>
        <label class="form-check-label" for="flexRadioDefault1">
            Active
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" value="archived" @checked(old('status',$category->status) == 'archived')>
        <label class="form-check-label" for="flexRadioDefault2">
            Archived
        </label>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>