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

    const FULLSTATUS = [
        'not_fulfilled' => '1',
        'partially_fulfilled' => '2',
        'fulfilled' => '3',
        'fulfilled_with_excellence' => '4',
        'fulfilled_with_distinction' => '5',
    ];
    // Completion Status
    const COMPLETION_STATUS = [
        'incomplete' => 'Incomplete',
        'partially_complete' => 'Partially Complete',
        'complete' => 'Completed',
    ];
     const MATCHING_STATUS = [
        '0' => 'Not Matching', // Translation key: "Not Matching"
        '1' => 'Matching', // Translation key: "Matching"
    ];
}