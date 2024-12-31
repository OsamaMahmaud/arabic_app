@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.videos')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.videos')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box-header with-border">

                <h3 class="box-title" style="margin-bottom: 15px"> @lang('site.videos') <small>#</small></h3>

                <form action="{{ route('dashboard.videos.index') }}" method="get">

                    <div class="row">

                        
                        <div class="col-md-4">
                            <select name="level" class="form-control">
                                <option value="">---@lang('site.levels')-----</option>
                                @foreach ($levels as $level)
                                   <option value='{{ $level->id }}'>{{ $level->name }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-4">
                            <select name="section_name" class="form-control">
                                <option value="">---@lang('site.all_categories')-----</option>
                                @foreach ($sections->unique('section_name') as $section)
                                   <option value='{{ $section->section_name }}'>{{ $section->section_name }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-4">

                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>

                            {{-- @if (auth()->user()->hasPermission('create_categories')) --}}
                                <a href="{{ route('dashboard.videos.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                            {{-- @else
                                <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                            @endif --}}

                        </div>

                    </div>
                </form><!-- end of form -->

            </div><!-- end of box header -->


            <div class="box-body">

                @if ($contants->count() > 0)

                    <table class="table table-hover">

                        <thead>
                        <tr>
                            <th>#</th>
                                <th>@lang('site.level')</th>
                                <th>@lang('site.category')</th>
                                <th>@lang('site.title')</th>
                                <th>@lang('site.description')</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.video_url')</th>
                                <th>@lang('site.action')</th>

                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($contants as $index=>$contant)

                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $contant->level->name }}</td>
                                <td>{{ $contant->section_name }}</td>
                                <td>{{ $contant->title }}</td>
                                <td>
                                    
                                        
                                        {!! Str::limit($contant->description, 20, '...') !!}
                                        <a href="javascript:void(0);" onclick="showAlert('{{ $contant->description }}')">
                                            @lang('site.read_more')
                                        </a>
                                    
                                </td>
                                <td>
                                    {{-- <img src="{{ $contant->getFirstMediaUrl('slider_images') }}" style="width: 100px"  class="img-thumbnail" alt="slider_image"> --}}
                                    <img src="{{ $contant->getFirstMediaUrl('video_image') }}" style="width:100px"  class="img-thumbnail" alt="video_image">
                                </td>
                                <td>
                                    <p>@lang('site.current_video'): 
                                        <a href="{{ $contant->url }}" target="_blank">@lang('site.view_video')</a>
                                    </p>
                                </td>
                               
                                <td>
                                    {{-- @if  (auth()->user()->hasPermission('update_categories') ) --}}
                                        <a href="{{ route('dashboard.videos.edit',$contant->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>

                                    {{-- @else
                                        <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                    @endif --}}

                                    {{-- @if (auth()->user()->hasPermission('delete_categories')) --}}
                                        <form action="{{ route('dashboard.videos.destroy', $contant->id) }}" method="post" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        </form><!-- end of form -->
                                    {{-- @else
                                        <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                    @endif --}}
                                </td>
                            </tr>

                        @endforeach
                        </tbody>

                    </table><!-- end of table -->

                    <!-- Display pagination links -->
                    {{-- {{ $contants->appends(request()->query())->links() }} --}}
                    {{ $contants->appends(request()->except('page'))->links() }}


                 @else

                    <h2>@lang('site.no_data_found')</h2>

                @endif 

            </div><!-- end of box body -->
            

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
<!-- إضافة سكريبت JavaScript -->
<script>
    function showAlert(description) {
        alert(description);
    }
</script>


@endsection

