<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Import Theme from JSON</h3>
                <p class="text-subtitle text-muted">Import theme configuration from exported JSON file</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('panel/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('panel/template') ?>">Themes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Import</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-lg-8 col-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">JSON Theme Import</h4>
                </div>
                <div class="card-body">
                    <!-- Import Instructions -->
                    <div class="alert alert-info">
                        <h6><i class="bi bi-info-circle"></i> Import Instructions</h6>
                        <ul class="mb-0">
                            <li>Select a valid JSON file exported from this or another CMS installation</li>
                            <li>The JSON file should contain theme metadata and configuration</li>
                            <li>Theme files (views and assets) must be uploaded separately after import</li>
                            <li>Imported themes will be inactive by default</li>
                        </ul>
                    </div>

                    <form id="importForm" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label for="json_file" class="form-label">Select JSON File <span class="text-danger">*</span></label>
                            <div class="file-upload-wrapper">
                                <input type="file" class="form-control" id="json_file" name="json_file" 
                                       accept=".json" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <small class="form-text text-muted">Maximum file size: 2MB</small>
                        </div>

                        <!-- JSON Preview -->
                        <div id="jsonPreview" class="mb-4" style="display: none;">
                            <label class="form-label">JSON Preview</label>
                            <div class="card">
                                <div class="card-body">
                                    <pre id="jsonContent" class="bg-light p-3 rounded" style="max-height: 300px; overflow-y: auto;"></pre>
                                </div>
                            </div>
                        </div>

                        <!-- Theme Information Preview -->
                        <div id="themeInfo" class="mb-4" style="display: none;">
                            <label class="form-label">Theme Information</label>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-borderless table-sm">
                                                <tr>
                                                    <td class="fw-bold">Name:</td>
                                                    <td id="themeName">-</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">Author:</td>
                                                    <td id="themeAuthor">-</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">Version:</td>
                                                    <td id="themeVersion">-</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless table-sm">
                                                <tr>
                                                    <td class="fw-bold">Folder:</td>
                                                    <td id="themeFolder">-</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">Export Date:</td>
                                                    <td id="exportDate">-</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">Export Version:</td>
                                                    <td id="exportVersion">-</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <strong>Description:</strong>
                                        <p id="themeDescription" class="text-muted mb-0">-</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Validation Messages -->
                        <div id="validationMessages"></div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('panel/template') ?>" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Back to Themes
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                                <i class="bi bi-upload"></i> Import Theme
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sample JSON Format -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Expected JSON Format</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Your JSON file should follow this structure:</p>
                    <pre class="bg-light p-3 rounded"><code>{
  "theme": {
    "name": "Theme Name",
    "author": "Author Name",
    "folder": "theme-folder",
    "description": "Theme description",
    "version": "1.0.0",
    "active": false,
    "metadata": {
      "created_at": "2024-01-01 00:00:00",
      "updated_at": "2024-01-01 00:00:00",
      "thumbnail": "thumbnail.jpg"
    },
    "settings": {
      "color_scheme": "light",
      "layout": "boxed"
    },
    "export_date": "2024-01-01 12:00:00",
    "export_version": "1.0"
  }
}</code></pre>
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
}

pre {
    font-size: 0.875rem;
    line-height: 1.4;
}

.table td {
    padding: 0.25rem 0.5rem;
}

.table td:first-child {
    width: 35%;
}

.alert-validation {
    border-left: 4px solid;
}

.alert-validation.alert-success {
    border-left-color: #28a745;
}

.alert-validation.alert-danger {
    border-left-color: #dc3545;
}

.alert-validation.alert-warning {
    border-left-color: #ffc107;
}
</style>
<?= $this->endSection() ?>

