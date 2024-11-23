<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppointmentOtherDocument extends Model
{
    use HasFactory;

    protected $table = 'appointment_other_documents';


    protected $fillable = [
        // General fields for all appointments
        'other_document',
        'requester_last_name',
        'requester_first_name',
        'requester_middle_name',
        'requester_mailing_address',
        'requester_city_municipality',
        'requester_province',
        'contact_no',
        'requester_sex',
        'requester_age',
        'appointment_type',
        'other_document',
        'document_details',
        'requesting_party',
        'relationship_to_owner',
        'purpose',
        'delayed',
        'delayed_date',
        'appointment_date',
       
    ];

    protected $casts = [
        'delayed' => 'boolean',
    ];
}