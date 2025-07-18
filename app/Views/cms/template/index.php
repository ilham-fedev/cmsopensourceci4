<?= $this->extend("cms/_layout") ?>
<?= $this->section("content") ?>
<div class="page-heading">
    <h3>Theme Management</h3>
</div>
<div class="page-content">
    <section class="row">
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="bi bi-palette icon-xxxl text-primary ms-3"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3><?= $stats['total'] ?></h3>
                                    <span>Total Themes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="bi bi-check-circle icon-xxxl text-success ms-3"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3><?= $stats['active'] ?></h3>
                                    <span>Active Theme</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="bi bi-pause-circle icon-xxxl text-warning ms-3"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3><?= $stats['inactive'] ?></h3>
                                    <span>Inactive Themes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="bi bi-eye icon-xxxl text-info ms-3"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3><?= $active_theme ? $active_theme->judul : 'None' ?></h3>
                                    <span>Current Theme</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Quick Actions</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2">
                            <a href="<?= base_url("panel/template/new") ?>" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Upload New Theme
                            </a>
                            <a href="<?= base_url("panel/template/import") ?>" class="btn btn-secondary">
                                <i class="bi bi-upload"></i> Import from JSON
                            </a>
                            <button type="button" class="btn btn-info" onclick="refreshThemes()">
                                <i class="bi bi-arrow-clockwise"></i> Refresh
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Themes Grid -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Available Themes</h4>
                        <div class="d-flex gap-2">
                            <input type="text" id="searchThemes" class="form-control" placeholder="Search themes..." style="width: 200px;">
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-funnel"></i> Filter
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" onclick="filterThemes('all')">All Themes</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="filterThemes('active')">Active Only</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="filterThemes('inactive')">Inactive Only</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row" id="themesContainer">
                            <?php if (empty($themes)): ?>
                                <div class="col-12 text-center py-5">
                                    <i class="bi bi-palette2 icon-xxxl text-muted"></i>
                                    <h5 class="mt-3 text-muted">No themes found</h5>
                                    <p class="text-muted">Upload your first theme to get started</p>
                                    <a href="<?= base_url("panel/template/new") ?>" class="btn btn-primary">
                                        <i class="bi bi-plus-circle"></i> Upload Theme
                                    </a>
                                </div>
                            <?php else: ?>
                                <?php foreach ($themes as $theme): ?>
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4 theme-card" data-status="<?= $theme->aktif ?>">
                                        <div class="card h-100 <?= $theme->aktif === 'Y' ? 'border-success' : '' ?>">
                                            <?php if ($theme->aktif === 'Y'): ?>
                                                <div class="ribbon ribbon-top-left">
                                                    <span class="bg-success">Active</span>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <div class="card-header p-0">
                                                <?php if ($theme->thumbnail): ?>
                                                    <img src="<?= base_url("themes/{$theme->folder}/{$theme->thumbnail}") ?>" 
                                                         class="card-img-top" style="height: 200px; object-fit: cover;" 
                                                         alt="<?= esc($theme->judul) ?>">
                                                <?php else: ?>
                                                    <div class="d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                                        <i class="bi bi-image icon-xxxl text-muted"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title"><?= esc($theme->judul) ?></h5>
                                                <p class="card-text text-muted small mb-2">
                                                    <i class="bi bi-person"></i> <?= esc($theme->pembuat) ?>
                                                </p>
                                                <?php if (!empty($theme->description)): ?>
                                                    <p class="card-text"><?= esc($theme->description) ?></p>
                                                <?php endif; ?>
                                                
                                                <div class="mt-auto">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <small class="text-muted">
                                                            <i class="bi bi-folder"></i> <?= esc($theme->folder) ?>
                                                        </small>
                                                        <small class="text-muted">
                                                            v<?= esc($theme->version ?? '1.0.0') ?>
                                                        </small>
                                                    </div>
                                                    
                                                    <div class="btn-group w-100" role="group">
                                                        <?php if ($theme->aktif !== 'Y'): ?>
                                                            <button type="button" class="btn btn-success btn-sm" 
                                                                    onclick="activateTheme(<?= $theme->id ?>)">
                                                                <i class="bi bi-check-circle"></i> Activate
                                                            </button>
                                                        <?php else: ?>
                                                            <button type="button" class="btn btn-success btn-sm" disabled>
                                                                <i class="bi bi-check-circle-fill"></i> Active
                                                            </button>
                                                        <?php endif; ?>
                                                        
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                                                <i class="bi bi-gear"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="<?= base_url("panel/template/{$theme->id}") ?>">
                                                                    <i class="bi bi-eye"></i> View Details
                                                                </a></li>
                                                                <li><a class="dropdown-item" href="<?= base_url("panel/template/{$theme->id}/edit") ?>">
                                                                    <i class="bi bi-pencil"></i> Edit
                                                                </a></li>
                                                                <li><a class="dropdown-item" href="<?= base_url("panel/template/preview/{$theme->id}") ?>" target="_blank">
                                                                    <i class="bi bi-eye-fill"></i> Preview
                                                                </a></li>
                                                                <li><hr class="dropdown-divider"></li>
                                                                <li><a class="dropdown-item" href="<?= base_url("panel/template/export/{$theme->id}") ?>">
                                                                    <i class="bi bi-download"></i> Export JSON
                                                                </a></li>
                                                                <?php if ($theme->aktif !== 'Y'): ?>
                                                                    <li><hr class="dropdown-divider"></li>
                                                                    <li><a class="dropdown-item text-danger" href="#" onclick="deleteTheme(<?= $theme->id ?>, '<?= esc($theme->judul) ?>')">
                                                                        <i class="bi bi-trash"></i> Delete
                                                                    </a></li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
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

