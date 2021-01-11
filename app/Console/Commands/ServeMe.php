<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\ProcessUtils;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\PhpExecutableFinder;
class ServeMe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
   protected $signature = 'command:serve {--host=127.0.0.1} {--port=8000}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
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
     */
    public function handle()
    {
      chdir($this->laravel->publicPath());
      $this->line("<info>Laravel development server started:</info> <http://{$this->host()}:{$this->port()}>");
      passthru($this->serverCommand());
    }
   protected function serverCommand()
   {
      return sprintf('%s -S %s:%s %s/server.php',
                  ProcessUtils::escapeArgument((new PhpExecutableFinder)->find(false)),
                  $this->host(),
                  $this->port(),
                  ProcessUtils::escapeArgument($this->laravel->basePath())
      );
   }
   /**
    * Get the host for the command.
    *
    * @return string
    */
   protected function host()
   {
      return env( 'APP_HTTP_HOST' ) != "" ?  env( 'APP_HTTP_HOST' ) : $this->input->getOption('host');
   }
   /**
    * Get the port for the command.
    *
    * @return string
    */
   protected function port()
   {
      return env( 'APP_HTTP_PORT' ) != "" ?  env( 'APP_HTTP_PORT' ) : $this->input->getOption('port');
   }
}