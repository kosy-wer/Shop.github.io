<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearExpiredTokens extends Command
{
    protected $signature = 'clear:expired-tokens';
    protected $description = 'Clear expired tokens from the personal_access_tokens table.';

    public function handle()
    {
        $expiredTokens = DB::table('personal_access_tokens')
            ->get()
            ->filter(function ($token) {
                $abilities = json_decode($token->abilities, true);

                return isset($abilities['expires_in']) && now()->greaterThan($abilities['expires_in']);
            })
            ->pluck('id')
            ->toArray();

        if (!empty($expiredTokens)) {
            DB::table('personal_access_tokens')
                ->whereIn('id', $expiredTokens)
                ->delete();

            $this->info('Expired tokens have been cleared.');
        } else {
            $this->info('No expired tokens found.');
        }
    }
}

