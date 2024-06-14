<?php

namespace App\Console\Commands;
use App\Models\Checkin;

use Illuminate\Console\Command;

class SetCheckinAddress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:address {args*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call map api & Set currenct address of employee at checkin time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $args = $this->argument('args');

        $latitude = $args['lat'];
        $longitude = $args['lng'];
        $address = "";
        if($latitude != "" && $longitude != "") {
            $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$latitude,$longitude&key=AIzaSyBo27sKUtOiRvIa7XzkCzh48QuCRn6ysaw&sensor=false";
            
            $geocode = file_get_contents($url);
            $json = json_decode($geocode);
            $address = $json->results[0]->formatted_address;

            Checkin::where('id',$args['id'])->update(['address' => $address]);
        }
    }
}
