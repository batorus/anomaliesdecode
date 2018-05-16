<?php

namespace AnomaliesBundle\Services;
use Psr\Log\LoggerInterface;

class MessageGenerator
{

    private $logger;

    public function __construct(LoggerInterface $logger, $loggingEnabled)
    {
        $this->logger = $logger;
        $this->loggingEnabled = $loggingEnabled;
    }

    public function getHappyMessage()
    {
        $this->logger->info('About to find a happy message!');
        
        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }
}