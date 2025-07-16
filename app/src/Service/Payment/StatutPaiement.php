<?php

namespace App\Service\Payment;

enum StatutPaiement : string
{
    case OPERATOR_ERROR = 'OPERATOR_ERROR';
    case OPERATOR_PROCESSING = 'OPERATOR_PROCESSING';
    case OPERATOR_COMPLETED = 'OPERATOR_COMPLETED';
    case CNMCI_ACCEPTED = 'CNMCI_ACCEPTED';
    case CNMCI_REJECTED = 'CNMCI_REJECTED';

}