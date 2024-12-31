@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.category')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.videohome.index') }}"></i> @lang('site.videohome')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.edit') </h3>

                    @include('partials._errors')

                    <form action="{{ route('dashboard.videohome.update',$video->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}


                        <div class="form-group">
                            <label for="video_url">@lang('site.video')</label>
                            <input type="file" name="video_url" class="form-control">
                            @if ($video->video_url)
                                <p>@lang('site.current_video'): 
                                    <a href="{{ $video->video_url }}" target="_blank">@lang('site.view_video')</a>
                                </p>
                            @endif
                            @error('video_url')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                      
                            <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> @lang('site.update')</button>
                        </div>


                    </form><!-- end of form -->

                </div><!-- end of box header -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
