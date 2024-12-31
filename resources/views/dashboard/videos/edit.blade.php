@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.levels')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.levels.index') }}"></i> @lang('site.levels')</a></li>
            <li class="active">@lang('site.edit')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.edit')</h3>
                @include('partials._errors')
            </div><!-- end of box header -->

            <div class="box-body">
                <form action="{{ route('dashboard.videos.update', $video->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label>@lang('site.levels')</label>
                        <select name="level_id" class="form-control">
                            <option style="text-align: center">-------@lang('site.levels')-------</option>
                            @foreach ($levels as $level)
                                <option value="{{ $level->id }}" {{ $video->level_id == $level->id ? 'selected' : '' }}>
                                    {{ $level->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>@lang('site.categories')</label>
                        <select name="section_name" class="form-control">
                            <option style="text-align: center">-------@lang('site.all_categories')-------</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->section_name }}" {{ $video->section_name == $category->section_name ? 'selected' : '' }}>
                                    {{ $category->section_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">@lang('site.title')</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $video->title) }}">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>@lang('site.description')</label>
                        <textarea name="description" class="form-control ckeditor">{{ old('description', $video->description) }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>@lang('site.image')</label>
                        <input type="file" name="image" class="form-control" id="imageInput">
                        <img src="{{ $video->image }}" alt="imagePreview" id="imagePreview" width="100px" class="img-thumbnail" style="margin-top: 10px;">
                    </div>

                    <div class="form-group">
                        <label for="url">@lang('site.video')</label>
                        <input type="file" name="url" class="form-control">
                        <p style="margin-top: 10px;">
                            <a href="{{ $video->url }}" target="_blank">@lang('site.view_video')</a>
                        </p>
                        @error('url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-edit"></i> @lang('site.update')
                        </button>
                    </div>

                </form>
            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection
