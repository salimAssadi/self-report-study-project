<?php

namespace App\Constants;
class Status
{
    // Fulfillment Status
    const FULFILLMENT_STATUS = [
        '1' => 'Not Fulfilled',
        '2' => 'Partially Fulfilled',
        '3' => 'Fulfilled',
        '4' => 'Fulfilled with Excellence',
        '5' => 'Fulfilled with Distinction',
    ];

    // Completion Status
    const COMPLETION_STATUS = [
        'incomplete' => 'Incomplete',
        'partially_complete' => 'Partially Complete',
        'complete' => 'Complete',
    ];
     const MATCHING_STATUS = [
        '0' => 'Not Matching', // Translation key: "Not Matching"
        '1' => 'Matching', // Translation key: "Matching"
    ];
}