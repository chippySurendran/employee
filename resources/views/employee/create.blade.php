@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">               	
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Add Employee</h2>
                        <a class="btn btn-success" href="{{ route('employees.index') }}">Back <-</a>
                    </div>
                </div>    
                <div class="card-body">
                @include('includes.alerts')
                <form method="POST" enctype="multipart/form-data" action="{{ route('employees.store') }}">
                @method('POST')
                @csrf
                    <div class="row mb-3">
                        <label for="fname" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>
                        <div class="col-md-6">
                            <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus>
                            @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                        <div class="col-md-6">
                            <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>
                            @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Company') }}</label>

                        <div class="col-md-6">
                            <select id="company" name="company" class="form-control @error('company') is-invalid @enderror" required autofocus>
                                <option value=""> -- Select company --</option>
                                @if(count($companies) > 0)
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                @endif
                            </select>

                           @error('company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                        <div class="col-md-6">
                           <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>
                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" autofocus title="Please Enter Proper Mobile Number!" pattern="[1-9]{1}[0-9]{9}">

                             @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4 text-center">
                            <button type="submit" class="btn btn-primary">
                                Submit
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