<div class="form-group">
    <label>Status</label>
    <select name="status" id="status"
        class="form-select @error('status') is-invalid @elseif($status != '') is-valid @enderror"
        {!! wireModel('status') !!}>
        <option value="pending">Pending</option>
        <option value="accepted">Accepted</option>
        <option value="rejected">Rejected</option>
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
