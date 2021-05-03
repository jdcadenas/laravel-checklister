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
                <form action="{{ route( 'admin.checklist_groups.checklists.update' ,[$checklistGroup ,$checklist ])}}" method="post">
                @csrf
                @method('PUT')
                    <div class="card-header">{{ __('Edit Checklist') }}</div>

                <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input class="form-control" value="{{ $checklist->name }}"
                                            name="name" type="text" >
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                <button class="btn btn-sm btn-primary" type="submit"> {{ __('Save checklist') }}</button>
                        <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
                </div>
                </form>
            </div>
            <form action="{{ route('admin.checklist_groups.checklists.destroy', [$checklistGroup,$checklist] )}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger"
                type="submit" onClick="return confirm( '{{ __('Are you sure?' ) }}' )">
                {{ __('Delete check list') }}
            </button>
            </form>
        <hr/>



                <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> {{ __('List of Task') }}</div>
                    <div class="card-body">
                    @livewire('tasks-table',['checklist'=> $checklist])
                    </div>
                    </div>




                <div class="card">
                    @if ($errors->storetask->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->storetask->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route( 'admin.checklists.tasks.store' ,[$checklist ])}}" method="post">
                    @csrf

                        <div class="card-header">{{ __('New task') }}</div>

                    <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input class="form-control" value="{{ old('name')}}"
                                    name="name" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">{{ __('Description') }}</label>
                                        <textarea class="form-control"
                                    name="description" rows="5" id="task-textarea">{{ old('description')}}</textarea>
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
