<div class="card">
    <div class="card-header">Administrative Tools</div>

    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="#" class="nav-link d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-book me-2"></i> Category</span>
                    <span class="badge">{{ App\Models\Inventory::select('learningarea')->distinct()->count() }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-book me-2"></i> Area</span>
                    <span class="badge">{{ App\Models\Inventory::select('gradelevel')->distinct()->count() }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-book me-2"></i> LR Type</span>
                    <span class="badge">{{ App\Models\Inventory::select('lrtype')->distinct()->count() }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>