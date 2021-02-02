<div class="card">
    <div class="card-header">
        Category List
    </div>

    <div class="card-body p-0">
        <table class="table table-hover m-0">
            <tbody>
                @if(sizeof($categories) > 0)
                    @foreach($categories as $categoryItem)
                        <tr>
                            <td class="@if($category->id == $categoryItem->id) {{ 'bg-primary'}} @endif">
                                <a href="{{ route('content.category.show', $categoryItem->id) }}">
                                    <strong>{{ $categoryItem->name ?? '' }}</strong>
                                    <span class="badge badge-success float-right">
                                        {{ $category->join('courses', 'categories.id', '=', 'courses.category_id') 
                                            ->where('courses.category_id', '=', $categoryItem->id)
                                            ->where('courses.visibility', '=', 1)
                                            ->count() ?? '' }}
                                    </span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr><td>No records found.</td></tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        <small class="float-right"></small>
    </div>
</div>