<?= $this->section("postScript") ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('importForm');
    const fileInput = document.getElementById('json_file');
    const submitBtn = document.getElementById('submitBtn');
    const jsonPreview = document.getElementById('jsonPreview');
    const themeInfo = document.getElementById('themeInfo');
    const validationMessages = document.getElementById('validationMessages');
    
    let currentJsonData = null;
    
    // File input change handler
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            validateAndPreviewFile(file);
        } else {
            resetPreview();
        }
    });
    
    // Form submit handler
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!currentJsonData) {
            showValidationMessage('danger', 'Please select a valid JSON file');
            return;
        }
        
        submitImport();
    });
    
    function validateAndPreviewFile(file) {
        // Reset state
        resetPreview();
        
        // Validate file type
        if (!file.name.toLowerCase().endsWith('.json')) {
            showFieldError(fileInput, 'Please select a JSON file');
            return;
        }
        
        // Validate file size (2MB)
        if (file.size > 2 * 1024 * 1024) {
            showFieldError(fileInput, 'File size must be less than 2MB');
            return;
        }
        
        // Read and parse file
        const reader = new FileReader();
        reader.onload = function(e) {
            try {
                const jsonData = JSON.parse(e.target.result);
                validateJsonStructure(jsonData);
                previewTheme(jsonData, e.target.result);
                clearFieldError(fileInput);
            } catch (error) {
                showFieldError(fileInput, 'Invalid JSON format: ' + error.message);
                showValidationMessage('danger', 'Failed to parse JSON file');
            }
        };
        reader.readAsText(file);
    }
    
    function validateJsonStructure(data) {
        const errors = [];
        
        // Check main structure
        if (!data.theme) {
            errors.push('Missing "theme" object in JSON');
        } else {
            const theme = data.theme;
            
            // Check required fields
            const required = ['name', 'author', 'folder'];
            required.forEach(field => {
                if (!theme[field]) {
                    errors.push(`Missing required field: ${field}`);
                }
            });
            
            // Check folder name format
            if (theme.folder && !/^[a-zA-Z0-9\-_]+$/.test(theme.folder)) {
                errors.push('Invalid folder name format');
            }
        }
        
        if (errors.length > 0) {
            showValidationMessage('danger', 'JSON validation errors:<ul><li>' + errors.join('</li><li>') + '</li></ul>');
            submitBtn.disabled = true;
            currentJsonData = null;
        } else {
            showValidationMessage('success', 'JSON file is valid and ready for import');
            submitBtn.disabled = false;
            currentJsonData = data;
        }
    }
    
    function previewTheme(data, jsonString) {
        const theme = data.theme;
        
        // Show JSON preview
        document.getElementById('jsonContent').textContent = JSON.stringify(data, null, 2);
        jsonPreview.style.display = 'block';
        
        // Show theme info
        document.getElementById('themeName').textContent = theme.name || '-';
        document.getElementById('themeAuthor').textContent = theme.author || '-';
        document.getElementById('themeVersion').textContent = theme.version || '1.0.0';
        document.getElementById('themeFolder').textContent = theme.folder || '-';
        document.getElementById('exportDate').textContent = theme.export_date || '-';
        document.getElementById('exportVersion').textContent = theme.export_version || '-';
        document.getElementById('themeDescription').textContent = theme.description || 'No description provided';
        
        themeInfo.style.display = 'block';
    }
    
    function resetPreview() {
        jsonPreview.style.display = 'none';
        themeInfo.style.display = 'none';
        validationMessages.innerHTML = '';
        submitBtn.disabled = true;
        currentJsonData = null;
    }
    
    function submitImport() {
        const formData = new FormData(form);
        
        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Importing...';
        
        fetch('<?= base_url("panel/template/doImport") ?>', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showValidationMessage('success', 'Theme imported successfully!');
                setTimeout(() => {
                    window.location.href = '<?= base_url("panel/template") ?>';
                }, 2000);
            } else {
                showValidationMessage('danger', data.error || 'Import failed');
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
            showValidationMessage('danger', 'An error occurred during import');
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="bi bi-upload"></i> Import Theme';
        });
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
    
    function showValidationMessage(type, message) {
        const alertClass = type === 'success' ? 'alert-success' : 
                          type === 'warning' ? 'alert-warning' : 'alert-danger';
        
        validationMessages.innerHTML = `
            <div class="alert ${alertClass} alert-validation d-flex align-items-start">
                <i class="bi ${type === 'success' ? 'bi-check-circle' : 
                              type === 'warning' ? 'bi-exclamation-triangle' : 
                              'bi-exclamation-circle'} me-2 mt-1"></i>
                <div>${message}</div>
            </div>
        `;
    }
});
</script>
<?= $this->endSection() ?>