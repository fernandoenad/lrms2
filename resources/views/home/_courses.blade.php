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
                                @if(Route::currentRouteName() == 'home.course.show')
                                    <a href="{{ route('home.course.show', [$category->id, $courseItem->id]) }}">
                                @else
                                    <a href="{{ route('home.course.list', [$category->id, $courseItem->id]) }}">
                                @endif
                                        <strong>{{ $courseItem->name ?? '' }}</strong>
                                        <span class="badge badge-success float-right">
                                            {{ $course->join('contents', 'courses.id', '=', 'contents.course_id')
                                                ->where('courses.id', '=', $courseItem->id)
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