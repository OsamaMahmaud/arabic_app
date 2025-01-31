@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.packages')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.pakages.index') }}"></i> @lang('site.packages')</a></li>
            <li class="active">@isset($package) @lang('site.edit') @else @lang('site.add') @endisset</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">
                    @isset($package) @lang('site.edit') @else @lang('site.add') @endisset
                </h3>
                @include('partials._errors')
            </div><!-- end of box header -->

            <div class="box-body">
                <form 
                    action="{{ route('dashboard.pakages.update', $package->id) }} " 
                    method="post" 
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                    {{ method_field('put') }} 
                  

                    <div class="form-group">
                        <label for="name">@lang('site.name')</label>
                        <input type="text" name="name" class="form-control" value="{{ $package->name }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">@lang('site.description')</label>
                        <textarea name="description" class="form-control">{{ $package->description }}"</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">@lang('site.price')</label>
                        <input type="text" name="price" class="form-control" value="{{ $package->price }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-plus"></i> @lang('site.edit')
                        </button>
                    </div>

                </form>
            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection
