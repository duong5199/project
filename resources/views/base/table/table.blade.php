<table id="data-table" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th><input type="checkbox" name="select_all" value="1" id="data-table-select-all"></th>

        @foreach($column as $item)
            <th>{{ $item['label'] }}</th>
        @endforeach

        @if($action)
            <th width="100px">Hành Động</th>
        @endif
    </tr>
    </thead>
</table>
