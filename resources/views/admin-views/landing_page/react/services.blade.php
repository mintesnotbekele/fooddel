@extends('layouts.admin.app')

@section('title', translate('messages.landing_page_settings'))

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/admin/css/croppie.css') }}" rel="stylesheet">
@endpush

@section('content')

    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-wrap justify-content-between align-items-start">
                <!-- Page Header -->
                <h1 class="page-header-title text-capitalize">
                    <div class="card-header-icon d-inline-flex mr-2 img">
                        <img src="{{ asset('/assets/admin/img/landing-page.png') }}" class="mw-26px" alt="public">
                    </div>
                    <span>
                        {{ translate('React_Landing_Page') }}
                    </span>
                </h1>
                <div class="text--primary-2 py-1 d-flex flex-wrap align-items-center" type="button" data-toggle="modal" data-target="#how-it-works">
                    <strong class="mr-2">{{translate('See_how_it_works')}}</strong>
                    <div>
                        <i class="tio-info-outined"></i>
                    </div>
                </div>
            </div>
            <!-- End Nav Scroller -->
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
                @include('admin-views.landing_page.top_menu.react_landing_menu')
            </div>
        </div>



        @php($language=\App\Models\BusinessSetting::where('key','language')->first())
        @php($language = $language->value ?? null)
        @php($default_lang = str_replace('_', '-', app()->getLocale()))
        @if($language)
            <ul class="nav nav-tabs mb-4 border-0">
                <li class="nav-item">
                    <a class="nav-link lang_link active"
                    href="#"
                    id="default-link">{{translate('messages.default')}}</a>
                </li>
                @foreach (json_decode($language) as $lang)
                    <li class="nav-item">
                        <a class="nav-link lang_link"
                            href="#"
                            id="{{ $lang }}-link">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                    </li>
                @endforeach
            </ul>
        @endif


        <form action="{{ route('admin.react_landing_page.service_store') }}" method="post" enctype="multipart/form-data" >
            @csrf
            <h5 class="card-title mb-3 mt-3">
                <span class="card-header-icon mr-2">
                    <img src="{{asset('assets/admin/img/react_services.png')}}" alt="" class="mw-100">
                </span>

                <span>{{translate('messages.Service_List_Section')}}</span>
            </h5>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        {{-- <div class="text--primary-2 py-1 d-flex flex-wrap align-items-center" type="button" data-toggle="modal" data-target="#section_view">
                            <strong class="mr-2">{{translate('Section View')}}</strong>
                            <div>
                                <i class="tio-intersect"></i>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6 lang_form default-form">
                                <input type="hidden" name="lang[]" value="default">
                                <div class="form-group">
                                    <label class="form-label">{{translate('title')}} ({{ translate('messages.default') }})
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="{{ translate('Write_the_title_within_20_characters') }}">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input type="text" maxlength="20"  name="title[]" class="form-control" placeholder="{{translate('Ex:_John')}}">
                                </div>
                                <div class="orm-group mb-0 pt-3">
                                    <label class="form-label">{{translate('messages.Subtitle')}} ({{ translate('messages.default') }})
                                       <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="{{ translate('Write_the_subtitle_within_80_characters') }}">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input type="text" name="sub_title[]" class="form-control" maxlength="80"  placeholder="{{translate('Very_Good_Company')}}">
                                </div>
                        </div>

                        @forelse(json_decode($language) as $lang)
                        <div class="col-md-6 d-none lang_form" id="{{$lang}}-form1">
                                <input type="hidden" name="lang[]" value="{{$lang}}">
                                <div class="form-group">
                                    <label class="form-label">{{translate('title')}} ({{strtoupper($lang)}})
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="{{ translate('Write_the_title_within_20_characters') }}">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input type="text" maxlength="20" name="title[]" class="form-control" placeholder="{{translate('Ex:_John')}}">
                                </div>
                                <div class="orm-group mb-0 pt-3">
                                    <label class="form-label">{{translate('messages.Subtitle')}} ({{strtoupper($lang)}})
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="{{ translate('Write_the_subtitle_within_80_characters') }}">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input type="text" name="sub_title[]" class="form-control" maxlength="80"  placeholder="{{translate('Very_Good_Company')}}">
                                </div>
                        </div>
                        @empty
                        @endforelse
                        <div class="col-sm-6">
                            <div class="ml-xl-5 pl-xxl-4">
                                    <label class="form-label d-block mb-2">
                                        {{translate('messages.Icon')}} / {{translate('messages.Image')}}   <span class="text--primary">{{translate('messages.(1:1)')}}</span>
                                    </label>
                                    <label class="upload-img-3 m-0">
                                        <div class="img">
                                            <img src="{{asset('/assets/admin/img/upload-3.png')}}"  class="vertical-img max-w-187px" alt="">
                                        </div>
                                        <input type="file"    name="image" hidden="">
                                    </label>
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end mt-3">
                        <button type="reset" class="btn btn--reset">{{translate('Reset')}}</button>
                        <button type="submit" onclick="" class="btn btn--primary mb-2">{{translate('save')}}</button>
                    </div>
                </form>
                </div>
            </div>


            <div class="card">
                <div class="card-header py-2">
                    <div class="search--button-wrapper">
                        <h5 class="card-title d-felx align-items-center">{{translate('messages.Services_List')}} <span class="badge badge-secondary ml-1"> {{ $services?->count() }}</span> </h5>
                        <form class="search-form">
                                        <!-- Search -->
                            <div class="input-group input--group">
                                <input id="datatableSearch_" type="search" name="search" value="{{ request()?->search ?? null }}" class="form-control"
                                        placeholder="{{translate('Search_title')}}" aria-label="{{translate('messages.search')}}" >
                                <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>

                            </div>
                            <!-- End Search -->
                        </form>
                        <!-- Unfold -->
                        <div class="hs-unfold mr-2">
                            <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle min-height-40" href="javascript:;"
                                data-hs-unfold-options='{
                                        "target": "#usersExportDropdown",
                                        "type": "css-animation"
                                    }'>
                                <i class="tio-download-to mr-1"></i> {{ translate('messages.export') }}
                            </a>

                            <div id="usersExportDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                                <span class="dropdown-header">{{ translate('messages.download_options') }}</span>
                                <a id="export-excel" class="dropdown-item" href="{{ route('admin.react_landing_page.service_export', ['type' => 'excel', request()->getQueryString()]) }}">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="{{ asset('assets/admin') }}/svg/components/excel.svg"
                                        alt="Image Description">
                                    {{ translate('messages.excel') }}
                                </a>
                                <a id="export-csv" class="dropdown-item" href="{{ route('admin.react_landing_page.service_export', ['type' => 'csv', request()->getQueryString()]) }}">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="{{ asset('assets/admin') }}/svg/components/placeholder-csv-format.svg"
                                        alt="Image Description">
                                    {{ translate('messages.csv') }}
                                </a>
                            </div>
                        </div>
                        <!-- End Unfold -->
                    </div>
                </div>
            <div class="card-body p-0">
                <div class="table-responsive datatable-custom">
                    <table class="table table-borderless table-thead-bordered table-align-middle table-nowrap card-table">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-top-0">{{translate('sl')}}</th>
                                <th class="border-top-0">{{translate('Title')}}</th>
                                <th class="border-top-0">{{translate('Subtitle')}}</th>
                                <th class="border-top-0">{{translate('Image')}}</th>
                                <th class="border-top-0">{{translate('Status')}}</th>
                                <th class="text-center border-top-0">{{translate('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($services as $key=>$service)
                            <tr>
                                <td>{{ $key+$services->firstItem() }}</td>
                                <td>
                                    <div class="text--title">
                                    {{ $service->title }}
                                    </div>
                                </td>
                                <td>
                                    <div class="word-break">
                                        {{ $service->sub_title }}
                                    </div>
                                </td>
                                <td>
                                    <img src="{{asset('storage/app/react_service_image')}}/{{$service->image}}"
                                    onerror="this.src='{{asset('/assets/admin/img/upload-3.png')}}'" class="__size-105" alt="">
                                </td>
                                <td>
                                    <label class="toggle-switch toggle-switch-sm">
                                        <input type="checkbox" class="toggle-switch-input" onclick="toogleStatusModal(event,'service_status_{{$service->id}}','testimonial-on.png','testimonial-off.png',`{{translate('Want_to_Enable_this')}} <strong>{{translate('services')}}`,`{{translate('Want_to_Disable_this')}} <strong>{{translate('services')}}`,`<p>{{translate('If_enabled,_it_will_be_shown_on_the_React_Landing_page.')}}</p>`,`<p>{{translate('If_disabled,_it_will_be_hidden_from_the_React_Landing_page')}}</p>`)"
                                            id="service_status_{{$service->id}}" {{$service->status?'checked':''}}>
                                        <span class="toggle-switch-label">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                    </label>
                                    <form action="{{route('admin.react_landing_page.service_status',[$service->id,$service->status?0:1])}}" method="get" id="service_status_{{$service->id}}_form">
                                    </form>
                                </td>

                                <td>
                                    <div class="btn--container justify-content-center">
                                        <a class="btn action-btn btn--primary btn-outline-primary" href="{{route('admin.react_landing_page.service_edit',[$service['id']])}}">
                                            <i class="tio-edit"></i>
                                        </a>
                                        <a class="btn action-btn btn--danger btn-outline-danger" href="javascript:"
                                        onclick="form_alert_service('service-{{$service['id']}}','{{ translate('Want_to_Delete_this_Service?') }}' ,'{{ translate('If_yes,_the_service_will_be_removed_from_this_list?') }}' )" title="{{translate('messages.delete_service')}}"><i class="tio-delete-outlined"></i>
                                        </a>
                                        <form action="{{route('admin.react_landing_page.service_delete',[$service['id']])}}" method="post" id="service-{{$service['id']}}">
                                            @csrf @method('delete')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                    @if(count($services) === 0)
                    <div class="empty--data">
                        <img src="{{asset('/assets/admin/img/empty.png')}}" alt="public">
                        <h5>
                            {{translate('no_data_found')}}
                        </h5>
                    </div>
                    @endif
                </div>
                <div class="page-area px-4 pb-3">
                    <div class="d-flex align-items-center justify-content-end">
                        <div>
                            {!! $services->appends(request()->all())->links() !!}
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>

    <!--  Section View -->
    <div class="modal fade" id="section_view">
        <div class="modal-dialog modal-lg warning-modal">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="mb-3">
                        <h3 class="modal-title mb-3">{{translate('Special_Criteria')}}</h3>
                    </div>
                    <img src="{{asset('/assets/admin/img/zone-instruction.png')}}" alt="admin/img" class="w-100">
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script_2')

    <script>
        $(".lang_link").click(function(e){
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');
            let form_id = this.id;
            let lang = form_id.substring(0, form_id.length - 5);
            console.log(lang);
            $("#"+lang+"-form").removeClass('d-none');
            $("#"+lang+"-form1").removeClass('d-none');
            if(lang == '{{$default_lang}}')
            {
                $(".from_part_2").removeClass('d-none');
            }
            if(lang == 'default')
            {
                $(".default-form").removeClass('d-none');
            }
            else
            {
                $(".from_part_2").addClass('d-none');
            }
        });


        function form_alert_service(id, message ,message_2)  {
            Swal.fire({
                title: message,
                text: message_2,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: '{{ translate('messages.No') }}',
                confirmButtonText: '{{ translate('messages.Yes') }}',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $('#' + id).submit()
                }
            })
        }

    </script>
@endpush

