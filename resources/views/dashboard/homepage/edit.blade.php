@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.category')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.homepage.index') }}"></i> @lang('site.homepage')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.edit') </h3>

                    @include('partials._errors')

                    <form action="{{ route('dashboard.homepage.update',$slider->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}


                        <div class="form-group">

                            <label>@lang('site.title')</label>

                            <input type="text" name="title" class="form-control" value="{{ $slider->title }}">
                        </div>

                        <div class="form-group">

                            <label>@lang('site.description')</label>

                            <input type="text" name="description" class="form-control" value="{{ $slider->description }}">
                        </div>

                        <div class="form-group">

                            <lable>@lang('site.image')</lable>
   
                            <input type="file" name='image_path' class="form-control"  id="imageInput">
   
                          </div>
   
                          <div class="form-group">
   
                            <img src="{{ $slider->image_path }}"  alt="imagePreview" id="imagePreview" width="100px" class="img-thumbnail">
   
                          </div>

                      
                            <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> @lang('site.update')</button>
                        </div>


                    </form><!-- end of form -->

                </div><!-- end of box header -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
