<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?= esc($theme->judul) ?></h3>
                <p class="text-subtitle text-muted">Theme Details and Information</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('panel/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('panel/template') ?>">Themes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <section class="row">
        <!-- Theme Preview Card -->
        <div class="col-xl-4 col-lg-5 col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Theme Preview</h5>
                </div>
                <div class="card-body text-center">
                    <?php if ($theme->thumbnail): ?>
                        <img src="<?= base_url("themes/{$theme->folder}/{$theme->thumbnail}") ?>" 
                             class="img-fluid rounded mb-3" style="max-height: 300px; cursor: pointer;" 
                             alt="<?= esc($theme->judul) ?>"
                             onclick="showThemePreview('<?= base_url("themes/{$theme->folder}/{$theme->thumbnail}") ?>', '<?= esc($theme->judul) ?>')">
                        <p class="text-muted small">Click image to view full size</p>
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center bg-light rounded mb-3" 
                             style="height: 200px;">
                            <i class="bi bi-image icon-xxxl text-muted"></i>
                        </div>
                        <p class="text-muted">No preview available</p>
                    <?php endif; ?>
                    
                    <!-- Status Badge -->
                    <div class="mb-3">
                        <?php if ($theme->aktif === 'Y'): ?>
                            <span class="badge bg-success fs-6 px-3 py-2">
                                <i class="bi bi-check-circle"></i> Currently Active
                            </span>
                        <?php else: ?>
                            <span class="badge bg-secondary fs-6 px-3 py-2">
                                <i class="bi bi-pause-circle"></i> Inactive
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Quick Actions -->
                    <div class="d-grid gap-2">
                        <?php if ($theme->aktif !== 'Y'): ?>
                            <button type="button" class="btn btn-success" onclick="activateTheme(<?= $theme->id ?>)">
                                <i class="bi bi-check-circle"></i> Activate Theme
                            </button>
                        <?php endif; ?>
                        <?php if ($theme->thumbnail): ?>
                            <button type="button" class="btn btn-info" onclick="showThemePreview('<?= base_url("themes/{$theme->folder}/{$theme->thumbnail}") ?>', '<?= esc($theme->judul) ?>')">
                                <i class="bi bi-eye-fill"></i> Preview Theme
                            </button>
                        <?php endif; ?>
                        <a href="<?= base_url("panel/template/{$theme->id}/edit") ?>" class="btn btn-primary">
                            <i class="bi bi-pencil"></i> Edit Theme
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Theme Information -->
        <div class="col-xl-8 col-lg-7 col-md-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Theme Information</h5>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-gear"></i> Actions
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url("panel/template/{$theme->id}/edit") ?>">
                                <i class="bi bi-pencil"></i> Edit Theme
                            </a></li>
                            <li><a class="dropdown-item" href="<?= base_url("panel/template/export/{$theme->id}") ?>">
                                <i class="bi bi-download"></i> Export JSON
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <?php if ($can_delete['can_delete']): ?>
                                <li><a class="dropdown-item text-danger" href="#" onclick="deleteTheme(<?= $theme->id ?>, '<?= esc($theme->judul) ?>')">
                                    <i class="bi bi-trash"></i> Delete Theme
                                </a></li>
                            <?php else: ?>
                                <li><span class="dropdown-item-text text-muted">
                                    <i class="bi bi-info-circle"></i> <?= esc($can_delete['reason']) ?>
                                </span></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Basic Information -->
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold">Theme Name:</td>
                                    <td><?= esc($theme->judul) ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Author:</td>
                                    <td><?= esc($theme->pembuat) ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Version:</td>
                                    <td><?= esc($theme->version ?? '1.0.0') ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Folder:</td>
                                    <td><code><?= esc($theme->folder) ?></code></td>
                                </tr>
                            </table>
                        </div>
                        
                        <!-- Metadata -->
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold">Created:</td>
                                    <td><?= date('M d, Y H:i', strtotime($theme->created_at)) ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Updated:</td>
                                    <td><?= date('M d, Y H:i', strtotime($theme->updated_at)) ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Status:</td>
                                    <td>
                                        <?php if ($theme->aktif === 'Y'): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Created By:</td>
                                    <td>User ID: <?= esc($theme->created_by ?? 'Unknown') ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Description -->
                    <?php if (!empty($theme->description)): ?>
                        <div class="mt-3">
                            <h6 class="fw-bold">Description:</h6>
                            <p class="text-muted"><?= nl2br(esc($theme->description)) ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Theme Validation Status -->
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Theme Validation Status</h5>
                </div>
                <div class="card-body">
                    <?php if ($validation['valid']): ?>
                        <div class="alert alert-success d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <div>
                                <strong>Theme is valid!</strong> All required files and directories are present.
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <div>
                                <strong>Theme validation failed:</strong> <?= esc($validation['error']) ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- File Structure Check -->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h6>Required Files:</h6>
                            <ul class="list-group list-group-flush">
                                <?php 
                                $requiredFiles = ['_layout.php', 'home.php'];
                                $viewPath = APPPATH . 'Views/themes/' . $theme->folder . '/';
                                foreach ($requiredFiles as $file): 
                                    $exists = file_exists($viewPath . $file);
                                ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <?= $file ?>
                                        <?php if ($exists): ?>
                                            <span class="badge bg-success"><i class="bi bi-check"></i></span>
                                        <?php else: ?>
                                            <span class="badge bg-danger"><i class="bi bi-x"></i></span>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        
                        <div class="col-md-6">
                            <h6>Directory Structure:</h6>
                            <ul class="list-group list-group-flush">
                                <?php 
                                $directories = [
                                    'Views' => APPPATH . 'Views/themes/' . $theme->folder,
                                    'Assets' => FCPATH . 'themes/' . $theme->folder
                                ];
                                foreach ($directories as $name => $path):
                                    $exists = is_dir($path);
                                ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <?= $name ?> Directory
                                        <?php if ($exists): ?>
                                            <span class="badge bg-success"><i class="bi bi-check"></i></span>
                                        <?php else: ?>
                                            <span class="badge bg-danger"><i class="bi bi-x"></i></span>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="col-12 mt-4">
            <a href="<?= base_url('panel/template') ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Themes
            </a>
        </div>
    </section>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the theme "<span id="deleteThemeName"></span>"?</p>
                <p class="text-danger"><strong>Warning:</strong> This will permanently delete all theme files and cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete Theme</button>
            </div>
        </div>
    </div>
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
.icon-xxxl {
    font-size: 3rem;
}

.badge.fs-6 {
    font-size: 0.875rem !important;
}

.table td {
    padding: 0.5rem 0.75rem;
}

.table td:first-child {
    width: 30%;
}

code {
    background-color: #f8f9fa;
    padding: 0.2rem 0.4rem;
    border-radius: 0.25rem;
    font-size: 0.875em;
}
</style>
<?= $this->endSection() ?>

<?= $this->section("postScript") ?>
<script>
let deleteThemeId = null;

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

function deleteTheme(id, name) {
    deleteThemeId = id;
    document.getElementById('deleteThemeName').textContent = name;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

document.getElementById('confirmDelete').addEventListener('click', function() {
    if (deleteThemeId) {
        const formData = new FormData();
        formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
        formData.append('_method', 'DELETE');
        
        fetch(`<?= base_url("panel/template") ?>/${deleteThemeId}`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Theme deleted successfully!');
                window.location.href = '<?= base_url("panel/template") ?>';
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the theme.');
        });
    }
    bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
});

// Theme preview functionality
function showThemePreview(imageUrl, themeName) {
    document.getElementById('previewModalTitle').textContent = `Preview: ${themeName}`;
    document.getElementById('previewImage').src = imageUrl;
    new bootstrap.Modal(document.getElementById('previewModal')).show();
}
</script>
<?= $this->endSection() ?>