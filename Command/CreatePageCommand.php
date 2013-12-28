<?php

/*
* This file is part of the Ikimea Pages package.
*
* (c) Ikimea <http://www.ikimea.com/>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/


namespace Ikimea\PageBundle\Command;

use Ikimea\PageBundle\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class CreatePageCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('ikimea:page:create')
            ->setDescription('Create a page')
            ->addOption('name', InputOption::VALUE_REQUIRED)
            ->addOption('enabled', null, InputOption::VALUE_OPTIONAL, 'Page.enabled', false)
            ->addOption('route', null, InputOption::VALUE_OPTIONAL, 'Page.route', false)
            ->addOption('locale', null, InputOption::VALUE_OPTIONAL, 'Page.locale', false)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $dialog = $this->getHelperSet()->get('dialog');

        $values = array(
            'name'        => null,
            'enabled'     => null,
            'route'       => null,
            'locale'      => null,
        );

        foreach ($values as $name => $value) {
            $values[$name] = $input->getOption($name);

            while ($values[$name] == null) {
                $values[$name] = $dialog->ask($output, sprintf("Please define a value for <info>Page.%s</info> : ", $name));
            }
        }


        $page = new Page();
        $page->setName($values['name']);
        $page->setLocale($values['locale']);
        $page->setRoute($values['route']);
        $page->setPublished(in_array($values['enabled'], array('true', 'yes', 1, '1')));

        $em = $this->getContainer()->get('doctrine')->getManager();
        $em->persist($page);
        $em->flush();

        $output->writeln('<info>Page created !</info>');
    }
}