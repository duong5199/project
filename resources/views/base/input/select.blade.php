<div class="form-group">
    <label for="{{ $item['id'] ?? '' }}">
        {{ $item['label'] ?? 'label' }}

        @if(!empty($item['required']))
            @if($item['required'])
                <span class="text-danger">*</span>
            @endif
        @endif

    </label>

    <select name="{{ $name ?? '' }}" class="form-control select2 {{ $item['class'] ?? '' }}"
            id="{{ $item['id'] ?? '' }}"
            style="width: 100%;">

        @if(!empty($item['option']))
            @foreach($item['option'] as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        @endif

    </select>

    @if(!empty($item['route']))
        <script>
            options_select2["{{ $name ?? '' }}"] = {
                selector: $('select[name="{{ $name ?? '' }}"]'),
                url: "{{ route($item['route']) }}",
                placeholder: "{{ $item['label'] }}",
                multiple: false,
                hide_search: false,
            }
        </script>
    @endif

</div>
