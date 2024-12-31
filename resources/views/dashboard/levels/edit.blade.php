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

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.edit') </h3>

                    @include('partials._errors')

                    <form action="{{ route('dashboard.levels.update',$level->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}


                        <div class="form-group">
                            <label for="name">@lang('site.levels')</label>
                            <input type="text" name="name" class="form-control" value="{{ $level->name}}">
                            @error('name')
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
