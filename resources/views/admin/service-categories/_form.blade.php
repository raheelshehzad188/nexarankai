@php $categoryModel = $serviceCategory ?? null; @endphp

<div class="mb-3">
    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
        value="{{ old('name', $categoryModel->name ?? '') }}" required>
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="slug" class="form-label">Slug</label>
    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
        value="{{ old('slug', $categoryModel->slug ?? '') }}" placeholder="auto-generated-from-name">
    @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $categoryModel->description ?? '') }}</textarea>
    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="sort_order" class="form-label">Sort Order</label>
    <input type="number" class="form-control" id="sort_order" name="sort_order" min="0"
        value="{{ old('sort_order', $categoryModel->sort_order ?? 0) }}">
</div>

<div class="mb-3">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
            {{ old('status', $categoryModel->status ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="status">Active</label>
    </div>
</div>
