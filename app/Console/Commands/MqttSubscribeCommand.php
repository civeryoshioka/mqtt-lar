<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;
use App\Models\SensorPju;
use PhpParser\Node\Stmt\TryCatch;

class MqttSubscribeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to MQTT broker and save sensor data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $this->info("Fungsi handle() sudah mulai berjalan...");
        $mqtt = MQTT::connection();
        
        $mqtt->subscribe('application/4674110f-9988-41c2-8ead-12ef5e9ca344/device/b43b115777468f27/event/up', function (string $topic, string $message) {
            $data = json_decode($message, true);
            $this->info("Fungsi handle() sudah mulai subscribe...");
            //if (isset($data['object'])) {
            Try{
                SensorPju::create([
                    'voltage' => $data['object']['voltage'] ?? null,
                    'lamp_state' => $data['object']['lampState'] ?? null,
                    'counter' => $data['object']['counter'] ?? null,
                    'frequency' => $data['object']['frequency'] ?? null,
                    'power_factor' => $data['object']['powerFactor'] ?? null,
                    'datetime' => date("Y-m-d H:i:s", $data['object']['datetime'] ?? null),
                    'brightness' => $data['object']['brightness'] ?? null,
                    'current' => $data['object']['current'] ?? null,
                    'energy' => $data['object']['energy'] ?? null,
                    'error_state' => $data['object']['errorState'] ?? null,
                    'node_id' => $data['object']['nodeId'] ?? null,
                    'power' => $data['object']['power'] ?? null,
                    'temperature' => $data['object']['temperature'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $this->info("Berhasil menyimpan data sensor PJU.");
            }catch (\Exception $e) {
                $this->error("Gagal menyimpan data sensor PJU: " . $e->getMessage());
            }  
           // }
            echo "Data inserted!\n";
        }, 0);

        $mqtt->loop(true);
    }
}
