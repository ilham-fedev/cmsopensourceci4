<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Theme</h3>
                <p class="text-subtitle text-muted">Modify theme information and settings</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('panel/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('panel/template') ?>">Themes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Theme Information</h4>
                    <div class="d-flex gap-2">
                        <?php if ($theme->aktif === 'Y'): ?>
                            <span class="badge bg-success">Active Theme</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Inactive</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <form id="themeForm" enctype="multipart/form-data">
                        <div class="row">
                            <!-- Basic Information -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="judul" class="form-label">Theme Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="judul" name="judul" required 
                                           value="<?= esc($theme->judul) ?>" placeholder="Enter theme name">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="pembuat" class="form-label">Author <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="pembuat" name="pembuat" required 
                                           value="<?= esc($theme->pembuat) ?>" placeholder="Enter author name">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="folder" class="form-label">Folder Name</label>
                                    <input type="text" class="form-control" id="folder" name="folder" 
                                           value="<?= esc($theme->folder) ?>" readonly>
                                    <small class="form-text text-muted">Folder name cannot be changed after creation</small>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="version" class="form-label">Version</label>
                                    <input type="text" class="form-control" id="version" name="version" 
                                           value="<?= esc($theme->version ?? '1.0.0') ?>" placeholder="1.0.0">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <!-- Additional Information -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" 
                                              placeholder="Enter theme description"><?= esc($theme->description ?? '') ?></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="thumbnail" class="form-label">Theme Thumbnail</label>
                                    <?php if ($theme->thumbnail): ?>
                                        <div class="mb-2">
                                            <img src="<?= base_url("themes/{$theme->folder}/{$theme->thumbnail}") ?>" 
                                                 class="img-thumbnail" style="max-width: 200px; max-height: 150px; cursor: pointer;" 
                                                 alt="Current thumbnail"
                                                 onclick="showThemePreview('<?= base_url("themes/{$theme->folder}/{$theme->thumbnail}") ?>', '<?= esc($theme->judul) ?>')">
                                            <small class="d-block text-muted">Current thumbnail (click to view full size)</small>
                                        </div>
                                    <?php endif; ?>
                                    <input type="file" class="form-control" id="thumbnail" name="thumbnail" 
                                           accept="image/*">
                                    <small class="form-text text-muted">Upload a new preview image (JPG, PNG, GIF - Max 5MB)</small>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Theme Status</label>
                                    <div class="form-control-plaintext">
                                        <?php if ($theme->aktif === 'Y'): ?>
                                            <span class="badge bg-success fs-6">
                                                <i class="bi bi-check-circle"></i> Currently Active
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary fs-6">
                                                <i class="bi bi-pause-circle"></i> Inactive
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Theme Metadata -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5 class="mb-3">Theme Metadata</h5>
                                <div class="row">
                                    <div class="col-md-3">
                                        <strong>Created:</strong><br>
                                        <small class="text-muted"><?= date('M d, Y H:i', strtotime($theme->created_at)) ?></small>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Last Updated:</strong><br>
                                        <small class="text-muted"><?= date('M d, Y H:i', strtotime($theme->updated_at)) ?></small>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Folder Path:</strong><br>
                                        <small class="text-muted">/themes/<?= esc($theme->folder) ?>/</small>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Created By:</strong><br>
                                        <small class="text-muted">User ID: <?= esc($theme->created_by ?? 'Unknown') ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                            <div class="d-flex gap-2">
                                <a href="<?= base_url('panel/template') ?>" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to Themes
                                </a>
                                <a href="<?= base_url("panel/template/{$theme->id}") ?>" class="btn btn-info">
                                    <i class="bi bi-eye"></i> View Details
                                </a>
                            </div>
                            <div class="d-flex gap-2">
                                <?php if ($theme->aktif !== 'Y'): ?>
                                    <button type="button" class="btn btn-success" onclick="activateTheme(<?= $theme->id ?>)">
                                        <i class="bi bi-check-circle"></i> Activate Theme
                                    </button>
                                <?php endif; ?>
                                <button type="submit" class="btn btn-primary" id="submitBtn">
                                    <i class="bi bi-save"></i> Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Theme Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-xl" style="min-width: 720px; max-width: 90vw;">
        <div class="modal-content" style="height: 90vh;">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalTitle">Theme Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0" style="height: calc(90vh - 120px); overflow-y: auto;">
                <img id="previewImage" src="" alt="Theme Preview" class="w-100" style="object-fit: contain;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section("cssScript") ?>
<style>
.form-control:invalid {
    border-color: #dc3545;
}

.form-control:valid {
    border-color: #28a745;
}

.img-thumbnail {
    border-radius: 0.375rem;
}

.badge.fs-6 {
    font-size: 0.875rem !important;
}
</style>
<?= $this->endSection() ?>

<?= $this->section("postScript") ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('themeForm');
    const submitBtn = document.getElementById('submitBtn');
    
    // Form validation
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!validateForm()) {
            return;
        }
        
        submitForm();
    });
    
    function validateForm() {
        let isValid = true;
        const requiredFields = ['judul', 'pembuat'];
        
        requiredFields.forEach(fieldName => {
            const field = document.getElementById(fieldName);
            const value = field.value.trim();
            
            if (!value) {
                showFieldError(field, 'This field is required');
                isValid = false;
            } else {
                clearFieldError(field);
            }
        });
        
        return isValid;
    }
    
    function showFieldError(field, message) {
        field.classList.add('is-invalid');
        const feedback = field.nextElementSibling;
        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.textContent = message;
        }
    }
    
    function clearFieldError(field) {
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
    }
    
    function submitForm() {
        const formData = new FormData(form);
        
        // Add CSRF token
        formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
        formData.append('_method', 'PUT');
        
        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Saving...';
        
        fetch('<?= base_url("panel/template/{$theme->id}") ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showSuccess('Theme updated successfully!');
                setTimeout(() => {
                    window.location.href = '<?= base_url("panel/template") ?>';
                }, 2000);
            } else {
                showError(data.message || 'Update failed');
                if (data.errors) {
                    Object.keys(data.errors).forEach(fieldName => {
                        const field = document.getElementById(fieldName);
                        if (field) {
                            showFieldError(field, data.errors[fieldName]);
                        }
                    });
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showError('An error occurred during update');
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="bi bi-save"></i> Save Changes';
        });
    }
    
    function showSuccess(message) {
        const alert = createAlert('success', message);
        form.insertBefore(alert, form.firstChild);
        setTimeout(() => alert.remove(), 5000);
    }
    
    function showError(message) {
        const alert = createAlert('danger', message);
        form.insertBefore(alert, form.firstChild);
        setTimeout(() => alert.remove(), 5000);
    }
    
    function createAlert(type, message) {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show`;
        alert.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        return alert;
    }
    
    // File input change handler
    document.getElementById('thumbnail').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            if (file.size > 5 * 1024 * 1024) { // 5MB
                showFieldError(this, 'Image size must be less than 5MB');
                this.value = '';
            } else {
                clearFieldError(this);
            }
        }
    });
});

function activateTheme(id) {
    if (confirm('Are you sure you want to activate this theme?')) {
        const formData = new FormData();
        formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
        
        fetch(`<?= base_url("panel/template/activate") ?>/${id}`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Theme activated successfully!');
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while activating the theme.');
        });
    }
}

// Theme preview functionality
function showThemePreview(imageUrl, themeName) {
    document.getElementById('previewModalTitle').textContent = `Preview: ${themeName}`;
    document.getElementById('previewImage').src = imageUrl;
    new bootstrap.Modal(document.getElementById('previewModal')).show();
}
</script>
<?= $this->endSection() ?>