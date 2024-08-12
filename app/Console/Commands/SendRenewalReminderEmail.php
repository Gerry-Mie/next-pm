<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Modules\BusinessSettingsModule\Emails\RenewalReminderMail;
use Modules\BusinessSettingsModule\Entities\BusinessSettings;
use Modules\BusinessSettingsModule\Entities\PackageSubscriber;

class SendRenewalReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-renewal-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a subscription renewal reminder email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deadlineWarning = (int) BusinessSettings::where(['key_name' => 'deadline_warning', 'settings_type' => 'subscription_Setting'])->first()->live_values ?? 0;
        $subscribers = PackageSubscriber::with('provider')
            ->whereDate('package_end_date', '<=', Carbon::now()->subDays($deadlineWarning)->toDateString())
            ->where(['is_canceled' => 0, 'is_notified' => 0])
            ->get();

        foreach ($subscribers as $subscriber){
            $provider = $subscriber->provider;
            $email = optional($provider)->company_email;
            if ($provider && $email) {
                try {
                    Mail::to($email)->send(new RenewalReminderMail($provider));
                    $subscriber->update(['is_notified' => 1]);
                } catch (\Exception $exception) {
                    info($exception);
                }
            }
        }

    }
}
