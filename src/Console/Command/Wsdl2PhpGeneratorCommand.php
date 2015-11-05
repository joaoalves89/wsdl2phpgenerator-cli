<?php

namespace VentureOakLabs\Wsdl2PhpGenerator\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Wsdl2PhpGenerator\Generator;
use Wsdl2PhpGenerator\Config;

/**
 * Makes a console command to generate PHP Class from a WSDL.
 *
 * @author João Alves <jalves@ventureoak.com>
 *
 * @copyright 2015 VentureOak
 */
class Wsdl2PhpGeneratorCommand extends Command
{
    /**
     * @todo Implement Other options. Check https://github.com/wsdl2phpgenerator/wsdl2phpgenerator#options
     */
    protected function configure()
    {
        $this
            ->setName('wsdl2php-generator')
            ->setDescription('Simple WSDL to PHP classes converter. Takes a WSDL file and outputs class files ready to use')
            ->addOption(
               'inputFile',
               null,
               InputOption::VALUE_REQUIRED,
               'The path or url to the WSDL to generate classes from'
            )
            ->addOption(
               'outputDir',
               null,
               InputOption::VALUE_REQUIRED,
               'The directory to place the generated classes in. It will be created if it does not already exist'
            )
            ->addOption(
               'namespaceName',
               null,
               InputOption::VALUE_OPTIONAL,
               'The namespace to use for the generated classes. If not set classes will be generated without a namespace'
            )
            ->addOption(
               'operationNames',
               null,
               InputOption::VALUE_OPTIONAL,
               'A comma-separated string of service operations to generate. This will only generate types that are needed for selected operations. The generated service class will only contain selected operation'
            )
            ->addOption(
               'soapClientClass',
               null,
               InputOption::VALUE_OPTIONAL,
               'The base class to use for generated services. This should be a subclass of the PHP SoapClient.'
            )
            ->addOption(
               'soapClientOptions',
               null,
               InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
               'An array of configuration options to pass to the SoapClient. For each option separate the key and the value with a comma'
            )
        ;

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $options = [
            'inputFile' => $input->getOption('inputFile'),
            'outputDir' => $input->getOption('outputDir')
        ];

        if ($namespaceName = $input->getOption('namespaceName')) {
            $options['namespaceName'] = $namespaceName;
        }

        if ($operationNames = $input->getOption('operationNames')) {
            $options['operationNames'] = $operationNames;
        }

        if ($soapClientClass = $input->getOption('soapClientClass')) {
            $options['soapClientClass'] = $soapClientClass;
        }

        if ($soapClientOptions = $input->getOption('soapClientOptions')) {

            $parsedOptions = [];

            foreach ($soapClientOptions as $value) {
                $valueParts = explode(',', $value);
                $parsedOptions[$valueParts[0]] = $valueParts[1];
            }

            $options['soapClientOptions'] = $parsedOptions;
        }

        $output->writeln('<info>##### Generating for Options #####</info>');

        foreach ($options as $optionName => $optionValue) {

            if (is_array($optionValue)) {
                $output->writeln("<comment>$optionName</comment>");

                foreach ($optionValue as $key => $value) {
                    $output->writeln("<comment>     $key = $value</comment>");
                }
            } else {
                $output->writeln("<comment>$optionName = $optionValue</comment>");
            }

        }

        try {

            $generator = new Generator();
            $generator->generate(new Config($options));

            $output->writeln('<info>##### Generated!! Check your output directory. #####</info>');

        } catch (\Exception $ex) {

            $output->writeln("<error>".$ex->getMessage()."</error>");

        }

    }

}
