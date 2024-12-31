@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.instructions')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.instructions.index') }}"></i> @lang('site.instructions')</a></li>
            <li class="active">@isset($instruction) @lang('site.edit') @else @lang('site.add') @endisset</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">
                    @isset($instruction) @lang('site.edit') @else @lang('site.add') @endisset
                </h3>
                @include('partials._errors')
            </div><!-- end of box header -->

            <div class="box-body">
                <form 
                    action="@isset($instruction) {{ route('dashboard.instructions.update', $instruction->id) }} @else {{ route('dashboard.instructions.store') }} @endisset" 
                    method="post" 
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @isset($instruction) 
                        {{ method_field('put') }} 
                    @else 
                        {{ method_field('post') }} 
                    @endisset

                    <div class="form-group">
                        <label for="title">@lang('site.title')</label>
                        <input type="text" name="title" class="form-control" value="{{ $instruction->title ?? old('title') }}">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">@lang('site.content')</label>
                        <textarea name="content" class="form-control">{{ $instruction->content ?? old('content') }}</textarea>
                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa {{ isset($instruction) ? 'fa-edit' : 'fa-plus' }}"></i> 
                            @isset($instruction) @lang('site.update') @else @lang('site.add') @endisset
                        </button>
                    </div>

                </form>
            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection