@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.levels')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.levels.index') }}"></i> @lang('site.levels')</a></li>
            <li class="active">@lang('site.add')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.add')</h3>
                @include('partials._errors')
            </div><!-- end of box header -->

            <div class="box-body">
                <form action="{{ route('dashboard.videos.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    <div class="form-group">

                        <label>@lang('site.levels')</label>

                        <select name="level_id" id="" class="form-control" >

                            <option style="text-align: center" >-------@lang('site.levels')-------</option>

                           
                            @foreach ($levels as $level)

                              <option value="{{ $level->id }}">{{ $level->name  }}</option>

                            @endforeach
                        </select>

                    </div>


                    <div class="form-group">

                        <label>@lang('site.categories')</label>

                        <select name="section_name" id="" class="form-control" >

                            <option style="text-align: center" >-------@lang('site.all_categories')-------</option>

                            @foreach ($enumValues as $category)

                              <option value="{{ $category }}">{{ $category }}</option>

                            @endforeach
                        </select>

                    </div>


                    <div class="form-group">
                        <label for="title">@lang('site.title')</label>
                        <input type="text" name="title" class="form-control">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">

                        <label>@lang('site.description')</label>

                        <textarea name="description" class="form-control ckeditor">{{ old('description') }}</textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>

                    <div class="form-group">

                        <lable>@lang('site.image')</lable>

                        <input type="file" name='image' class="form-control"  id="imageInput">

                    </div>

                    <div class="form-group">

                        <img src="#"  alt="imagePreview" id="imagePreview" width="100px" class="img-thumbnail">

                    </div>

                    
                    <div class="form-group">
                        <label for="url">@lang('site.video')</label>
                        <input type="file" name="url" class="form-control">
                        @error('url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-plus"></i> @lang('site.add')
                        </button>
                    </div>

                </form>
            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection
