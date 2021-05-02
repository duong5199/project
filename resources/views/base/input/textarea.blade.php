<div class="form-group">
    <label for="{{ $item['id'] ?? '' }}">
        {{ $item['label'] ?? 'label' }}

        @if(!empty($item['required']))
            @if($item['required'])
                <span class="text-danger">*</span>
            @endif
        @endif

    </label>

    <textarea name="{{ $name ?? '' }}" rows="{{ $item['rows'] ?? '4' }} "
              class="form-control {{ $item['class'] ?? '' }}" id="{{ $item['id'] ?? '' }}"
              placeholder="{{ $item['label'] ?? 'label' }}"></textarea>

</div>
