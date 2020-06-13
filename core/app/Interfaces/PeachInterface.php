<?php


namespace App\Interfaces;


use App\Recipient;
use App\User;

interface PeachInterface
{
    function createRecipient(User $user, $authorization_code=''): bool;
    function saveBanks();
    function sendMoneyToUser(User $recipient, $amount, $reason = '');
}
