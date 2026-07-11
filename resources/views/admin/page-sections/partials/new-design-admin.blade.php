<script>
window.NewDesignAdmin = {
    configs: {
        'new-design-hero': {
            label: 'New design - Hero',
            bg: true,
            mobileBg: true,
            fields: [
                { key: 'title', label: 'Title (use new line for line breaks)', type: 'textarea', rows: 3 },
                { key: 'subtitle', label: 'Subtitle / Eyebrow', type: 'text' },
                { key: 'button_text', label: 'Button Text', type: 'text' },
                { key: 'button_url', label: 'Button URL', type: 'text' },
            ],
            repeater: { key: 'features', label: 'Feature Items', subfields: ['icon', 'text'], min: 4 },
        },
        'new-design-promise': {
            label: 'New design - Promise',
            bg: true,
            fields: [
                { key: 'eyebrow', label: 'Eyebrow', type: 'text' },
                { key: 'title', label: 'Title', type: 'textarea', rows: 2 },
                { key: 'paragraph_1', label: 'Paragraph 1', type: 'textarea', rows: 2 },
                { key: 'paragraph_2', label: 'Paragraph 2', type: 'textarea', rows: 2 },
                { key: 'card_image_url', label: 'Card Image URL', type: 'url' },
                { key: 'card_title', label: 'Card Title', type: 'text' },
                { key: 'card_text', label: 'Card Text', type: 'textarea', rows: 2 },
            ],
            repeaters: [
                { key: 'features', label: 'Top Features', subfields: ['icon', 'title', 'text'] },
                { key: 'features_2', label: 'Bottom Features', subfields: ['icon', 'title', 'text'] },
            ],
        },
        'new-design-difference': {
            label: 'New design - Difference',
            fields: [
                { key: 'eyebrow', label: 'Eyebrow', type: 'text' },
                { key: 'title', label: 'Title', type: 'textarea', rows: 2 },
                { key: 'description', label: 'Description', type: 'textarea', rows: 3 },
                { key: 'before_image_url', label: 'Before Image URL', type: 'url' },
                { key: 'after_image_url', label: 'After Image URL', type: 'url' },
            ],
            repeater: { key: 'features', label: 'Features', subfields: ['icon', 'text'] },
        },
        'new-design-included': {
            label: 'New design - Included',
            fields: [
                { key: 'eyebrow', label: 'Eyebrow', type: 'text' },
                { key: 'title', label: 'Title', type: 'text' },
            ],
            repeater: { key: 'items', label: 'Service Items', subfields: ['icon', 'title', 'text'] },
        },
        'new-design-process': {
            label: 'New design - Process',
            fields: [
                { key: 'eyebrow', label: 'Eyebrow', type: 'text' },
                { key: 'title', label: 'Title', type: 'text' },
                { key: 'description', label: 'Description', type: 'textarea', rows: 3 },
                { key: 'button_text', label: 'Button Text', type: 'text' },
                { key: 'button_url', label: 'Button URL', type: 'text' },
            ],
            repeater: { key: 'steps', label: 'Process Steps', subfields: ['number', 'icon', 'title', 'text'] },
        },
        'new-design-results': {
            label: 'New design - Results',
            fields: [
                { key: 'eyebrow', label: 'Eyebrow', type: 'text' },
                { key: 'title', label: 'Title', type: 'text' },
            ],
            repeater: { key: 'slides', label: 'Slides', subfields: ['location', 'before_image_url', 'after_image_url', 'review', 'name'] },
        },
        'new-design-breathe': {
            label: 'New design - Breathe',
            bg: true,
            fields: [
                { key: 'eyebrow', label: 'Eyebrow', type: 'text' },
                { key: 'title', label: 'Title', type: 'textarea', rows: 2 },
                { key: 'description', label: 'Description', type: 'textarea', rows: 2 },
                { key: 'button_text', label: 'Button Text', type: 'text' },
                { key: 'button_url', label: 'Button URL', type: 'text' },
            ],
        },
        'new-design-nadca': {
            label: 'New design - NADCA',
            bg: true,
            fields: [
                { key: 'eyebrow', label: 'Eyebrow', type: 'text' },
                { key: 'title', label: 'Title', type: 'textarea', rows: 2 },
                { key: 'description', label: 'Description', type: 'textarea', rows: 2 },
                { key: 'logo_image_url', label: 'Logo Image URL', type: 'url' },
                { key: 'card_text', label: 'Card Text', type: 'textarea', rows: 3 },
            ],
            repeater: { key: 'features', label: 'Features', subfields: ['icon', 'title', 'text'] },
        },
        'new-design-areas': {
            label: 'New design - Areas',
            bg: true,
            fields: [
                { key: 'eyebrow', label: 'Eyebrow', type: 'text' },
                { key: 'title', label: 'Title', type: 'textarea', rows: 2 },
                { key: 'description', label: 'Description', type: 'textarea', rows: 2 },
                { key: 'van_image_url', label: 'Van Card Image URL', type: 'url' },
                { key: 'phone', label: 'Phone', type: 'text' },
                { key: 'phone_label', label: 'Phone Label', type: 'text' },
                { key: 'whatsapp', label: 'WhatsApp', type: 'text' },
                { key: 'whatsapp_label', label: 'WhatsApp Label', type: 'text' },
            ],
            list: { key: 'locations', label: 'Locations (one per line)' },
        },
        'new-design-pricing': {
            label: 'New design - Pricing',
            bg: true,
            fields: [
                { key: 'eyebrow', label: 'Eyebrow', type: 'text' },
                { key: 'title', label: 'Title', type: 'text' },
                { key: 'subtitle', label: 'Subtitle', type: 'text' },
                { key: 'description', label: 'Description', type: 'textarea', rows: 2 },
            ],
        },
        'new-design-quote': {
            label: 'New design - Quote',
            bg: true,
            fields: [
                { key: 'eyebrow', label: 'Eyebrow', type: 'text' },
                { key: 'title', label: 'Title', type: 'text' },
                { key: 'description', label: 'Description', type: 'textarea', rows: 2 },
                { key: 'badge_image_url', label: 'Badge Image URL', type: 'url' },
            ],
        },
        'new-design-privacy-hero': {
            label: 'New design - Privacy Hero',
            bg: true,
            fields: [
                { key: 'title', label: 'Title', type: 'text' },
                { key: 'updated_text', label: 'Last Updated Text', type: 'text' },
                { key: 'description', label: 'Description', type: 'textarea', rows: 3 },
            ],
        },
        'new-design-privacy-content': {
            label: 'New design - Privacy Content',
            repeater: { key: 'blocks', label: 'Content Blocks', subfields: ['icon', 'title', 'content'] },
        },
    },

    isType(type) {
        return type && type.startsWith('new-design-');
    },

    esc(value) {
        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    },

    bgFields(data = {}) {
        const source = data.background_image_source || 'url';
        const uploadPath = data.background_image || '';
        const previewUrl = source === 'upload' && uploadPath
            ? (uploadPath.startsWith('http') ? uploadPath : '/' + (uploadPath.startsWith('uploads/') ? uploadPath : 'uploads/' + uploadPath))
            : (data.background_image_url || '');
        return `
            <h6 class="mt-3 mb-2">Desktop Background Image</h6>
            <div class="mb-3">
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="nd_background_image_source" id="nd_bg_source_upload" value="upload" ${source === 'upload' ? 'checked' : ''}>
                    <label class="btn btn-outline-primary" for="nd_bg_source_upload">Upload</label>
                    <input type="radio" class="btn-check" name="nd_background_image_source" id="nd_bg_source_url" value="url" ${source === 'url' ? 'checked' : ''}>
                    <label class="btn btn-outline-primary" for="nd_bg_source_url">URL</label>
                </div>
            </div>
            <div class="mb-2" id="nd_bg_upload" style="display:${source === 'upload' ? 'block' : 'none'};">
                <label class="form-label">Upload Background</label>
                <input type="file" class="form-control" name="new_design_background_image_file" accept="image/*">
                ${uploadPath ? `<small class="text-muted d-block mt-1">Current file: <a href="${previewUrl}" target="_blank">View</a></small>` : ''}
            </div>
            <div class="mb-2" id="nd_bg_url" style="display:${source === 'url' ? 'block' : 'none'};">
                <label class="form-label">Background Image URL</label>
                <input type="url" class="form-control" id="nd_background_image_url" placeholder="https://...">
            </div>
            ${previewUrl && source === 'url' ? `<div class="mb-2"><img src="${previewUrl}" alt="Preview" class="img-thumbnail" style="max-height:120px;"></div>` : ''}
        `;
    },

    mobileBgFields() {
        return `
            <h6 class="mt-3 mb-2">Mobile Background Image (optional)</h6>
            <div class="mb-2">
                <label class="form-label">Mobile Background URL</label>
                <input type="url" class="form-control" id="nd_mobile_background_image_url" placeholder="https://...">
                <small class="text-muted">Shown on screens below 768px</small>
            </div>
        `;
    },

    fieldHtml(field, value = '') {
        const id = 'nd_' + field.key;
        if (field.type === 'textarea') {
            return `<div class="mb-2"><label class="form-label">${field.label}</label><textarea class="form-control" id="${id}" rows="${field.rows || 3}">${this.esc(value)}</textarea></div>`;
        }
        const inputType = field.type === 'url' ? 'url' : 'text';
        return `<div class="mb-2"><label class="form-label">${field.label}</label><input type="${inputType}" class="form-control" id="${id}" value="${this.esc(value)}"></div>`;
    },

    repeaterHtml(config, items = []) {
        const min = config.min || 1;
        const list = items.length >= min ? items : [...items, ...Array(Math.max(0, min - items.length)).fill({})];
        const rows = (list.length ? list : [{}]).map((item, index) => {
            const fields = config.subfields.map((sub) => {
                const id = `nd_${config.key}_${index}_${sub}`;
                const val = item[sub] ?? '';
                const isLong = sub.includes('review') || sub === 'text' || sub === 'content';
                if (isLong) {
                    return `<div class="mb-2"><label class="form-label text-capitalize">${sub.replace(/_/g, ' ')}</label><textarea class="form-control" data-nd-field="${sub}" rows="2">${this.esc(val)}</textarea></div>`;
                }
                return `<div class="mb-2"><label class="form-label text-capitalize">${sub.replace(/_/g, ' ')}</label><input type="text" class="form-control" data-nd-field="${sub}" value="${this.esc(val)}"></div>`;
            }).join('');
            return `<div class="nd-repeater-item mb-3 p-3 border rounded" data-repeater="${config.key}" data-index="${index}">${fields}<button type="button" class="btn btn-sm btn-danger nd-remove-item">Remove</button></div>`;
        }).join('');

        return `
            <h6 class="mt-3 mb-2">${config.label}</h6>
            <div id="nd_repeater_${config.key}">${rows}</div>
            <button type="button" class="btn btn-sm btn-outline-primary nd-add-item" data-repeater="${config.key}" data-subfields='${JSON.stringify(config.subfields)}'>Add Item</button>
        `;
    },

    renderFields(type, data = {}) {
        const config = this.configs[type];
        if (!config) return '<p class="text-muted">No admin fields configured for this section.</p>';

        let html = `<div class="alert alert-info py-2 mb-3 small">New design section — edit content and background below.</div>`;
        html += `<label class="form-label fw-semibold">${config.label}</label>`;
        if (config.bg) html += this.bgFields(data);
        if (config.mobileBg) html += this.mobileBgFields();
        (config.fields || []).forEach((field) => html += this.fieldHtml(field, data[field.key] || ''));
        if (config.repeater) html += this.repeaterHtml(config.repeater, data[config.repeater.key] || []);
        (config.repeaters || []).forEach((rep) => html += this.repeaterHtml(rep, data[rep.key] || []));
        if (config.list) {
            const listVal = Array.isArray(data[config.list.key])
                ? data[config.list.key].map((l) => (typeof l === 'object' ? (l.name || '') : l)).join('\n')
                : '';
            html += `<div class="mb-2 mt-3"><label class="form-label">${config.list.label}</label><textarea class="form-control" id="nd_${config.list.key}" rows="5">${this.esc(listVal)}</textarea></div>`;
        }
        return html;
    },

    initFields(type, data = {}) {
        const config = this.configs[type];
        if (!config) return;

        if (config.bg) {
            const source = data.background_image_source || 'url';
            const uploadRadio = document.getElementById('nd_bg_source_upload');
            const urlRadio = document.getElementById('nd_bg_source_url');
            const uploadWrap = document.getElementById('nd_bg_upload');
            const urlWrap = document.getElementById('nd_bg_url');
            if (source === 'upload' && uploadRadio) uploadRadio.checked = true;
            if (source === 'url' && urlRadio) urlRadio.checked = true;
            if (uploadWrap && urlWrap) {
                uploadWrap.style.display = source === 'upload' ? 'block' : 'none';
                urlWrap.style.display = source === 'url' ? 'block' : 'none';
            }
            document.querySelectorAll('input[name="nd_background_image_source"]').forEach((radio) => {
                radio.addEventListener('change', function () {
                    uploadWrap.style.display = this.value === 'upload' ? 'block' : 'none';
                    urlWrap.style.display = this.value === 'url' ? 'block' : 'none';
                });
            });
            const bgUrl = document.getElementById('nd_background_image_url');
            if (bgUrl) bgUrl.value = data.background_image_url || '';
        }

        if (config.mobileBg) {
            const mobileBg = document.getElementById('nd_mobile_background_image_url');
            if (mobileBg) mobileBg.value = data.mobile_background_image_url || '';
        }

        (config.fields || []).forEach((field) => {
            const el = document.getElementById('nd_' + field.key);
            if (el) el.value = data[field.key] || '';
        });

        const repeaters = [];
        if (config.repeater) repeaters.push(config.repeater);
        (config.repeaters || []).forEach((r) => repeaters.push(r));
        repeaters.forEach((rep) => this.populateRepeater(rep, data[rep.key] || []));

        if (config.list) {
            const listEl = document.getElementById('nd_' + config.list.key);
            if (listEl && Array.isArray(data[config.list.key])) {
                listEl.value = data[config.list.key].join('\n');
            }
        }

        document.querySelectorAll('.nd-add-item').forEach((btn) => {
            btn.addEventListener('click', () => {
                const key = btn.dataset.repeater;
                const subfields = JSON.parse(btn.dataset.subfields || '[]');
                const container = document.getElementById('nd_repeater_' + key);
                const index = container.querySelectorAll('.nd-repeater-item').length;
                const item = {};
                subfields.forEach((s) => item[s] = '');
                const wrap = document.createElement('div');
                wrap.className = 'nd-repeater-item mb-3 p-3 border rounded';
                wrap.dataset.repeater = key;
                wrap.dataset.index = index;
                wrap.innerHTML = subfields.map((sub) => {
                    const isLong = sub.includes('review') || sub === 'text' || sub === 'content';
                    if (isLong) return `<div class="mb-2"><label class="form-label text-capitalize">${sub.replace(/_/g, ' ')}</label><textarea class="form-control" data-nd-field="${sub}" rows="2"></textarea></div>`;
                    return `<div class="mb-2"><label class="form-label text-capitalize">${sub.replace(/_/g, ' ')}</label><input type="text" class="form-control" data-nd-field="${sub}"></div>`;
                }).join('') + '<button type="button" class="btn btn-sm btn-danger nd-remove-item">Remove</button>';
                container.appendChild(wrap);
                this.bindRemoveButtons();
            });
        });

        this.bindRemoveButtons();
    },

    populateRepeater(config, items) {
        const container = document.getElementById('nd_repeater_' + config.key);
        if (!container) return;
        const min = config.min || 1;
        const list = items.length >= min ? items : [...items, ...Array(Math.max(0, min - items.length)).fill({})];
        container.innerHTML = '';
        (list.length ? list : [{}]).forEach((item, index) => {
            const wrap = document.createElement('div');
            wrap.className = 'nd-repeater-item mb-3 p-3 border rounded';
            wrap.dataset.repeater = config.key;
            wrap.dataset.index = index;
            wrap.innerHTML = config.subfields.map((sub) => {
                const val = this.esc(item[sub] ?? '');
                const isLong = sub.includes('review') || sub === 'text' || sub === 'content';
                if (isLong) return `<div class="mb-2"><label class="form-label text-capitalize">${sub.replace(/_/g, ' ')}</label><textarea class="form-control" data-nd-field="${sub}" rows="2">${val}</textarea></div>`;
                return `<div class="mb-2"><label class="form-label text-capitalize">${sub.replace(/_/g, ' ')}</label><input type="text" class="form-control" data-nd-field="${sub}" value="${val}"></div>`;
            }).join('') + '<button type="button" class="btn btn-sm btn-danger nd-remove-item">Remove</button>';
            container.appendChild(wrap);
        });
    },

    bindRemoveButtons() {
        document.querySelectorAll('.nd-remove-item').forEach((btn) => {
            btn.onclick = function () {
                const container = this.closest('[id^="nd_repeater_"]');
                if (container && container.querySelectorAll('.nd-repeater-item').length > 1) {
                    this.closest('.nd-repeater-item').remove();
                }
            };
        });
    },

    collectRepeater(key, subfields) {
        const items = [];
        document.querySelectorAll(`.nd-repeater-item[data-repeater="${key}"]`).forEach((row) => {
            const item = {};
            subfields.forEach((sub) => {
                const field = row.querySelector(`[data-nd-field="${sub}"]`);
                item[sub] = field ? field.value : '';
            });
            if (Object.values(item).some((v) => String(v).trim() !== '')) items.push(item);
        });
        return items;
    },

    collectData(type) {
        const config = this.configs[type];
        const data = {};
        if (!config) return data;

        if (config.bg) {
            const source = document.querySelector('input[name="nd_background_image_source"]:checked')?.value || 'url';
            data.background_image_source = source;
            if (source === 'url') {
                data.background_image_url = document.getElementById('nd_background_image_url')?.value || '';
                data.background_image = null;
            } else {
                data.background_image_url = null;
            }
        }

        if (config.mobileBg) {
            data.mobile_background_image_url = document.getElementById('nd_mobile_background_image_url')?.value || '';
        }

        (config.fields || []).forEach((field) => {
            data[field.key] = document.getElementById('nd_' + field.key)?.value || '';
        });

        if (config.repeater) {
            data[config.repeater.key] = this.collectRepeater(config.repeater.key, config.repeater.subfields);
        }
        (config.repeaters || []).forEach((rep) => {
            data[rep.key] = this.collectRepeater(rep.key, rep.subfields);
        });

        if (config.list) {
            const raw = document.getElementById('nd_' + config.list.key)?.value || '';
            data[config.list.key] = raw.split('\n').map((l) => l.trim()).filter(Boolean);
        }

        return data;
    },
};
</script>
