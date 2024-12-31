@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.homepage.index') }}"></i> @lang('site.homepage')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.add') </h3>

                    @include('partials._errors')

                    <form action="{{ route('dashboard.homepage.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('post') }}

                       

                            <div class="form-group">

                                <label>@lang('site.title')</label>

                                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                            </div>

                            <div class="form-group">

                                <label>@lang('site.description')</label>

                                <input type="text" name="description" class="form-control" value="{{ old('description') }}">
                            </div>

                            <div class="form-group">

                                <lable>@lang('site.image')</lable>
       
                                <input type="file" name='image_path' class="form-control"  id="imageInput">
       
                              </div>
       
                              <div class="form-group">
       
                                <img src="{{ asset('uploads/product_images/default.png') }}"  alt="imagePreview" id="imagePreview" width="100px" class="img-thumbnail">
       
                              </div>

                     
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i>@lang('site.add')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box header -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
