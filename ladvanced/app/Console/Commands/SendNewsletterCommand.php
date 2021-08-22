<?php

namespace App\Console\Commands;

use App\Notifications\NewsletterNotification;
use Illuminate\Console\Command;
use App\User;

class SendNewsletterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:newsletter {emails?*}';

    protected $description = 'Envia un correo electronico';

    public function handle()
    {
        $emails = $this->argument('emails');
        $builder = User::query();

        if ($emails) {
            $builder->whereIn('email', $emails);
        }

        $count = $builder->count();

        if ($count) {
            $this->output->progressStart($count);
            $builder->whereNotNull('email_verified_at')
                ->each(function (User $user) {
                    $user->notify(new NewsletterNotification());
                    $this->output->progressAdvance();
                });
            $this->info("Se enviaron {$count} correos");
            $this->output->progressFinish();
        }

        $this->info('No se envio ningun correo');

    }
}
