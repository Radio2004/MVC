<?php

declare(strict_types=1);

namespace Model\Console;

require_once 'init.php';

use Core\DbConnect;
use Model\Messages;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'censore:filter')]
class CensoreFilter extends \Symfony\Component\Console\Command\Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $messages = Messages::getMessages(DbConnect::getConnect());

        $queryString = "SELECT * FROM Censorship";

        $result_arr = mysqli_fetch_all(mysqli_query(DbConnect::getConnect(), $queryString), MYSQLI_ASSOC);

        foreach ($messages as $message) {
            foreach ($result_arr as $value) {
                $cenName = $value['censorship_word'];

                $re = "/($cenName)\b/mi";

                $strMessage = $message['message'] . ' ' . $message['title'];

                $messageId = $message['id'];

                if (preg_match($re, $strMessage)) {
                    $censoreId = $value['censorship_id'];

                    $resultExists = mysqli_query(DbConnect::getConnect(), "SELECT censore_message_id FROM censorship_messages WHERE message_id = '$messageId' AND censorship_id = '$censoreId'");

                    $exists = (mysqli_num_rows($resultExists)) ? TRUE : FALSE;

                    if (!$exists) {
                        $insertCensMess = "INSERT INTO censorship_messages (message_id, censorship_id) VALUES ('$messageId', '$censoreId')";

                        mysqli_query(DbConnect::getConnect(), $insertCensMess);
                    }

                }
            }

            $querychecked = "UPDATE messages SET status = '1', censorship_check_date = now() WHERE id = '$messageId'";

            mysqli_query(DbConnect::getConnect(), $querychecked);
        }

        return Command::SUCCESS;
    }
}

