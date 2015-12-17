<?php

class IndexTest extends Illuminate\Foundation\Testing\TestCase
{
	/**
	 * The base URL to use while testing the application.
	 *
	 * @var string
	 */
	protected $baseUrl = 'http://localhost';

	public function setup()
	{
		parent::setup();
		$this->prepareForTests();
	}

	/**
	 * Creates the application.
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication()
	{
		$app = require __DIR__ . '/../../../../bootstrap/app.php';

		$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
		return $app;
	}

	/**
	 * Migrates the database and set the mailer to 'pretend'.
	 * This will cause the tests to run quickly.
	 */
	private function prepareForTests()
	{
		if(!\File::exists(base_path() . '/config/testing'))
		{
			\File::copyDirectory(__DIR__ . '/../config/testing/', base_path() . '/config/testing');
		}
		Artisan::call('migrate');
		Mail::pretend(true);
	}

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testPackage()
	{
		$this->visit('/claremontdesign/naradmin')
				->see('ClaremontDesign NAR/NHR Admin Package');
	}

}
