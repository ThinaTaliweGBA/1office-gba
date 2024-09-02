<button type="{{ $type }}" class="{{ $class }}"
    @if (!empty($id)) id="{{ $id }}" @endif
    @if($type === 'back') onclick="window.history.back()" @endif>
    {{ $text }}
</button>


