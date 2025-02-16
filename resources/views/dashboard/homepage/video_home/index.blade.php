@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.videohome')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.videohome')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box-header with-border">

                <h3 class="box-title" style="margin-bottom: 15px"> @lang('site.videohome') </h3>

                <form action="{{ route('dashboard.videohome.index') }}" method="get">

                    <div class="row">


                        <div class="col-md-4">

                            {{-- <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button> --}}

                            {{-- @if (auth()->user()->hasPermission('create_categories')) --}}
                                <a href="{{ route('dashboard.videohome.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                            {{-- @else
                                <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                            @endif --}}

                        </div>

                    </div>
                </form><!-- end of form -->

            </div><!-- end of box header -->


            <div class="box-body">

                @if ($videos->count() > 0)

                    <table class="table table-hover">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.video_url')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($videos as $index=>$video)

                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <p>@lang('site.current_video'): 
                                        <a href="{{ $video->video_url }}" target="_blank">@lang('site.view_video')</a>
                                    </p>
                                </td>
                               
                                <td>
                                    {{-- @if  (auth()->user()->hasPermission('update_categories') ) --}}
                                        <a href="{{ route('dashboard.videohome.edit',$video->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>

                                    {{-- @else
                                        <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                    @endif --}}

                                    {{-- @if (auth()->user()->hasPermission('delete_categories')) --}}
                                        <form action="{{ route('dashboard.videohome.destroy', $video->id) }}" method="post" style="display: inline-block">
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
                    {{-- {{ $sliders->appends(request()->query())->links() }} --}}


                 @else

                    <h2>@lang('site.no_data_found')</h2>

                @endif 

            </div><!-- end of box body -->
            

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
