<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Process\Process;

class RunPythonScript implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $source_database;
    protected $source_table;
    protected $target_table;

    /**
     * Create a new job instance.
     *
     * @param string $source_database
     * @param string $source_table
     * @param string $target_table
     */
    public function __construct($source_database, $source_table, $target_table)
    {
        $this->source_database = $source_database;
        $this->source_table = $source_table;
        $this->target_table = $target_table;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Create a unique filename for each run
        $safeSourceDatabase = preg_replace('/[^A-Za-z0-9_\-]/', '_', $this->source_database);
        $safeTablePair = preg_replace('/[^A-Za-z0-9_\-]/', '_', $this->source_table . '_to_' . $this->target_table);
        $outputFilePath = storage_path('logs/' . $safeSourceDatabase . '_' . $safeTablePair . '_' . time() . '.log');

        // Update the current log filename
        file_put_contents(storage_path('logs/current_log_filename.txt'), $outputFilePath);

        // Set the initial status
        $statusFilePath = storage_path('logs/script_status.log');
        file_put_contents($statusFilePath, json_encode(['status' => 'running']));

        // Run the Python script asynchronously and write output to file
        $process = new Process([
            '/bin/python3',
            '/home/siya/projects/mysql-scripts/Data Transfer/transferdata-v8.10.py',
            $this->source_database,
            $this->source_table,
            $this->target_table,
            $outputFilePath // Pass the output file path to the Python script
        ]);

        // Increase the timeout, for example, to 300 seconds (5 minutes)
        $process->setTimeout(1800); //1200 =20mins timeout

        // Start the process asynchronously
        $process->start();

        foreach ($process as $type => $buffer) {
            if ($process::OUT === $type) {
                file_put_contents($outputFilePath, $buffer, FILE_APPEND);
            } else { // $process::ERR === $type
                \Log::error("Python script error: " . $buffer);
                file_put_contents(storage_path('logs/last_script_error.txt'), $buffer, FILE_APPEND);
            }
        }

        // Wait for the process to finish
        $process->wait();

        // Update status to completed once done
        file_put_contents($statusFilePath, json_encode(['status' => 'completed']));

        if (!$process->isSuccessful()) {
            \Log::error('Python script failed: ' . $process->getErrorOutput());
        } else {
            \Log::info('Python script output: ' . $process->getOutput());
        }
    }
}
