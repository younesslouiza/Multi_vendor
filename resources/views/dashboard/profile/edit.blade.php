@extends('layouts.dashboard')
@section('title', 'Edit Profile')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> Edit Profile</li>
@endsection
@section('content')

<x-alert type='success'/>

    <form action="{{ route("dashboard.profile.update")}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="form-row">
            <div class="col-md-6">
                <x-input name="first_name" label="First Name" :value="$user->profile->first_name" />
            </div>
            <div class="col-md-6">
                <x-input name="last_name"  label="Last Name" :value="$user->profile->last_name" />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <x-input name="birthday" type='date' label="Birthday" :value="$user->profile->birthday" />
            </div>
            <div class="col-md-6">
                <x-radio name="gender" label="Gender"  :checked="$user->profile->gender" :options="['male' => 'Male', 'female' => 'Female']" />
            </div>
        </div>   
        
        <div class="form-row">
            <div class="col-md-4">
                <x-input name="street_address" label="Street address" :value="$user->profile->street_address" />
            </div>
            <div class="col-md-4">
                <x-input name="city" label="City" :value="$user->profile->city" />
            </div>
            <div class="col-md-4">
                <x-input name="state" label="State" :value="$user->profile->state" />
            </div>
        </div>   

        <div class="form-row">
            <div class="col-md-4">
                <x-input name="postal_code" label="Postal Code" :value="$user->profile->postal_code" />
            </div>
            <div class="col-md-4">
                <x-select name="country" :options="$countries" label="Country" :selected="$user->profile->country" />
            </div>
            <div class="col-md-4">
                <x-select name="local" :options="$locales" label="Local" :selected="$user->profile->local"  />
            </div>
        </div>   
        <div class="col-sm-6 mt-5">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>


     
    </form>
@endsection
