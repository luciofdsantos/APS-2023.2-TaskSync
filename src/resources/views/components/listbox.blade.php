<div class="row">
    <div class="col-md-5">

        <select id="available" class="form-control" size="10" multiple>
            @foreach ($availableItems as $item)
                <option value="{{ $item['id'] }}">{{ $item['nome'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2 d-flex flex-column justify-content-center">
        <button class="btn btn-primary mb-2" type="button" id="moveRight">>></button>
        <button class="btn btn-secondary" type="button" id="moveLeft">
            <<< </button>
    </div>

    <div class="col-md-5">
        <select id="selected" class="form-control" name="selectedItems[]" size="10" multiple>
            @foreach ($selectedItems as $item)
                <option value="{{ $item['id'] }}">{{ $item->user->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<script>
    document.getElementById('moveRight').addEventListener('click', function() {
        moveItems('available', 'selected');
    });

    document.getElementById('moveLeft').addEventListener('click', function() {
        moveItems('selected', 'available');
    });

    function moveItems(from, to) {
        const fromSelect = document.getElementById(from);
        const toSelect = document.getElementById(to);
        const selectedOptions = Array.from(fromSelect.selectedOptions);

        selectedOptions.forEach(option => {
            toSelect.appendChild(option);
        });
    }
</script>
