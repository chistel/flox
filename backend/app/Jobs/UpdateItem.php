<?php

namespace App\Jobs;

use App\Services\Models\ItemService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateItem implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $itemId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($itemId)
    {
      $this->itemId = $itemId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ItemService $itemService)
    {
      try {
        $itemService->_refresh($this->itemId);
      } catch(\Exception $e) {
        $this->fail();
      }
    }
}