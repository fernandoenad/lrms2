<div class="card">
    <div class="card-header">
        Course List</strong>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover m-0">
            <tbody>
                @if(sizeof($courses) > 0)
                    @foreach($courses as $courseItem)
                        <tr>
                            <td class="@if($course->id == $courseItem->id) {{ 'bg-primary'}} @endif">
                                <a href="{{ route('content.course.show', [$category->id, $courseItem->id]) }}">
                                    <strong>{{ $courseItem->name ?? '' }}</strong>
                                    <span class="badge badge-success float-right">
                                        {{ $course->join('contents', 'courses.id', '=', 'contents.course_id')
                                            ->where('courses.id', '=', $courseItem->id)
                                            ->where('contents.status', '=', 3)
                                            ->where('contents.visibility', '=', 1)
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

    <div class="card-footer p-0">
        <small class="float-right"></small>
    </div>
</div>