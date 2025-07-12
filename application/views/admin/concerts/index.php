<!-- Admin Concerts Header -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">Manage Concerts</h1>
                    <p class="text-muted mb-0">Add, edit, and manage all concerts</p>
                </div>
                <div>
                    <a href="<?php echo base_url('admin/concerts/add'); ?>" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add New Concert
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="<?php echo base_url('admin/concerts'); ?>">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-control" name="search" 
                                           placeholder="Search concerts, artists, venues..." 
                                           value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select" name="status">
                                    <option value="">All Status</option>
                                    <option value="upcoming" <?php echo (isset($_GET['status']) && $_GET['status'] == 'upcoming') ? 'selected' : ''; ?>>Upcoming</option>
                                    <option value="active" <?php echo (isset($_GET['status']) && $_GET['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                                    <option value="completed" <?php echo (isset($_GET['status']) && $_GET['status'] == 'completed') ? 'selected' : ''; ?>>Completed</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select" name="sort">
                                    <option value="date_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'date_desc') ? 'selected' : ''; ?>>Latest First</option>
                                    <option value="date_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'date_asc') ? 'selected' : ''; ?>>Oldest First</option>
                                    <option value="name_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'name_asc') ? 'selected' : ''; ?>>Name A-Z</option>
                                    <option value="name_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'name_desc') ? 'selected' : ''; ?>>Name Z-A</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-2"></i>Search
                                </button>
                            </div>
                            <div class="col-md-2">
                                <a href="<?php echo base_url('admin/concerts'); ?>" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-times me-2"></i>Clear
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Concerts Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-music me-2"></i>Concerts List</h5>
                </div>
                <div class="card-body">
                    <?php if(isset($concerts) && !empty($concerts)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Artist</th>
                                        <th>Venue</th>
                                        <th>Date & Time</th>
                                        <th>Status</th>
                                        <th>Tickets</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($concerts as $concert): ?>
                                        <tr>
                                            <td>
                                                <?php if($concert->image): ?>
                                                    <img src="<?php echo base_url('uploads/concerts/' . $concert->image); ?>" 
                                                         class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                                <?php else: ?>
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-music text-muted"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <strong><?php echo $concert->title; ?></strong>
                                                <br>
                                                <small class="text-muted">ID: <?php echo $concert->id; ?></small>
                                            </td>
                                            <td><?php echo $concert->artist; ?></td>
                                            <td><?php echo $concert->venue; ?></td>
                                            <td>
                                                <?php echo date('d M Y', strtotime($concert->date_time)); ?>
                                                <br>
                                                <small class="text-muted"><?php echo date('H:i', strtotime($concert->date_time)); ?> WIB</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?php 
                                                    echo $concert->status == 'upcoming' ? 'primary' : 
                                                        ($concert->status == 'active' ? 'success' : 'secondary'); 
                                                ?>">
                                                    <?php echo ucfirst($concert->status); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <small class="text-muted">Available: <?php echo $concert->available_tickets; ?></small>
                                                    <small class="text-muted">Sold: <?php echo $concert->sold_tickets ?? 0; ?></small>
                                                    <small class="text-muted">Total: <?php echo $concert->capacity; ?></small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?php echo base_url('admin/concerts/view/' . $concert->id); ?>" 
                                                       class="btn btn-sm btn-outline-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="<?php echo base_url('admin/concerts/edit/' . $concert->id); ?>" 
                                                       class="btn btn-sm btn-outline-primary" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-outline-success" 
                                                            onclick="duplicateConcert(<?php echo $concert->id; ?>)" title="Duplicate">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                                            onclick="deleteConcert(<?php echo $concert->id; ?>)" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <?php if(isset($pagination)): ?>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <nav aria-label="Concerts pagination">
                                        <?php echo $pagination; ?>
                                    </nav>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-music fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">No concerts found</h4>
                            <p class="text-muted">
                                <?php if(isset($_GET['search']) || isset($_GET['status'])): ?>
                                    Try adjusting your search criteria or add a new concert.
                                <?php else: ?>
                                    Get started by adding your first concert!
                                <?php endif; ?>
                            </p>
                            <a href="<?php echo base_url('admin/concerts/add'); ?>" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add Concert
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Concert</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone. All associated tickets and orders will also be deleted.
                </div>
                <p>Are you sure you want to delete this concert?</p>
                <p class="mb-0"><strong>Concert:</strong> <span id="concertTitle"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                    <i class="fas fa-trash me-2"></i>Delete Concert
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Duplicate Confirmation Modal -->
<div class="modal fade" id="duplicateModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Duplicate Concert</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>This will create a copy of the concert with the same details. You can then edit the new concert as needed.</p>
                <p class="mb-0"><strong>Concert:</strong> <span id="duplicateConcertTitle"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="confirmDuplicate()">
                    <i class="fas fa-copy me-2"></i>Duplicate Concert
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let concertToDelete = null;
let concertToDuplicate = null;

// Delete concert
function deleteConcert(concertId) {
    // Get concert details via AJAX
    fetch('<?php echo base_url("admin/concerts/get/"); ?>' + concertId)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                concertToDelete = concertId;
                document.getElementById('concertTitle').textContent = data.concert.title;
                const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
                modal.show();
            } else {
                alert('Error loading concert details');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading concert details');
        });
}

function confirmDelete() {
    if (!concertToDelete) return;
    
    fetch('<?php echo base_url("admin/concerts/delete/"); ?>' + concertToDelete, {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Concert deleted successfully!');
            location.reload();
        } else {
            alert('Error deleting concert: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error deleting concert');
    });
}

// Duplicate concert
function duplicateConcert(concertId) {
    // Get concert details via AJAX
    fetch('<?php echo base_url("admin/concerts/get/"); ?>' + concertId)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                concertToDuplicate = concertId;
                document.getElementById('duplicateConcertTitle').textContent = data.concert.title;
                const modal = new bootstrap.Modal(document.getElementById('duplicateModal'));
                modal.show();
            } else {
                alert('Error loading concert details');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading concert details');
        });
}

function confirmDuplicate() {
    if (!concertToDuplicate) return;
    
    fetch('<?php echo base_url("admin/concerts/duplicate/"); ?>' + concertToDuplicate, {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Concert duplicated successfully!');
            location.reload();
        } else {
            alert('Error duplicating concert: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error duplicating concert');
    });
}

// Bulk actions
function selectAll() {
    const checkboxes = document.querySelectorAll('input[name="selected_concerts[]"]');
    const selectAllCheckbox = document.getElementById('selectAll');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAllCheckbox.checked;
    });
    
    updateBulkActions();
}

function updateBulkActions() {
    const checkboxes = document.querySelectorAll('input[name="selected_concerts[]"]:checked');
    const bulkActions = document.getElementById('bulkActions');
    
    if (checkboxes.length > 0) {
        bulkActions.classList.remove('d-none');
    } else {
        bulkActions.classList.add('d-none');
    }
}

function bulkDelete() {
    const checkboxes = document.querySelectorAll('input[name="selected_concerts[]"]:checked');
    const selectedIds = Array.from(checkboxes).map(cb => cb.value);
    
    if (selectedIds.length === 0) {
        alert('Please select concerts to delete');
        return;
    }
    
    if (confirm(`Are you sure you want to delete ${selectedIds.length} concert(s)?`)) {
        fetch('<?php echo base_url("admin/concerts/bulk_delete"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                concert_ids: selectedIds
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Concerts deleted successfully!');
                location.reload();
            } else {
                alert('Error deleting concerts: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting concerts');
        });
    }
}
</script> 