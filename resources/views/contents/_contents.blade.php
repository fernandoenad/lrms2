<div class="card">
    <div class="card-header">
        Other Content List</strong>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover m-0">
            <tbody>
                @if(sizeof($contents) > 0)
                    @foreach($contents as $contentItem)
                        <tr>
                            <td class="@if($content->id == $contentItem->id) {{ 'bg-primary'}} @endif">
                                <a href="{{ route('content.show', $contentItem->id) }}">
                                    <strong>{{ $contentItem->name ?? '' }}</strong>
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

    <div class="card-footer p-0">
        <small class="float-right"></small>
    </div>
</div>