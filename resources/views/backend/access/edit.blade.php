@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.users.management') }}
        <small>{{ trans('labels.backend.access.users.edit') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($user, ['route' => ['admin.access.user.update', $user], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.access.users.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.access.includes.partials.user-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('name', trans('validation.attributes.backend.access.users.firstName'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('first_name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.access.users.firstName'), 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('name', trans('validation.attributes.backend.access.users.lastName'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('last_name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.access.users.lastName'), 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('email', trans('validation.attributes.backend.access.users.email'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('email', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.access.users.email'), 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                {{-- address --}}
                <div class="form-group">
                    {{ Form::label('address', trans('validation.attributes.frontend.register-user.address'), ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-10">
                        {{ Form::input('textarea', 'address', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.frontend.register-user.address'), 'rows' => '3']) }}
                    </div><!--col-lg-10-->
                </div><!--form-group-->

                {{-- state --}}
                <div class="form-group">
                    {{ Form::label('state_id', trans('validation.attributes.frontend.register-user.state'), ['class' => 'col-lg-2 control-label required']) }}
                    <div class="col-lg-10">
                        {{ Form::select('state_id', [] , null, ['class' => 'form-control select2 box-size', 'placeholder' => trans('validation.attributes.frontend.register-user.state'), 'id' => 'state', 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form-group-->

                {{-- city --}}
                <div class="form-group">
                    {{ Form::label('city_id', trans('validation.attributes.frontend.register-user.city'), ['class' => 'col-lg-2 control-label required']) }}
                    <div class="col-lg-10">
                        {{ Form::select('city_id', [], null, ['class' => 'form-control select2 box-size', 'placeholder' => trans('validation.attributes.frontend.register-user.city'), 'id' => 'city', 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form-group-->

                {{-- zipcode --}}
                <div class="form-group">
                    {{ Form::label('zip_code', trans('validation.attributes.frontend.register-user.zipcode'), ['class' => 'col-lg-2 control-label required']) }}
                    <div class="col-lg-10">
                        {{ Form::input('name', 'zip_code', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.frontend.register-user.zipcode'), 'required' => 'required']) }}
                    </div><!--col-lg-6-->
                </div><!--form-group-->

                {{-- SSN --}}
                <div class="form-group">
                    {{ Form::label('ssn', trans('validation.attributes.frontend.register-user.ssn'), ['class' => 'col-lg-2 control-label required']) }}
                    <div class="col-lg-10">
                        {{ Form::input('name', 'ssn', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.frontend.register-user.ssn'), 'required' => 'required']) }}
                    </div><!--col-lg-6-->
                </div><!--form-group-->

                @if ($user->id != 1)
                    <div class="form-group">
                        {{ Form::label('status', trans('validation.attributes.backend.access.users.active'), ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-1">
                                <div class="control-group">
                                    <label class="control control--checkbox">
                                         {{ Form::checkbox('status', '1', $user->status == 1) }}
                                    <div class="control__indicator"></div>
                                    </label>
                                </div>
                        </div><!--col-lg-1-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('confirmed', trans('validation.attributes.backend.access.users.confirmed'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-1">
                            <div class="control-group">
                                <label class="control control--checkbox">
                                    {{ Form::checkbox('confirmed', '1', $user->confirmed == 1) }}
                                    <div class="control__indicator"></div>
                                </label>
                            </div>
                        </div><!--col-lg-1-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('status', trans('validation.attributes.backend.access.users.associated_roles'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-8">
                            @if (count($roles) > 0)
                                @foreach($roles as $role)
                                    <div>
                                    <label for="role-{{$role->id}}" class="control control--radio">
                                    <input type="radio" value="{{$role->id}}" name="assignees_roles[]" {{ is_array(old('assignees_roles')) ? (in_array($role->id, old('assignees_roles')) ? 'checked' : '') : (in_array($role->id, $user_roles) ? 'checked' : '') }} id="role-{{$role->id}}" class="get-role-for-permissions" />  &nbsp;&nbsp;{!! $role->name !!}
                                    <div class="control__indicator"></div>
                                    <a href="#" data-role="role_{{$role->id}}" class="show-permissions small">
                                        (
                                            <span class="show-text">{{ trans('labels.general.show') }}</span>
                                            <span class="hide-text hidden">{{ trans('labels.general.hide') }}</span>
                                            {{ trans('labels.backend.access.users.permissions') }}
                                        )
                                    </a>
                                    </label>
                                    </div>
                                    <div class="permission-list hidden" data-role="role_{{$role->id}}">
                                        @if ($role->all)
                                            {{ trans('labels.backend.access.users.all_permissions') }}
                                        @else
                                            @if (count($role->permissions) > 0)
                                                <blockquote class="small">{{--
                                            --}}@foreach ($role->permissions as $perm){{--
                                            --}}{{$perm->display_name}}
                                                    @endforeach
                                                </blockquote>
                                            @else
                                                {{ trans('labels.backend.access.users.no_permissions') }}<br/><br/>
                                            @endif
                                        @endif
                                    </div><!--permission list-->
                                @endforeach
                            @else
                                {{ trans('labels.backend.access.users.no_roles') }}
                            @endif
                        </div><!--col-lg-3-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('associated-permissions', trans('validation.attributes.backend.access.roles.associated_permissions'), ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            <div id="available-permissions" style="width: 700px; height: 200px; overflow-x: hidden; overflow-y: scroll;">
                                <div class="row">
                                    <div class="col-xs-12 get-available-permissions">
                                        @if ($permissions)
                                            @foreach ($permissions as $id => $display_name)
                                            <div class="control-group">                            
                                            <label class="control control--checkbox" for="perm_{{ $id }}">
                                                <input type="checkbox" name="permissions[{{ $id }}]" value="{{ $id }}" id="perm_{{ $id }}" {{ isset($userPermissions[$id]) && in_array($id, $userPermissions) ? 'checked' : '' }} /> <label for="perm_{{ $id }}">{{ $display_name }}</label>
                                                <div class="control__indicator"></div>
                                                </label>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>There are no available permissions.</p>
                                        @endif
                                    </div><!--col-lg-6-->
                                </div><!--row-->
                            </div><!--available permissions-->
                        </div><!--col-lg-3-->
                    </div><!--form control-->

                @endif
                <div class="edit-form-btn">
                    {{ link_to_route('admin.access.user.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
            </div><!-- /.box-body -->
        </div><!--box-->

        @if ($user->id == 1)
            {{ Form::hidden('status', 1) }}
            {{ Form::hidden('confirmed', 1) }}
            {{ Form::hidden('assignees_roles[]', 1) }}
        @endif

    {{ Form::close() }}
@endsection

@section('after-scripts')
    {{ Html::script('js/backend/access/users/script.js') }}

    <script type="text/javascript">
        $(document).ready(function() {
            //Getting States of default contry
            ajaxCall("{{route('admin.get.states')}}");

            FinBuilders.Access.init();

            //Getting Cities of select State
            $("#state").on("change", function() {
                var stateId = $(this).val();
                var url = "{{route('admin.get.cities')}}";
                ajaxCall(url, stateId);
            });

            function ajaxCall(url, data = null)
            {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {stateId: data},
                    success: function(result) {
                        if(result != null)
                        {
                            if(result.status == "city")
                            {
                                var userCity = "{{ $user->city_id }}";
                                var options;
                                $.each(result.data, function(key, value) {
                                    if(key == userCity)
                                        options += "<option value='" + key + "' selected>" + value + "</option>";
                                    else
                                        options += "<option value='" + key + "'>" + value + "</option>";
                                });
                                $("#city").html('');
                                $("#city").append(options);
                            }
                            else
                            {
                                var userState = "{{ $user->state_id }}";
                                var options;
                                $.each(result.data, function(key, value) {
                                    if(key == userState)
                                        options += "<option value='" + key + "' selected>" + value + "</option>";
                                    else
                                        options += "<option value='" + key + "'>" + value + "</option>";
                                });
                                $("#state").append(options);
                                $("#state").trigger('change');
                            }
                        }
                    }
                });
            }

            /**
             * This function is used to get clicked element role id and return required result
             */
            $('.get-role-for-permissions').click(function () {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.get.permission') }}",
                    dataType: "JSON",
                    data: {role_id: $(this).val()},
                    success: function (response) {
                        var p = response.permissions;
                        var q = response.rolePermissions;
                        var qAll = response.allPermissions;

                        $('.get-available-permissions').html('');
                        if (p.length == 0) {
                            ('.get-available-permissions').html('<p>There are no available permissions.</p>');
                        } else {
                            for (var key in p) {
                                var addChecked = '';
                                if (qAll == 1 && q.length == 0) {
                                    addChecked = 'checked="checked"';
                                } else {
                                    if (typeof q[key] !== "undefined") {
                                        addChecked = 'checked="checked"';
                                    }
                                }
                                $('<label class="control control--checkbox"> <input type="checkbox" name="permissions[' + key + ']" value="' + key + '" id="perm_' + key + '" ' + addChecked + ' /> <label for="perm_' + key + '">' + p[key] + '</label> <div class="control__indicator"></div> </label><br>').appendTo('.get-available-permissions');
                            }
                        }
                        $('#available-permissions').removeClass('hidden');
                    }
                });
            });

        });
    </script>
@endsection
