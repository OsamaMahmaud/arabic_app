@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.products')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.products.index') }}"></i> @lang('site.products')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.add') </h3>

                    @include('partials._errors')

                    <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        {{ method_field('post') }}



                        <div class="form-group">

                            <label>@lang('site.categories')</label>

                            <select name="category_id" id="" class="form-control" >

                                <option style="text-align: center" >-------@lang('site.all_categories')-------</option>

                                @foreach ($categories as $category)

                                  <option value="{{ $category->id }}">{{ $category->name }}</option>

                                @endforeach
                            </select>

                        </div>


                        @foreach ( config('translatable.locales') as $locale )

                            <div class="form-group">

                                <label>@lang('site.'.$locale.'.name')</label>

                                <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ old($locale. '.name') }}">
                            </div>

                        @endforeach

                        @foreach ( config('translatable.locales') as $locale )

                            <div class="form-group">

                                <label>@lang('site.'.$locale.'.description')</label>

                                <textarea name="{{ $locale }}[description]" class="form-control ckeditor">{{ old($locale . '.description') }}</textarea>
                            </div>

                       @endforeach

                       <div class="form-group">

                         <lable>@lang('site.image')</lable>

                         <input type="file" name='image' class="form-control"  id="imageInput">

                       </div>

                       <div class="form-group">

                         <img src="{{ asset('uploads/product_images/default.png') }}"  alt="imagePreview" id="imagePreview" width="100px" class="img-thumbnail">

                       </div>


                       <div class="form-group">

                        <lable>@lang('site.purchase_price')</lable>

                        <input type="number" step="0.01" name='purchase_price' class="form-control" value="{{ old('purchase_price') }}" >

                      </div>


                      <div class="form-group">

                        <lable>@lang('site.sale_price')</lable>

                        <input type="number" step="0.01" name='sale_price' class="form-control" value="{{ old('sale_price') }}" >

                      </div>

                      <div class="form-group">
                        <label>@lang('site.stock')</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock') }}">
                      </div>


                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> @lang('site.add')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box header -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
