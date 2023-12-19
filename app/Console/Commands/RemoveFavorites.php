<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserFavoriteProduct;

class RemoveFavorites extends Command
{
    protected $signature = 'favorites:remove';

    protected $description = 'Remove favorite products for all users';

    public function handle()
    {
        $this->info('Removing favorite products for all users...');

        // Удаление избранных продуктов
        UserFavoriteProduct::truncate();

        $this->info('Favorite products removed successfully.');
    }
}
