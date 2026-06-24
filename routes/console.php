<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('subscriptions:generate-renewals')->dailyAt('00:05');
Schedule::command('subscriptions:cancel-overdue')->dailyAt('00:15');
Schedule::command('subscriptions:finalize-cancellations')->dailyAt('00:25');
Schedule::command('subscriptions:send-reminders')->dailyAt('08:00');
Schedule::command('backup:run')->dailyAt('02:00');
Schedule::command('backup:clean')->dailyAt('03:00');