<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as XlsxWriter;
use PhpOffice\PhpSpreadsheet\Reader\Xls as XlsReader;

class Convert2Xlsx extends Command
{
    protected static $defaultName = 'app:xls2xlsx';

    protected function configure()
    {
        $this
            ->setDescription('Convert xls to xlsx, Displays help for a command use --help option.')
            ->addArgument('xlsFilePath', InputArgument::REQUIRED, 'The file path of xls.')
            ->setHelp("Usage:\nphp bin/console app:xls2xlsx ./hoge/excel.xls")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $xlsFilePath = getenv("XLS_DIR"). $input->getArgument('xlsFilePath');
        $reader = new XlsReader();
        $spreadsheet = $reader->load($xlsFilePath);

        $xlsxFilePath = str_replace('xls', 'xlsx', $xlsFilePath);

        $writer = new XlsxWriter($spreadsheet);
        $writer->save($xlsxFilePath);
        return 0;
    }
}
