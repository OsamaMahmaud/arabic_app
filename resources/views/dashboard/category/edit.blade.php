@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.category')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.categories.index') }}"></i> @lang('site.categories')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.add') </h3>

                    @include('partials._errors')

                    <form action="{{ route('dashboard.categories.update',$category->id) }}" method="post" >
                        {{ csrf_field() }}
                        {{ method_field('put') }}



                        <div class="form-group">
                            @foreach (config('translatable.locales') as $locale )
                               <label>@lang('site.'.$locale.'.name')</label>
                            <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ $category->translate($locale)->name }}" required>
                            @endforeach
                        </div>





                            <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> @lang('site.update')</button>
                        </div>




                    </form><!-- end of form -->

                </div><!-- end of box header -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
