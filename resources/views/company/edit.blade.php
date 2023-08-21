@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Edit Company</h2>
                        <a class="btn btn-success" href="{{ route('companies.index') }}">Back <-</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('includes.alerts')
                    <form method="POST" enctype="multipart/form-data" action="{{ route('companies.update',$company->id) }}">
    					@method('PUT')
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __(' Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  required autocomplete="name" autofocus value="{{$company->name}}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"   autocomplete="email" value="{{$company->email}}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Logo') }}</label>
                            <div class="col-md-6">
                               <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" accept="image/*">
                                <img src="{{asset('storage/images/'.$company->logo)}}" class="col-md-4 form-control" width="300px">
                                @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Website') }}</label>
                            <div class="col-md-6">
                                <input id="website" type="text" class="form-control" name="website" value="{{$company->website}}">
                                @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="row mb-0">
                            <div class="col-md-6 offset-md-4 text-center">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
   				</div>
            </div>
        </div>
    </div>
</div>

@endsection