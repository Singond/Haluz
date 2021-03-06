<?php
namespace Haluz;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
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

		// Input formats
		// NOTE: Beware that the string '0' is cast to false, so data files
		// with this name will not work.
		$this->addOption('json', null, InputOption::VALUE_REQUIRED,
			"File with data to be filled, in JSON format");
		$this->addOption('csv', null, InputOption::VALUE_REQUIRED,
			"File with data to be filled, in CSV format");
		$this->addOption('xml', null, InputOption::VALUE_REQUIRED,
			"File with data to be filled, in XML format");

		$this->addOption('multiple', 'm', InputOption::VALUE_NONE,
			"Treat input as multiple data entries");
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

		// Prepare Twig engine
		$loader = new Twig_Loader_Filesystem($templateDir);
		$processor = new Processor();
		$processor->setLoader($loader);
		$processor->setTemplateName($templateName);

		// Options
		$multiple = $in->getOption('multiple');

		// Input
		if ($file = $in->getOption('json')) {
			$processor->setDataSource(new JsonFileDataSource($file));
		}
		if ($file = $in->getOption('csv')) {
			if ($multiple)
				$processor->setDataSource(new CsvFileMultiDataSource($file));
			else
				$processor->setDataSource(new CsvFileDataSource($file));
		}
		if ($file = $in->getOption('xml')) {
			$processor->setDataSource(new XmlFileDataSource($file));
		}

		// Output
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