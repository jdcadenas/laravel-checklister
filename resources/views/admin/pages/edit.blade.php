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




                    <form action="{{ route( 'admin.pages.update' ,[$page ])}}" method="post">
                    @csrf
                    @method('PUT')
                        <div class="card-header">{{ __('Edit Page') }}</div>

                    <div class="card-body">
                        @if (session('messages'))
                        <div class="alert alert-info">
                            {{session('message')}}
                        </div>
                        @endif
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label for="name">{{ __('Title') }}</label>
                                    <input class="form-control" value="{{ $page->title }}"
                                                name="title" type="text" >
                                    </div>
                                    <div class="form-group">
                                            <label for="content">{{ __('Content') }}</label>
                                            <textarea class="form-control"
                                                        name="content" type="text" rows="5"

                                                        id="task-textarea">{{ $page->content }}</textarea>
                                            </div>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                    <button class="btn btn-sm btn-primary" type="submit"> {{ __('Save Task') }}</button>
                            <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
    <script>
        ClassicEditor
            .create( document.querySelector( '#task-textarea' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
