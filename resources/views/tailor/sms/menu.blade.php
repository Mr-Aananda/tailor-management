<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'sms.groupSms') ? 'active' : '' }}" href="{{ route('sms.groupSms') }}">Group sms</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'sms.customSms') ? 'active' : '' }}" href="{{ route('sms.customSms') }}">Custom sms</a>
        </li>

    </ul>
</div>
