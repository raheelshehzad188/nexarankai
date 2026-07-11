<script>
window.IrhasAdmin = {
    configs: {
        'irhas-about': {
            label: 'Irhas - About',
            fields: [
                { key: 'eyebrow', label: 'Eyebrow', type: 'text' },
                { key: 'title', label: 'Title', type: 'text' },
                { key: 'description', label: 'Description', type: 'textarea', rows: 3 },
                { key: 'button_text', label: 'Button Text', type: 'text' },
                { key: 'button_url', label: 'Button URL', type: 'text' },
                { key: 'video_url', label: 'Video URL (YouTube)', type: 'url' },
                { key: 'video_poster', label: 'Video Poster Image (theme path or URL)', type: 'text' },
                { key: 'secondary_image', label: 'Secondary Image (theme path or URL)', type: 'text' },
            ],
        },
        'irhas-portfolio': {
            label: 'Irhas - Portfolio',
            fields: [
                { key: 'eyebrow', label: 'Eyebrow', type: 'text' },
                { key: 'title', label: 'Title', type: 'text' },
                { key: 'description', label: 'Description', type: 'textarea', rows: 3 },
                { key: 'button_text', label: 'Button Text', type: 'text' },
                { key: 'button_url', label: 'Button URL', type: 'text' },
            ],
            repeater: { key: 'items', label: 'Portfolio Items', subfields: ['title', 'category', 'excerpt', 'image', 'link'], min: 1 },
        },
        'irhas-services': {
            label: 'Irhas - Services',
            fields: [
                { key: 'eyebrow', label: 'Eyebrow', type: 'text' },
                { key: 'title', label: 'Title', type: 'text' },
                { key: 'description', label: 'Description', type: 'textarea', rows: 3 },
                { key: 'button_text', label: 'Button Text', type: 'text' },
                { key: 'button_url', label: 'Button URL', type: 'text' },
            ],
            repeater: { key: 'items', label: 'Service Items', subfields: ['title', 'category', 'image', 'link'], min: 1 },
        },
        'irhas-testimonial': {
            label: 'Irhas - Testimonial',
            fields: [
                { key: 'eyebrow', label: 'Eyebrow', type: 'text' },
                { key: 'title', label: 'Title (Desktop)', type: 'text' },
                { key: 'title_mobile', label: 'Title (Mobile)', type: 'text' },
                { key: 'description', label: 'Description', type: 'textarea', rows: 3 },
                { key: 'button_text', label: 'Button Text', type: 'text' },
                { key: 'button_url', label: 'Button URL', type: 'text' },
                { key: 'side_image', label: 'Side Image (theme path or URL)', type: 'text' },
            ],
            repeater: { key: 'items', label: 'Testimonials', subfields: ['author', 'job', 'quote'], min: 1 },
        },
        'irhas-counter': {
            label: 'Irhas - Counter',
            repeater: { key: 'items', label: 'Counter Items', subfields: ['prefix', 'number', 'suffix', 'label'], min: 1 },
        },
        'irhas-blog': {
            label: 'Irhas - Blog (Home Latest)',
            fields: [
                { key: 'eyebrow', label: 'Eyebrow', type: 'text' },
                { key: 'title', label: 'Title', type: 'text' },
                { key: 'posts_limit', label: 'Number of Posts to Show', type: 'text' },
                { key: 'view_all_text', label: 'View All Button Text', type: 'text' },
                { key: 'view_all_url', label: 'View All URL', type: 'text' },
            ],
        },
        'irhas-blog-list': {
            label: 'Irhas - All Blog Posts Page',
            fields: [
                { key: 'banner_eyebrow', label: 'Banner Eyebrow', type: 'text' },
                { key: 'banner_title', label: 'Banner Title', type: 'text' },
            ],
        },
        'irhas-services-list': {
            label: 'Irhas - All Services Page',
            fields: [
                { key: 'banner_eyebrow', label: 'Banner Eyebrow', type: 'text' },
                { key: 'banner_title', label: 'Banner Title', type: 'text' },
                { key: 'default_card_image', label: 'Default Card Image (theme path or URL)', type: 'text' },
                { key: 'contact_title', label: 'Contact Banner Title', type: 'text' },
                { key: 'contact_description', label: 'Contact Banner Description', type: 'textarea', rows: 3 },
                { key: 'contact_button_text', label: 'Contact Button Text', type: 'text' },
                { key: 'contact_button_url', label: 'Contact Button URL', type: 'text' },
            ],
        },
        'irhas-contact': {
            label: 'Irhas - Contact Page',
            fields: [
                { key: 'eyebrow', label: 'Eyebrow', type: 'text' },
                { key: 'title', label: 'Title', type: 'text' },
                { key: 'map_embed_url', label: 'Google Maps Embed URL', type: 'url' },
                { key: 'weekday_hours', label: 'Weekday Hours', type: 'text' },
                { key: 'weekend_hours', label: 'Weekend Hours', type: 'text' },
                { key: 'submit_button_text', label: 'Submit Button Text', type: 'text' },
            ],
        },
    },

    isType(type) {
        return type && type.startsWith('irhas-');
    },

    esc(value) {
        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    },

    fieldHtml(field, value = '') {
        const id = 'ir_' + field.key;
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
                const val = item[sub] ?? '';
                const isLong = sub === 'quote' || sub === 'excerpt' || sub === 'description';
                if (isLong) {
                    return `<div class="mb-2"><label class="form-label text-capitalize">${sub.replace(/_/g, ' ')}</label><textarea class="form-control" data-ir-field="${sub}" rows="2">${this.esc(val)}</textarea></div>`;
                }
                return `<div class="mb-2"><label class="form-label text-capitalize">${sub.replace(/_/g, ' ')}</label><input type="text" class="form-control" data-ir-field="${sub}" value="${this.esc(val)}"></div>`;
            }).join('');
            return `<div class="ir-repeater-item mb-3 p-3 border rounded" data-repeater="${config.key}" data-index="${index}">${fields}<button type="button" class="btn btn-sm btn-danger ir-remove-item">Remove</button></div>`;
        }).join('');

        return `
            <h6 class="mt-3 mb-2">${config.label}</h6>
            <div id="ir_repeater_${config.key}">${rows}</div>
            <button type="button" class="btn btn-sm btn-outline-primary ir-add-item" data-repeater="${config.key}" data-subfields='${JSON.stringify(config.subfields)}'>Add Item</button>
        `;
    },

    renderFields(type, data = {}) {
        const config = this.configs[type];
        if (!config) return '<p class="text-muted">No admin fields configured for this section.</p>';

        let html = `<div class="alert alert-info py-2 mb-3 small">Irhas section — edit content below. Image fields accept theme paths like img/project-1-irhas3.png or full URLs.</div>`;
        if (type === 'irhas-services-list') {
            html += `<div class="alert alert-secondary py-2 mb-3 small">All services are loaded automatically from <strong>Admin → Services</strong>. Edit banner and contact CTA fields below.</div>`;
        }
        if (type === 'irhas-blog-list' || type === 'irhas-blog') {
            html += `<div class="alert alert-secondary py-2 mb-3 small">Blog posts load automatically from <strong>Admin → Blog Posts</strong>. Manage posts and categories there.</div>`;
        }
        if (type === 'irhas-contact') {
            html += `<div class="alert alert-secondary py-2 mb-3 small">Phone, email, address and social links load from <strong>Admin → Site Settings</strong>. Service dropdown loads from <strong>Admin → Services</strong>.</div>`;
        }
        html += `<label class="form-label fw-semibold">${config.label}</label>`;
        (config.fields || []).forEach((field) => html += this.fieldHtml(field, data[field.key] || ''));
        if (config.repeater) html += this.repeaterHtml(config.repeater, data[config.repeater.key] || []);
        return html;
    },

    initFields(type, data = {}) {
        const config = this.configs[type];
        if (!config) return;

        (config.fields || []).forEach((field) => {
            const el = document.getElementById('ir_' + field.key);
            if (el) el.value = data[field.key] || '';
        });

        if (config.repeater) this.populateRepeater(config.repeater, data[config.repeater.key] || []);

        document.querySelectorAll('.ir-add-item').forEach((btn) => {
            btn.addEventListener('click', () => {
                const key = btn.dataset.repeater;
                const subfields = JSON.parse(btn.dataset.subfields || '[]');
                const container = document.getElementById('ir_repeater_' + key);
                const wrap = document.createElement('div');
                wrap.className = 'ir-repeater-item mb-3 p-3 border rounded';
                wrap.dataset.repeater = key;
                wrap.innerHTML = subfields.map((sub) => {
                    const isLong = sub === 'quote' || sub === 'excerpt' || sub === 'description';
                    if (isLong) return `<div class="mb-2"><label class="form-label text-capitalize">${sub.replace(/_/g, ' ')}</label><textarea class="form-control" data-ir-field="${sub}" rows="2"></textarea></div>`;
                    return `<div class="mb-2"><label class="form-label text-capitalize">${sub.replace(/_/g, ' ')}</label><input type="text" class="form-control" data-ir-field="${sub}"></div>`;
                }).join('') + '<button type="button" class="btn btn-sm btn-danger ir-remove-item">Remove</button>';
                container.appendChild(wrap);
                this.bindRemoveButtons();
            });
        });

        this.bindRemoveButtons();
    },

    populateRepeater(config, items) {
        const container = document.getElementById('ir_repeater_' + config.key);
        if (!container) return;
        const min = config.min || 1;
        const list = items.length >= min ? items : [...items, ...Array(Math.max(0, min - items.length)).fill({})];
        container.innerHTML = '';
        (list.length ? list : [{}]).forEach((item, index) => {
            const wrap = document.createElement('div');
            wrap.className = 'ir-repeater-item mb-3 p-3 border rounded';
            wrap.dataset.repeater = config.key;
            wrap.dataset.index = index;
            wrap.innerHTML = config.subfields.map((sub) => {
                const val = this.esc(item[sub] ?? '');
                const isLong = sub === 'quote' || sub === 'excerpt' || sub === 'description';
                if (isLong) return `<div class="mb-2"><label class="form-label text-capitalize">${sub.replace(/_/g, ' ')}</label><textarea class="form-control" data-ir-field="${sub}" rows="2">${val}</textarea></div>`;
                return `<div class="mb-2"><label class="form-label text-capitalize">${sub.replace(/_/g, ' ')}</label><input type="text" class="form-control" data-ir-field="${sub}" value="${val}"></div>`;
            }).join('') + '<button type="button" class="btn btn-sm btn-danger ir-remove-item">Remove</button>';
            container.appendChild(wrap);
        });
    },

    bindRemoveButtons() {
        document.querySelectorAll('.ir-remove-item').forEach((btn) => {
            btn.onclick = function () {
                const container = this.closest('[id^="ir_repeater_"]');
                if (container && container.querySelectorAll('.ir-repeater-item').length > 1) {
                    this.closest('.ir-repeater-item').remove();
                }
            };
        });
    },

    collectRepeater(key, subfields) {
        const items = [];
        document.querySelectorAll(`.ir-repeater-item[data-repeater="${key}"]`).forEach((row) => {
            const item = {};
            subfields.forEach((sub) => {
                const field = row.querySelector(`[data-ir-field="${sub}"]`);
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

        (config.fields || []).forEach((field) => {
            data[field.key] = document.getElementById('ir_' + field.key)?.value || '';
        });

        if (config.repeater) {
            data[config.repeater.key] = this.collectRepeater(config.repeater.key, config.repeater.subfields);
        }

        return data;
    },
};
</script>
