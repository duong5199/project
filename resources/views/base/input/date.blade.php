<div class="form-group">

    <label for="{{ $item['id'] ?? '' }}">
        {{ $item['label'] ?? 'label' }}

        @if(!empty($item['required']))
            @if($item['required'])
                <span class="text-danger">*</span>
            @endif
        @endif

    </label>

    <div class="input-group date" id="reservationdate_{{ $name ?? '' }}" data-target-input="nearest">

        <input type="text" name="{{ $name ?? '' }}" placeholder="{{ $item['label'] ?? 'label' }}"
               id="{{ $item['id'] ?? '' }}" class="form-control {{ $item['class'] ?? '' }} datepicker"
               data-target="#reservationdate_{{ $name ?? '' }}"/>

{{--        <div class="input-group-append datepicker" data-target="#reservationdate_{{ $name ?? '' }}" data-toggle="datetimepicker">--}}
{{--            <div class="input-group-text"><i class="fa fa-calendar"></i></div>--}}
{{--        </div>--}}
    </div>

</div>
