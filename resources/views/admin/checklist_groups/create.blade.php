@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
        <div class="col-md-12">
            <div class="card">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route( 'admin.checklist_groups.store' )}}" method="post">
                @csrf
                    <div class="card-header">{{ __('New Checklist Group') }}</div>

                <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input class="form-control" value="{{ old('name') }}" name="name" type="text" placeholder="{{ __('Checklist Group') }}">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                <button class="btn btn-sm btn-primary" type="submit"> {{ __('Save') }}</button>
                        <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
                </div>
                </form>
            </div>

        </div>
    </div>

    </div>
</div>
@endsection
