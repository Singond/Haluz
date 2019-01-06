<?php
namespace Haluz;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Logger\ConsoleLogger;

use Twig_Loader_Filesystem;

/**
 * The single command of the application.
 *
 * @author Singon
 */
class MainCommand extends Command {

	protected function configure() {
		$this->setName(Application::CMD);
		$this->setDescription(Application::DESC);
		$this->addArgument('template', InputArgument::REQUIRED,
			"The Twig template to be processed");
		$this->addArgument('output', InputArgument::OPTIONAL,
			"Name of the output file (can be a pattern)");
		$this->addOption('json', null, InputOption::VALUE_REQUIRED,
			"File with data to be filled, in JSON format");
	}

	protected function execute(InputInterface $in, OutputInterface $out) {
		Log::newLogger($out);
		$logger = Log::getLogger();

		$template = $in->getArgument('template');
		$templateDir = dirname($template);
		$templateName = basename($template);
		$output = $in->getArgument('output');
		$logger->debug("Using template $templateName in $templateDir");
		$logger->debug("The output file name pattern is $output");

		$loader = new Twig_Loader_Filesystem($templateDir);
		$processor = new Processor();
		$processor->setLoader($loader);
		$processor->setTemplateName($templateName);


		if ($in->hasOption('json')) {
			$processor->setDataSource(
				new JsonFileDataSourceSingle($in->getOption('json')));
		}

		if (!empty($output)) {
			$processor->setOutput(new FileOutput($output));
		} else {
			$processor->setOutput(new ConsoleOutput());
		}
		$processor->run();
		return 0;
	}
}
?>