<?= $this->endSection() ?>

<?= $this->section("cssScript") ?>
<style>
.ribbon {
    position: absolute;
    z-index: 10;
}

.ribbon-top-left {
    top: 10px;
    left: -5px;
}

.ribbon span {
    position: relative;
    display: block;
    padding: 6px 12px;
    color: white;
    font-size: 11px;
    font-weight: bold;
    text-transform: uppercase;
    border-radius: 0 3px 3px 0;
}

.ribbon span::before {
    content: '';
    position: absolute;
    left: -5px;
    top: 0;
    border: 12px solid transparent;
    border-right-color: inherit;
}

.theme-card {
    transition: transform 0.2s;
}

.theme-card:hover {
    transform: translateY(-2px);
}

.icon-xxxl {
    font-size: 3rem;
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
            body: formData,
            credentials: 'same-origin'
        })
        .then(response => {
            console.log('Response status:', response.status);
            console.log('Response type:', response.headers.get('content-type'));
            
            // Check if response is a redirect (not authenticated)
            if (response.status === 303 || response.status === 302) {
                throw new Error('Authentication required. Please refresh the page and try again.');
            }
            
            // Check if response is JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                throw new Error('Server returned non-JSON response. Status: ' + response.status);
            }
            
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            if (data && data.success) {
                alert('Theme activated successfully!');
                location.reload();
            } else {
                alert('Error: ' + (data ? data.message : 'Unknown error occurred'));
            }
        })
        .catch(error => {
            console.error('Full error:', error);
            alert('Error: ' + error.message);
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
            body: formData,
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Theme deleted successfully!');
                location.reload();
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

function refreshThemes() {
    location.reload();
}

function filterThemes(filter) {
    const cards = document.querySelectorAll('.theme-card');
    cards.forEach(card => {
        const status = card.dataset.status;
        if (filter === 'all') {
            card.style.display = 'block';
        } else if (filter === 'active' && status === 'Y') {
            card.style.display = 'block';
        } else if (filter === 'inactive' && status === 'N') {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

// Search functionality
document.getElementById('searchThemes').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const cards = document.querySelectorAll('.theme-card');
    
    cards.forEach(card => {
        const title = card.querySelector('.card-title').textContent.toLowerCase();
        const author = card.querySelector('.card-text').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || author.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});
</script>
<?= $this->endSection() ?>