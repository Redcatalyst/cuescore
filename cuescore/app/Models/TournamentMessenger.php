<?php

namespace App\Models;

use Twilio\Rest\Client;

class TournamentMessenger
{   
    
    /**
     * Client
     *
     * @var string
     */
    private Client $client;

    /**
     * Phonenumber to receive the messages
     *
     * @var string
     */
    private string $phone_numer = '';

    /**
     * The message to send
     *
     * @var string
     */
    private string $message = '';

    /**
     * Base constructor that sets the base values for using Twillio
     */
    public function __construct() 
    {
        $this->setClient();
        $this->setPhonenumber(env('TWILLIO_TO_RICK_NUMBER'));
    }

    /**
     * Sends an message with the configured type
    *
    * @param string $message
    * @param string $type
    * @return void
    */
    public function sendMessage(string $message, string $type)
    {
        $this->setMessage($message);

        switch($type)
        {
            case ('WhatsApp'):
            case ('WA'):
                $this->sendAsWhatsAppMessage();
                break;

            case ('SMS'):
                $this->sendAsSMSMessage();
                break;

            default:
                $this->sendAsWhatsAppMessage();
                break;

        }
        
    }

    /**
     * Send an WhatsApp message to the configured phone number
     *
     * @param string $message
     * @return void
     */
    private function sendAsWhatsAppMessage()
    {
        $this->client->messages
          ->create("whatsapp:".$this->getPhonenumber(),
            [
                "from" => "whatsapp:".env('TWILLIO_FROM_WA_NUMBER'),
                "body" => $this->getMessage()
            ]
          );
    }

    /**
     * Send an SMS message to the configured phone number
     *
     * @param string $message
     * @return void
     */
    private function sendAsSMSMessage()
    {
        $this->client->messages->create(
            $this->getPhonenumber(),
            [
                'from' => env('TWILLIO_FROM_SMS_NUMBER'),
                'body' => $this->getMessage()
            ]
        );
    }

    /**
     * Set a base client for Twillio
     *
     * @return void
     */
    private function setClient()
    {
        $this->client = new Client(env('TWILLIO_ACCOUNT'), env('TWILLIO_TOKEN'));
    }

    /**
     * Retrieve the set client
     *
     * @return void
     */
    private function getClient()
    {
        return $this->client;
    }

    /**
     * Set the phone number
     *
     * @param string The phone number where you want to send to
     * @return void
     */
    private function setPhonenumber(string $phone_number)
    {
        $this->phone_numer = $phone_number;
    }

    /**
     * Set the message
     *
     * @param string The message you want to send
     * @return void
     */
    private function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * Get the phone number

     * @return void
     */
    private function getPhonenumber()
    {
        return $this->phone_numer;
    }

    /**
     * Get the message 
     *
     * @param string $message
     * @return void
     */
    private function getMessage()
    {
        return $this->message;
    }

    /**
     * Retrieve basic payload with the setup default numbers
     *
     * @return array The payload 
     */
    private function getPayloadForMessage()
    {
        $payload = [
            'From'  => env('TWILLIO_FROM_NUMBER'),
            'To'    => $this->getPhonenumber(),
            'Body'  => $this->getMessage()
        ];
        return http_build_query($payload);
    }

    /**
     * Generates a message body with the given signup data
     *
     * @param array $messageData
     * @return string
     */
    public function generateSignUpMessage(array $messageData): string
    {
        $message = $messageData['cuescoreName'] . ' wil zich opgeven voor toernooi: '.$messageData['tournament'] . '. ';
        $message .= 'Je kan hem bereiken via: '. $messageData['phonenumber'] . '. ';
        if(!empty($messageData['link'])){
            $message .= 'Cuescore link: '.$messageData['cuescoreLink'] . '. ';
        }
        return $message;
    }

}
