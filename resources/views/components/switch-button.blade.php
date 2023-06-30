@props(['label', 'checked'])
<div>
    <p class="label">{{ $label }}</p>
    <div class="switch">
        <input id="status" name="status" type="checkbox" value="1"  {{ $checked ? 'checked' : '' }}>
        <label for="status"></label>
    </div>
    @error('status')
        <span class="error">{{ $message }}</span>
    @enderror
</div>