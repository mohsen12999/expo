@extends('layouts.admin')

@section('title', __('words.ExpoList'))

@section('myheader')
@endsection

@section('content')
<section>
    <h1>{{ __('words.ExpoList') }}</h1>
</section>

<section class="content container-fluid">
    <!--------------------------
| Your Page Content Here |
-------------------------->

    <div class="col-xs-12">
        <div class="box">

            <!-- box-header -->
            <div class="box-header">
                <h3 class="box-title">{{ __('words.ExpoList') }}</h3>
                <a href="{{url('admin\expo\create')}}" class="btn btn-primary pull-right" style="margin-left: 1em;"><i
                        class="fa fa-plus"></i> {{ __('words.NewExpo') }}</a>
            </div>
            <!-- /.box-header -->


            <div class="box-body table-responsive no-padding">

                @if (count($expos) === 0)
                <div class="no-data">
                    <h3>{{ __('words.NoExpoMessage') }}</h3>
                    <a href="{{url('admin\expo\create')}}" class="btn btn-primary" style="margin-left: 1em;"><i
                            class="fa fa-plus"></i> {{ __('words.NewExpo') }}</a>
                </div>
                @else


                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs nav-fill nav-justified ui-sortable-handle">
                        <li class="active">
                            <a id="pending-users-tab" href="#active-tab" data-toggle="tab"
                                aria-expanded="true">{{ __('words.ActiveExpo') }}</a>
                        </li>
                        <li>
                            <a id="accept-users-tab" href="#archive-tab" data-toggle="tab"
                                aria-expanded="false">{{ __('words.ArchiveExpo') }}
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content no-padding">
                        <div class="chart tab-pane active" id="active-tab">

                            <table class="table table-hover persian-table table-striped table-bordered">
                                <tr>
                                    <th>{{ __('words.Pic') }}</th>
                                    <th>{{ __('words.Title') }}</th>
                                    <th>{{ __('words.Type') }}</th>
                                    <th>{{ __('words.StartEndTime') }}</th>
                                    <th>{{ __('words.Status') }}</th>
                                    <th>{{ __('words.Booths') }}</th>
                                    <th>{{ __('words.Functions') }}</th>
                                </tr>

                                @foreach ($active_expos as $expo)

                                <tr>
                                    <td><img src="{{$expo->pic}}" height="75" alt="{{ $expo->title }} pic" /></td>
                                    <td> {{ $expo->title }} </td>
                                    <td> {{ $expo->type==0? __('words.Periodic'):__('words.Yearly') }} </td>
                                    <td>{{ substr($expo->start,0,10)." to ".substr($expo->end,0,10) }} </td>
                                    <td> {{ $expo->status==0?__("words.Saved"):__("words.Published") }} </td>
                                    <td>

                                        <a class="btn btn-success" href="{{url('admin/expo-admin/'.$expo['id'])}}">
                                            <i class="fa fa-gear" title="{{ __('words.ExpoAdmin') }}"></i>
                                            {{ __('words.ExpoAdmin') }}: {{ count($expo->booths) }}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="{{url('admin/expo-image/'.$expo['id'])}}">
                                            <i class="fa fa-image" title="{{ __('words.ExpoImages') }}"></i>
                                            {{ __('words.ExpoImages') }}
                                            {{count($expo->expoImages)}}
                                        </a>
                                        <a class="btn btn-primary" href="{{url('admin/expo-comment/'.$expo['id'])}}">
                                            <i class="fa-commenting" title="{{ __('words.ExpoComments') }}"></i>
                                            {{ __('words.ExpoComments') }}
                                            {{count($expo->expoComments)}}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-warning"
                                            href="{{action('Admin\ExpoController@edit', $expo['id'])}}">
                                            <i class="fa fa-edit" title="{{ __('words.ChangeExpo') }}"></i>
                                            {{ __('words.ChangeExpo') }}
                                        </a>
                                        <form style="display:inline;" action="{{ url('admin/expo/' . $expo->id) }}"
                                            method="post"
                                            onsubmit="return confirm('{{ __('words.DeleteExpoMessage') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" title="{{ __('words.DeleteExpo') }}">
                                                <i class="fa fa-trash-o" title="{{ __('words.DeleteExpo') }}"></i>
                                                {{ __('words.DeleteExpo') }}
                                            </button>
                                        </form>

                                        <form style="display:inline;" action="{{ url('/admin/expo-history') }}"
                                            method="post">
                                            @csrf
                                            <input type="hidden" name="id" id="id" value="{{ $expo->id }}" />
                                            <input type="hidden" name="history" id="history" value="1" />
                                            <button class="btn btn-info" title="{{ __('words.Send2History') }}">
                                                <i class="fa fa-history" title="{{ __('words.Send2History') }}"></i>
                                                {{ __('words.Send2History') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                @endforeach

                            </table>

                        </div>
                        <div class="chart tab-pane" id="archive-tab">

                            <table class="table table-hover persian-table table-striped table-bordered">
                                <tr>
                                    <th>{{ __('words.Pic') }}</th>
                                    <th>{{ __('words.Title') }}</th>
                                    <th>{{ __('words.Type') }}</th>
                                    <th>{{ __('words.StartEndTime') }}</th>
                                    <th>{{ __('words.Status') }}</th>
                                    <th>{{ __('words.Booths') }}</th>
                                    <th>{{ __('words.Functions') }}</th>
                                </tr>

                                @foreach ($archive_expos as $expo)

                                <tr>
                                    <td><img src="{{$expo->pic}}" height="75" alt="{{ $expo->title }} pic" /></td>
                                    <td> {{ $expo->title }} </td>
                                    <td> {{ $expo->type==0? __('words.Periodic'):__('words.Yearly') }} </td>
                                    <td>{{ substr($expo->start,0,10)." to ".substr($expo->end,0,10) }} </td>
                                    <td> {{ $expo->status==0?__("words.Saved"):__("words.Published") }} </td>
                                    <td>

                                        <a class="btn btn-success" href="{{url('admin/expo-admin/'.$expo['id'])}}">
                                            <i class="fa fa-gear" title="{{ __('words.ExpoAdmin') }}"></i>
                                            {{ __('words.ExpoAdmin') }}: {{ count($expo->booths) }}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="{{url('admin/expo-image/'.$expo['id'])}}">
                                            <i class="fa fa-image" title="{{ __('words.ExpoImages') }}"></i>
                                            {{ __('words.ExpoImages') }}
                                            {{count($expo->expoImages)}}
                                        </a>
                                        <a class="btn btn-primary" href="{{url('admin/expo-comment/'.$expo['id'])}}">
                                            <i class="fa-commenting" title="{{ __('words.ExpoComments') }}"></i>
                                            {{ __('words.ExpoComments') }}
                                            {{count($expo->expoComments)}}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-warning"
                                            href="{{action('Admin\ExpoController@edit', $expo['id'])}}">
                                            <i class="fa fa-edit" title="{{ __('words.ChangeExpo') }}"></i>
                                            {{ __('words.ChangeExpo') }}
                                        </a>
                                        <form style="display:inline;" action="{{ url('admin/expo/' . $expo->id) }}"
                                            method="post"
                                            onsubmit="return confirm('{{ __('words.DeleteExpoMessage') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" title="{{ __('words.DeleteExpo') }}">
                                                <i class="fa fa-trash-o" title="{{ __('words.DeleteExpo') }}"></i>
                                                {{ __('words.DeleteExpo') }}
                                            </button>
                                        </form>

                                        <form style="display:inline;" action="{{ url('/admin/expo-history') }}"
                                            method="post">
                                            @csrf
                                            <input type="hidden" name="id" id="id" value="{{ $expo->id }}" />
                                            <input type="hidden" name="history" id="history" value="0" />
                                            <button class="btn btn-info" title="{{ __('words.Send2Active') }}">
                                                <i class="fa fa-recycle" title="{{ __('words.Send2Active') }}"></i>
                                                {{ __('words.Send2Active') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                @endforeach

                            </table>

                        </div>
                    </div>

                </div>

                @endif

            </div>

        </div>
    </div>

</section>

@endsection


@section('myfooter')
@endsection
