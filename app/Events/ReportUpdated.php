namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\Event;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ReportUpdated implements ShouldBroadcast
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function broadcastOn()
    {
        return new Channel('report-channel');
    }
}
