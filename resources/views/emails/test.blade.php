<div style="margin-bottom: 25px;">
    {{ $user->name . ' ' . $user->lastname }} подписался(ась) на курс повышения квалификации {{ $course->name }}
</div>
<hr>
<div style="margin-bottom: 10px;">
    <b>ФИО:</b> <a href="{{ route('users.show', ['login'=>$loginData->login]) }}">{{ $user->name . ' ' . $user->lastname }} {{ $user->middlename != null ? $user->middlename : '' }}</a> 
</div>
<div style="margin-bottom: 10px;">
    <b>email:</b> {{ $user->email }}
</div>
<div style="margin-bottom: 10px;">
    <b>Номер телефона:</b> {{ $user->phone }}
</div>
<div style="margin-bottom: 10px;">
    <b>Образовательная организация:</b> <a href="{{ route('organizations.show', ['id'=>$organization->id]) }}">
        {{ $organization->name }}
    </a>
</div>
<div style="margin-bottom: 10px;">
    <b>Должность:</b> {{ $position->name }}
</div>
<hr>
<div style="margin-bottom: 10px;">
    <b>Название курса:</b> <a href="{{ route('courses.show', ['id'=>$course->id]) }}">{{ $course->name }}</a>
</div>
<div style="margin-bottom: 10px;">
    <b>Количество часов:</b> {{ $course->duration }}
</div>
<div style="margin-bottom: 10px;">
    <b>Тип курса:</b> {{ $courseType->name }}
</div>
<div style="margin-bottom: 10px;">
    <b>Дата начала:</b> {{ date( "d.m.Y H:i", strtotime($course->start_date)) }}
</div>
<div style="margin-bottom: 10px;">
    <b>Дата окончания:</b> {{ date( "d.m.Y H:i", strtotime($course->end_date)) }}
</div>
<div style="padding: 15px; text-align: center;">
    <b>Подать заявку можно до {{ date( "H:i d.m.Y", strtotime($course->end_entry_date)) }}</b> 
</div>

