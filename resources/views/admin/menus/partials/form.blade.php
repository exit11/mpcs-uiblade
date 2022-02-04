{!! Form::text('id')->type('hidden') !!}
{!! Form::text('parent_id')->type('hidden') !!}

<div class="form-group row">
    <label class="col">{{ Str::ucfirst(trans('ui-bootstrap5::word.is_visible_message')) }} </label>
    <div class="col-auto">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_visible">
            <label class="form-check-label"></label>
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <label>{{ Str::ucfirst(trans('mpcs-uiblade::word.attr.visible_period')) }}</label>
    <div class="input-group">
        <input data-type="data-picker-datetime" type="text" name="period_from" class="form-control"
            placeholder="{{ trans('mpcs-uiblade::word.attr.period_from') }}">
        <span class="input-group-text">~</span>
        <input data-type="data-picker-datetime" type="text" name="period_to" class="form-control"
            placeholder="{{ trans('mpcs-uiblade::word.attr.period_to') }}">
    </div>
</div>

<div class="form-group breadcrumb-wrap">
    <label>{{ trans('mpcs-uiblade::word.attr.parent_menu') }}</label>
    <div class="form-control">
    </div>
</div>

{!! Form::text('name', Str::ucfirst(trans('ui-bootstrap5::word.name')))->placeholder(Str::ucfirst(trans('ui-bootstrap5::word.name')))->wrapperAttrs(['class' => 'required']) !!}

{!! Form::text('description', Str::ucfirst(trans('ui-bootstrap5::word.description')))->placeholder(Str::ucfirst(trans('ui-bootstrap5::word.description'))) !!}

{!! Form::text('url', trans('mpcs-uiblade::word.attr.url'))->placeholder(trans('mpcs-uiblade::word.attr.url'))->type('url') !!}

<div class="form-group row">
    <label>{{ Str::title(trans('mpcs-uiblade::word.is_target_title')) }} </label>
    <div class="btn-group w-100" role="group">
        <input type="radio" class="btn-check" name="target" id="{{ $idPrefix }}target_self" value="_self"
            autocomplete="off" checked>
        <label class="btn btn-outline-dark" for="{{ $idPrefix }}target_self">
            <i class="mdi mdi-check"></i>
            {{ Str::title(trans('mpcs-uiblade::word.target_self')) }}
        </label>
        <input type="radio" class="btn-check" name="target" id="{{ $idPrefix }}target_blank" value="_blank"
            autocomplete="off">
        <label class="btn btn-outline-dark" for="{{ $idPrefix }}target_blank">
            <i class="mdi mdi-check"></i>
            {{ Str::title(trans('mpcs-uiblade::word.target_blank')) }}
        </label>
    </div>
</div>

<div class="form-group">
    <label for="image" class="">
        {{ trans('mpcs-uiblade::word.attr.background_image') }}
        <button type="button" class="btn p-0" data-bs-container="body" data-bs-toggle="popover"
            data-bs-placement="top" title="{{ trans('mpcs-uiblade::word.image_size') }}"
            data-bs-content="{{ Str::ucfirst(trans('mpcs-uiblade::word.image_size_desc', ['width' => '400px', 'height' => '620px'])) }}">
            <i class="mdi mdi-information"></i>
        </button>
    </label>
    <div data-type="image-upload">
        <div class="mx-auto mb-1">
            <img src="" class="upload-image img-fluid" data-default-src="{{ UiBlade::noImage() }}"
                data-crud-edit-name="image_file_url" data-crud-edit-type="image">
        </div>
        <input type="file" class="d-none" accept=".png,.jpg,.gif" />
        <input type="hidden" name="background_image" />
        <button type="button" class="btn btn-info align-middle" style="width: 100%" title="">
            <i class="mdi mdi-cloud-upload me-1"></i>
            {{ Str::title(trans('mpcs-uiblade::word.choose_a_file')) }}
        </button>
    </div>
</div>
