<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Upload New Theme</h3>
                <p class="text-subtitle text-muted">Add a new theme to your CMS</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('panel/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('panel/template') ?>">Themes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Upload New</li>
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
                <div class="card-header">
                    <h4 class="card-title">Theme Information</h4>
                </div>
                <div class="card-body">
                    <form id="themeForm" enctype="multipart/form-data">
                        <div class="row">
                            <!-- Basic Information -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="judul" class="form-label">Theme Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="judul" name="judul" required 
                                           placeholder="Enter theme name">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="pembuat" class="form-label">Author <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="pembuat" name="pembuat" required 
                                           placeholder="Enter author name">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="folder" class="form-label">Folder Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="folder" name="folder" required 
                                           placeholder="theme-folder-name" pattern="[a-zA-Z0-9\-_]+">
                                    <small class="form-text text-muted">Only letters, numbers, hyphens, and underscores allowed</small>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="version" class="form-label">Version</label>
                                    <input type="text" class="form-control" id="version" name="version" 
                                           placeholder="1.0.0" value="1.0.0">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <!-- Additional Information -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" 
                                              placeholder="Enter theme description"></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="thumbnail" class="form-label">Theme Thumbnail</label>
                                    <input type="file" class="form-control" id="thumbnail" name="thumbnail" 
                                           accept="image/*">
                                    <small class="form-text text-muted">Upload a preview image (JPG, PNG, GIF - Max 5MB)</small>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="theme_file" class="form-label">Theme Package (Optional)</label>
                                    <input type="file" class="form-control" id="theme_file" name="theme_file" 
                                           accept=".zip">
                                    <small class="form-text text-muted">Upload a ZIP file containing theme files (Max 50MB)</small>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <!-- File Upload Progress -->
                        <div id="uploadProgress" class="mb-3" style="display: none;">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                     role="progressbar" style="width: 0%"></div>
                            </div>
                            <small class="text-muted">Uploading theme...</small>
                        </div>

                        <!-- Theme Structure Info -->
                        <div class="alert alert-info">
                            <h6><i class="bi bi-info-circle"></i> Theme Structure Requirements</h6>
                            <p class="mb-2">Your theme should follow this structure:</p>
                            <ul class="mb-0">
                                <li><strong>Views:</strong> PHP template files (_layout.php, home.php, etc.)</li>
                                <li><strong>Assets:</strong> CSS, JS, images, and fonts</li>
                                <li><strong>Required files:</strong> _layout.php (main layout), home.php (homepage template)</li>
                            </ul>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('panel/template') ?>" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Back to Themes
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="bi bi-upload"></i> Upload Theme
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>

<?= $this->section("cssScript") ?>
<style>
.file-upload-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
    width: 100%;
}

.file-upload-wrapper input[type=file] {
    position: absolute;
    left: -9999px;
}

.file-upload-label {
    cursor: pointer;
    display: block;
    padding: 0.5rem 1rem;
    border: 2px dashed #ddd;
    border-radius: 0.375rem;
    text-align: center;
    transition: all 0.3s ease;
}

.file-upload-label:hover {
    border-color: #007bff;
    background-color: #f8f9fa;
}

.file-upload-label.has-file {
    border-color: #28a745;
    background-color: #d4edda;
}

.form-control:invalid {
    border-color: #dc3545;
}

.form-control:valid {
    border-color: #28a745;
}
</style>
<?= $this->endSection() ?>

<?= $this->section("postScript") ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('themeForm');
    const submitBtn = document.getElementById('submitBtn');
    const progressBar = document.getElementById('uploadProgress');
    
    // Auto-generate folder name from theme name
    document.getElementById('judul').addEventListener('input', function() {
        const themeName = this.value;
        const folderName = themeName.toLowerCase()
            .replace(/[^a-zA-Z0-9\s]/g, '')
            .replace(/\s+/g, '-')
            .replace(/^-+|-+$/g, '');
        document.getElementById('folder').value = folderName;
    });
    
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
        const requiredFields = ['judul', 'pembuat', 'folder'];
        
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
        
        // Validate folder name pattern
        const folderField = document.getElementById('folder');
        const folderPattern = /^[a-zA-Z0-9\-_]+$/;
        if (folderField.value && !folderPattern.test(folderField.value)) {
            showFieldError(folderField, 'Only letters, numbers, hyphens, and underscores allowed');
            isValid = false;
        }
        
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
        
        // Show progress bar
        progressBar.style.display = 'block';
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Uploading...';
        
        fetch('<?= base_url("panel/template") ?>', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSuccess('Theme uploaded successfully!');
                setTimeout(() => {
                    window.location.href = '<?= base_url("panel/template") ?>';
                }, 2000);
            } else {
                showError(data.message || 'Upload failed');
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
            showError('An error occurred during upload');
        })
        .finally(() => {
            progressBar.style.display = 'none';
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="bi bi-upload"></i> Upload Theme';
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
    
    // File input change handlers
    document.getElementById('theme_file').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            if (file.size > 50 * 1024 * 1024) { // 50MB
                showFieldError(this, 'File size must be less than 50MB');
                this.value = '';
            } else {
                clearFieldError(this);
            }
        }
    });
    
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
</script>
<?= $this->endSection() ?>