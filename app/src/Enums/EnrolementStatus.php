<?php
namespace App\Enums;

enum EnrolementStatus
{
    case VALIDATION_EN_ATTENTE;
    case VALIDATED;
    case COMPLETED;
    case REJECTED;
    case ACCEPTED;
    case WAITING_FOR_VALIDATION;
    case PAYMENT_INVALID;

}
