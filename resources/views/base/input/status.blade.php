<div class="form-group">
    <label for="{{ $item['id'] ?? '' }}" class="mr-4 mt-2 mb-2">
        {{ $item['label'] ?? 'label' }}

        @if(!empty($item['required']))
            @if($item['required'])
                <span class="text-danger">*</span>
            @endif
        @endif

    </label>

    <input type="checkbox" class="{{ $item['class'] ?? '' }}" name="{{ $name ?? '' }}" id="{{ $item['id'] ?? '' }}"
           checked data-bootstrap-switch
           data-off-color="danger" data-on-color="success"
           data-on-text="Hoạt động"
           data-off-text="Bản nháp"
           data-size="small">
</div>
